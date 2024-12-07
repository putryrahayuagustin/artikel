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

            $image = $request->file('image');


            if ($image->isValid() && in_array($image->getClientOriginalExtension(), ['jpeg', 'jpg', 'png', 'gif']) && $image->getSize() <= 2048000) { // Maksimal 2MB
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->move(public_path('images'), $imageName);
                $data['image'] = 'images/' . $imageName;
            } else {
                return back()->withErrors(['image' => 'Gambar tidak valid atau terlalu besar. Maksimal 2MB.']);
            }
        }

        Article::create($data);

        return redirect()->route('dashboard-user')->with('success', 'Artikel berhasil ditambahkan!');
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


    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('form.article-edit', compact('article'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article = Article::findOrFail($id);

        $article->title = $request->input('title');
        $article->category = $request->input('category');
        $article->body = $request->input('body');

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->move(public_path('images'), $imageName);

                $article->image = 'images/' . $imageName;
            } else {
                return back()->withErrors(['image' => 'Gambar tidak valid.']);
            }
        }

        $article->save();

        return redirect()->route('myArticle')->with('success', 'Artikel berhasil diperbarui');
    }
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('myArticle')->with('success', 'Artikel berhasil dihapus');
    }
}
