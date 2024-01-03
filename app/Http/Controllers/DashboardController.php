<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;
        $books = Book::latest()->where('user_id', $user)->paginate(15);
        if (request('search')) {
            $books = Book::latest()->where('user_id', $user)->where('judul', 'like', '%' . request('search') . '%')->paginate(15);
        }
        if (request('kategori')) {
            $books = Book::latest()->where('category_id', request('kategori'))->paginate(15);
        }
        return view('home.index', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('home.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'category_id' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'file' => 'required',
            'cover' => 'required|image',
        ]);

        $validatedData['user_id'] = auth()->user()->id;;
        $validatedData['file'] = $request->file('file')->store('books');
        $validatedData['cover'] = $request->file('cover')->store('covers');
        $store = Book::create($validatedData);
        if ($store) {
            return redirect('/dashboard')->with('success', 'Buku baru berhasil ditambahkan');
            exit;
        }
        return redirect('/dashboard')->with('fail', 'Buku baru gagal ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, $id)
    {
        $data = $book->find($id);
        return view('home.detail', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, $id)
    {
        $data = $book->find($id);
        $categories = Category::all();
        return view('home.edit', [
            'data' => $data,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, $id)
    {
        $data = $request->except(['_token', '_method']);
        $update = $book->find($id)->update($data);
        if ($update) {
            return redirect("/dashboard/$id")->with('success', 'Buku baru berhasil diubah');
            exit;
        }
        return redirect("/dashboard/$id")->with('fail', 'Buku baru gagal diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, $id)
    {
        $delete = $book->find($id)->delete();
        if ($delete) {
            return redirect('/dashboard')->with('success', 'Buku berhasil dihapus');
            exit;
        }
        return redirect('/dashboard')->with('fail', 'Buku gagal dihapus');
    }

    public function download($id) {
        $book = Book::find($id);
        $file = public_path('storage/' . $book->file);
        $headers = [
            'Content-Type' => 'application/pdf',
         ];
        return response()->download($file, "$book->judul.pdf", $headers);
    }
}
