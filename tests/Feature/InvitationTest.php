<?php

use App\Models\User;
use App\Models\Invitation;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteEmail;

// InvitationController API tests

test('creates an invitation for a new email', function () {
    Mail::fake();
    $user = User::factory()->create();
    $this->actingAs($user)
        ->postJson('/api/invite', ['email' => 'test@example.com'])
        ->assertStatus(201)
        ->assertJsonStructure(['message', 'token']);
    Mail::assertQueued(InviteEmail::class);
});

test('returns 409 for already invited email', function () {
    $user = User::factory()->create();
    Invitation::factory()->create(['email' => 'test@example.com']);
    $this->actingAs($user)
        ->postJson('/api/invite', ['email' => 'test@example.com'])
        ->assertStatus(409)
        ->assertJson(['message' => 'An invitation has already been sent to this email.']);
});

test('deletes expired/used invite and creates new one', function () {
    Mail::fake();
    $user = User::factory()->create();
    $invite = Invitation::factory()->create(['email' => 'test@example.com']);
    $invite->update(['accepted_at' => now()]); 
    $this->actingAs($user)
        ->postJson('/api/invite', ['email' => 'test@example.com'])
        ->assertStatus(201)
        ->assertJsonStructure(['message', 'token']);
    Mail::assertQueued(InviteEmail::class);
});

test('validates email format', function () {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->postJson('/api/invite', ['email' => 'not-an-email'])
        ->assertStatus(422);
});

test('invite email sets data and passes url/qrcode to view', function () {
    $token = 'sample-token';
    $mailable = new InviteEmail($token);
    $content = $mailable->content();
    expect($mailable->data)->toBe($token);
    expect($content->with['url'])->toContain($token);
    expect($content->with['qrcode'])->toStartWith('data:image/svg+xml;base64,');
    expect($mailable->envelope()->subject)->toBe('Invite Email');
    expect($mailable->attachments())->toBeArray()->toBeEmpty();
});
