<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', [
            'categories' => $categories,
        ]);
    }

    public function indexDashboard()
    {
        $categories = Category::all();
        return view('category.index', [
            'categories' => $categories,
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validate([
            'kategori' => 'required',
        ]);

        $store = Category::create($validatedData);
        if ($store) {
            return redirect('/kategori')->with('success', 'Kategori baru berhasil ditambahkan');
            exit;
        }
        return redirect('/kategori')->with('fail', 'Kategori baru gagal ditambahkan');
    }

    public function update(UpdateCategoryRequest $request, Category $category, $id)
    {
        
        $update = $category->find($id)->update(['kategori' => $request->kategori]);
        if ($update) {
            return redirect('/kategori')->with('success', 'Kategori baru berhasil diedit');
            exit;
        }
        return redirect('/kategori')->with('fail', 'Kategori baru gagal diedit');
    }

    public function destroy(Category $category, $id)
    {
        $destroy = $category->find($id)->delete();
        if ($destroy) {
            return redirect('/kategori')->with('success', 'Kategori baru berhasil dihapus');
            exit;
        }
        return redirect('/kategori')->with('fail', 'Kategori baru gagal dihapus');
    }
}
