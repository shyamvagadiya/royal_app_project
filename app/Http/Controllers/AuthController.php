<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    /**
     * Handle user login by authenticating credentials with API
     * Stores access token and user info in session upon successful login
     */
    public function login(Request $request)
    {
        // Make API request to get authentication token
        $response = Http::post(env('API_BASE_URL') . '/v2/token', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $token = $response->json()['token_key'];
            // Store token and user info in session
            Session::put('access_token', $token);
            Session::put('user', [
                'email' => $response->json()['user']['email'],
                'name' => $response->json()['user']['first_name'] . ' ' . $response->json()['user']['last_name'] ?? 'User'
            ]);
            // Cache the access token for future use
            Cache::put('access_token',  $token);
            return redirect()->route('welcome');
        }

        return back()->withErrors(['message' => 'Invalid credentials']);
    }

    /**
     * Handle user logout by removing session and cached data
     */
    public function logout()
    {
        // Clear session and cache data
        Session::forget('access_token');
        Session::forget('user');
        Cache::forget('access_token');
        return redirect()->route('login');
    }

    /**
     * Display user profile information
     */
    public function profileShow()
    {
        // Fetch user details from API using stored token
        $token = Session::get('access_token');
        $response = Http::withToken($token)->get(env('API_BASE_URL') . '/v2/me');
        $user = $response->json();
        return view('auth.profile_show', compact('user'));
    }

    /**
     * Show profile edit form with current user data
     */
    public function profileEdit()
    {
        // Fetch user details from API for edit form
        $token = Session::get('access_token');
        $response = Http::withToken($token)->get(env('API_BASE_URL') . '/v2/me');
        $user = $response->json();
        return view('auth.profile_edit', compact('user'));
    }

    /**
     * Update user profile information via API
     */
    public function profileUpdate(Request $request)
    {
        $token = Session::get('access_token');
        
        // Send updated user data to API
        $response = Http::withToken($token)->put(env('API_BASE_URL') . '/v2/users/' . intval($request->id), [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'active' => (intval($request->active) == 1 ? true : false),
            'email_confirmed' => true,
            'google_id' => "demosds" 
        ]);
        return redirect()->route('profile.show');
    }
}
