<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $books = Book::latest()->paginate(15);
        if (request('search')) {
            $books = Book::latest()->where('judul', 'like', '%' . request('search') . '%')->paginate(15);
        }
        if (request('kategori')) {
            $books = Book::latest()->where('category_id', request('kategori'))->paginate(15);
        }
        return view('home.index', [
            'books' => $books,
        ]);
    }

    public function detail($id) {
        return dd($id);
    }
}
