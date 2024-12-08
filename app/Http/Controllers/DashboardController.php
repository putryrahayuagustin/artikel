<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\UserArtikel;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('author')->get();
        $userArtikelIds = UserArtikel::where('user_id', auth()->user()->id)->pluck('artikel_id')->toArray();

        return view('user.dashboard-user', [
            'title' => 'Dashboard',
            'articles' => $articles,
            'userArtikelIds' => $userArtikelIds,
        ]);
    }
}
