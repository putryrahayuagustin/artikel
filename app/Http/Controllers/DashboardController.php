<?php

namespace App\Http\Controllers;

use App\Models\Article;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('author')->get();

        return view('user.dashboard-user', [
            'title' => 'Dashboard',
            'articles' => $articles,
        ]);
    }
}
