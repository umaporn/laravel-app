<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books,isbn',
            'published_date' => 'date'
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'published_date' => 'date'
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');
    }

    public function addBook(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'published_date' => 'date'
        ]);
        $client = new Client();

        try {
            $result = $client->request('POST', env('FIREBASE_CLOUD_FUNCTION_URL'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'form_params' => [
                    'title' => $request->input('title'),
                    'author' => $request->input('author'),
                    'isbn' => $request->input('isbn'),
                    'published_date' => $request->input('published_date')
                ]
            ]);
            dd($result);
            $response = $result->getBody()->getContents();
            // if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            //     return redirect()->back()->with('success', 'Book added successfully via Firebase');
            // } else {
            //     return redirect()->back()->with('error', 'Failed to add book via Firebase');
            // }
        } catch (GuzzleException $guzzleException) {

            $response = $guzzleException->getMessage();
            dd($response);
        }

        return json_decode($response, true);
    }
}
