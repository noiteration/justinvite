<?php
use App\Models\User;

// ApiLoginController API tests

test('login with valid credentials returns user and token', function () {
    $password = 'password123';
    $user = User::factory()->create(['password' => bcrypt($password)]);
    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => $password,
    ]);
    $response->assertStatus(201)
        ->assertJsonStructure(['user', 'token']);
});

test('login with invalid credentials returns 401', function () {
    $user = User::factory()->create(['password' => bcrypt('password123')]);
    $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'wrongpassword',
    ])->assertStatus(401)
      ->assertJson(['message' => 'Invalid Credentials']);
});

test('login with missing fields returns validation error', function () {
    $this->postJson('/api/login', [
        'email' => '',
        'password' => '',
    ])->assertStatus(422);
});