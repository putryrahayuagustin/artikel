<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class ArticleController extends BaseController
{
    // GET ARTCILE BY ID USER
    public function showALL(Request $request): JsonResponse
    {

        $articles = Article::latest()->get();

        if ($articles->isEmpty()) {
            return $this->sendError('404', 'Not Found');
        }

        foreach ($articles as $value) {
            $value->image = asset($value->image);
        }

        return $this->sendResponse($articles, 'Artikel anda Berhasil dimuat');
    }

    public function detailById(Request $request): JsonResponse
    {

        $article = Article::find($request->id);

        if ($article == null) {
            return $this->sendError('404', 'Not Found');
        }

        $article->image = asset($article->image);

        return $this->sendResponse($article, 'Artikel anda Berhasil dimuat');
    }


    public function store(Request $request): JsonResponse
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

            // Validasi gambar dan simpan ke public/images
            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $data['image'] = 'images/' . $imageName;
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Invalid or too large image. Max 2MB.'
                ], 422);
            }
        }

        $article = Article::create($data);


        return $this->sendResponse(
            [
                'message' => 'Article created successfully',
                'data' => $article
            ],
            201
        );
    }


    public function update(Request $request, String $id)
    {
        $article = Article::find($id);

        if ($article == NULL) {
            return $this->sendError('404', 'Not found');
        }

        // Ambil data `title` dan `body` secara eksplisit
        $title = $request->input('title');
        $body = $request->input('body');

        $dataToUpdate = [
            'title' => $title,
            'body' => $body,
        ];

        // Cek jika ada file image dalam request
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Validasi gambar
            $request->validate([
                'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048', // Maksimal 2MB
            ]);

            // Hapus gambar lama jika ada
            if ($article->image && file_exists(public_path($article->image))) {
                unlink(public_path($article->image));
            }

            // Simpan gambar baru
            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $dataToUpdate['image'] = 'images/' . $imageName;
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Invalid or too large image. Max 2MB.'
                ], 422);
            }
        }

        // Update artikel dengan data yang ada di $dataToUpdate
        $article->update($dataToUpdate);

        return $this->sendResponse(
            [
                'message' => 'Article updated successfully',
                'data' => $article->refresh()
            ],
            201
        );
    }


    public function destroy(String $id)
    {

        $article = Article::find($id);

        if ($article == NULL) {
            return  $this->sendError('404',  'ID Not Found');
        }

        $article->delete($id);

        return $this->sendResponse('success',  'Data berhasil di hapus');
    }
}
