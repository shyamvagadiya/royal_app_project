<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BooksController extends Controller
{
    /**
     * Display a listing of books
     * Fetches books from API and formats them for display
     */
    public function index()
    {
        // Get authentication token from session
        $token = Session::get('access_token');
        // Make API request to fetch books
        $response = Http::withToken($token)->get(env('API_BASE_URL') . '/v2/books');
        
        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Failed to fetch authors.']);
        }

        // Transform API response data into a collection with required fields
        $data = $response->json();
        $books = collect($data['items'] ?? [])->map(function ($book) {
            return [
                'id' => $book['id'],
                'title' => $book['title'],
                'release_date' => \Carbon\Carbon::parse($book['release_date'])->format('d M Y'),
                'isbn' => ucfirst($book['isbn']),
                'format' => $book['format'],
                'number_of_pages' => $book['number_of_pages'],
            ];
        });

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book
     * Fetches authors list for the dropdown
     */
    public function create()
    {
        // Get authentication token from session
        $token = Session::get('access_token');
        // Fetch authors for the selection dropdown
        $response = Http::withToken($token)->get(env('API_BASE_URL') . '/v2/authors');
        $authors = $response->json();
        // Transform authors data to simple id-name pairs
        $authors = collect($authors['items'] ?? [])->map(function ($author) {
            return [
                'id' => $author['id'],
                'name' => $author['first_name']." ".$author["last_name"],
            ];
        });
        
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created book in storage
     * Sends POST request to API with book details
     */
    public function store(Request $request)
    {
        // Get authentication token from session
        $token = Session::get('access_token');
        
        // Send POST request to API to create new book
        $response = Http::withToken($token)->post(env('API_BASE_URL') . '/v2/books', [
            'author' => ['id' => intval($request->author_id)],
            'title' => $request->title,
            'release_date' => $request->release_date,
            'isbn' => $request->isbn,
            'format' => $request->format,
            'number_of_pages' => intval($request->number_of_pages),
            'description' => $request->description,
        ]);

        return redirect()->route('authors.show', $request->author_id);
    }

    /**
     * Remove the specified book from storage
     * Sends DELETE request to API
     */
    public function destroy($id)
    {
        // Get authentication token from session
        $token = Session::get('access_token');
        // Send DELETE request to API
        Http::withToken($token)->delete(env('API_BASE_URL') . "/v2/books/$id");

        return back();
    }
}