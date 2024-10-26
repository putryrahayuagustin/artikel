<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    public function showALL(Request $request): JsonResponse
    {
        // Mengambil user login
        $user = $request->user();

        // Cek apakah pengguna terautentikasi
        if (!$user) {
            return $this->sendError('401', 'Unauthorized');
        }

        $articles = $user->articles()->where('category', 'Keperawatan')->get();

        if ($articles->isEmpty()) {
            return $this->sendError('404', 'Not Found');
        }

        return $this->sendResponse($articles, 'Artikel anda Berhasil dimuat');
    }
}
