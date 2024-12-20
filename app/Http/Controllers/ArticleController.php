<?php

namespace App\Http\Controllers;

// app/Http/Controllers/ArticleController.php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\UserArtikel;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            'price' => $request->price,
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
        $article->price = $request->input('price');

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

    public function buy($id)
    {
        $article = Article::findOrFail($id);
        $brimoId = auth()->user()->brimo_id;

        if (empty($brimoId)) {
            return 0;
        }

        try {
            $client = new Client();
            $baseUrl = env('BRIMO_BASE_URL');

            // use post request
            $response = $client->request('POST', "$baseUrl/rekening/kredit", [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'user_id' => $brimoId,
                    'nominal' => $article->price,
                ],
            ]);
            $content = $response->getBody()->getContents();

            $data = json_decode($content, true);

            if (($data['success'] ?? null) == true) {
                UserArtikel::create([
                    'user_id' => auth()->id(),
                    'artikel_id' => $article->id
                ]);

                return redirect()->route('dashboard-user')->with('success', 'Artikel berhasil dibeli');
            } else {
                return redirect()->route('dashboard-user')->with('error', $data['message'] ?? 'Gagal membeli artikel');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('dashboard-user')->with('error', $th->getMessage());
        }
    }
}
