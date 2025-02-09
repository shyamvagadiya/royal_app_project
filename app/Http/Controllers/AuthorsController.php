<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthorsController extends Controller
{
    /**
     * Display a listing of authors
     * Fetches authors from the API and formats them for display
     */
    public function index()
    {
        // Get access token from session
        $token = Session::get('access_token');
        
        // Make API request to fetch authors
        $response = Http::withToken($token)->get(env('API_BASE_URL') . '/v2/authors');
        
        // Handle failed API response
        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Failed to fetch authors.']);
        }

        $data = $response->json();

        // Transform API data into a more usable format
        $authors = collect($data['items'] ?? [])->map(function ($author) {
            return [
                'id' => $author['id'],
                'name' => "{$author['first_name']} {$author['last_name']}",
                'birthday' => \Carbon\Carbon::parse($author['birthday'])->format('d M Y'),
                'gender' => ucfirst($author['gender']),
                'place_of_birth' => $author['place_of_birth']
            ];
        });

        return view('authors.index', compact('authors'));
    }

    /**
     * Display details for a specific author
     */
    public function show($id)
    {
        // Get access token and fetch author details
        $token = Session::get('access_token');
        $author = Http::withToken($token)->get(env('API_BASE_URL') . "/v2/authors/$id")->json();

        return view('authors.show', compact('author'));
    }

    /**
     * Delete an author if they have no books
     */
    public function destroy($id)
    {
        // Get access token
        $token = Session::get('access_token');
        
        // First fetch author to check their books
        $author = Http::withToken($token)->get(env('API_BASE_URL') . "/v2/authors/{$id}");
        if (!$author->successful()) {
            return back()->withErrors(['error' => 'Failed to fetch author books.']);
        }

        $books = $author->json();
        // Prevent deletion if author has books
        if (!empty($books['books'])) {
            return back()->withErrors(['error' => 'Cannot delete author with existing books.']);
        }

        // Proceed with deletion if no books exist
        $deleteResponse = Http::withToken($token)->delete(env('API_BASE_URL') . "/v2/authors/{$id}");
        if ($deleteResponse->successful()) {
            return back()->with('success', 'Author deleted successfully.');
        }

        return back()->withErrors(['error' => 'Failed to delete author.']);
    }
}