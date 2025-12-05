<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteEmail;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $existing = Invitation::where('email', $request->email)->first();

        if ($existing) {
            if ($existing->isValid()) {
                return response()->json([
                    'message' => 'An invitation has already been sent to this email.'
                ], 409);
            }
            // If existing invite is expired or used, delete it and continue
            $existing->delete();
        }

        $invitation = Invitation::createInvite(
            $request->email,
            auth()->id()
        );

        Mail::to($request->email)->send(new InviteEmail($invitation->token));

        return response()->json([
            'message' => 'Sent Invitation Successfully',
            'token' => $invitation->token
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invitation $invitation)
    {
        //
    }
}
