<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $categories = Category::when($search, function ($query) use ($search) {

        $query->where('name', 'like', '%' . $search . '%');

    })->latest()->get();

    return view('admin.categories.index', compact('categories'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }

    
}