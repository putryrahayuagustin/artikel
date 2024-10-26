<?php

namespace App\Http\Controllers;

// app/Http/Controllers/ArticleController.php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {



        return view('user.dashboard-artikel', compact('articles'));
    }


    public function form()
    {
        return view('form.artikel_form',);
    }

    public function create(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'body' => 'required|string',
            'category' => 'required|string|max:65535',
        ]);

        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'category' => $request->category,
            'user_id' => auth()->id(),
        ];

        if ($request->hasFile('image')) {
            // Mendapatkan file gambar
            $image = $request->file('image');

            // Memeriksa ukuran dan jenis file
            if ($image->isValid() && in_array($image->getClientOriginalExtension(), ['jpeg', 'jpg', 'png', 'gif']) && $image->getSize() <= 2048000) { // Maksimal 2MB
                $imageName = time() . '.' . $image->getClientOriginalExtension(); // Memberikan nama unik untuk file
                $imagePath = $image->move(public_path('images'), $imageName); // Pindahkan gambar ke public/images
                $data['image'] = 'images/' . $imageName; // Simpan jalur relatif ke database
            } else {
                return back()->withErrors(['image' => 'Gambar tidak valid atau terlalu besar. Maksimal 2MB.']);
            }
        }

        Article::create($data);

        return redirect()->route('dashboard-user')->with('success', 'Artikel berhasil disimpan!');
    }

    public function myArticleView(Request $request)
    {
        $user = $request->user();
        $articles = Article::where('user_id', $user->id)->get();

        return view('user.myArticle', ['title' => 'MyArticle', 'articles' => $articles]);
    }

    public function detail($id)
    {
        $article = Article::with('author')->findOrFail($id);

        return view('user.articleDetail', ['article' => $article]);
    }
}
