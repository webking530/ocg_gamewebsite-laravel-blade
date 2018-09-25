<?php

namespace App\Http\Controllers;

use Models\News\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news(News $news) {
        return view('frontend.news', compact('news'));
    }
}
