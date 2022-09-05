<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @return \Inertia\Response
     */
    public function getApiToken(Request $request)
    {
        $request->user()->tokens()->delete();

        $token = $request->user()->createToken('token')->plainTextToken;

        return Inertia::render('Auth/GetApiToken', ['token' => $token]);
    }
}
