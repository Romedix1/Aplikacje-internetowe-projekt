<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'category'])->paginate(12);
        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with(['author', 'category', 'publisher', 'copies'])->findOrFail($id);

        return view('books.show', compact('book'));
    }
}