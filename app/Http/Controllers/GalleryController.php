<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    protected function getViewPath($view)
    {
        $role = Auth::user()->role ?? 'admin';
        return "{$role}.galleries.{$view}";
    }

    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view($this->getViewPath('index'), compact('galleries'));
    }

    public function create()
    {
        return view($this->getViewPath('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,jpg,png,webp|max:5120',
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');

        Gallery::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
        ]);

        return redirect()->route('galleries.index')->with('success', 'Gambar galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        return view($this->getViewPath('edit'), compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
        ]);

        $data = $request->only('judul', 'deskripsi');

        if ($request->hasFile('gambar')) {
            // Hapus file lama
            if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
                Storage::disk('public')->delete($gallery->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $gallery->update($data);

        return redirect()->route('galleries.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
            Storage::disk('public')->delete($gallery->gambar);
        }

        $gallery->delete();

        return redirect()->route('galleries.index')->with('success', 'Galeri berhasil dihapus.');
    }


    public function publicGallery()
{
    $galleries = \App\Models\Gallery::latest()->get();
    return view('public.gallery', compact('galleries'));
}


}
