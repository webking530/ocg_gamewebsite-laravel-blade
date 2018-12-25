<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookiesController extends Controller
{
    public function setNewsCookies(Request $request) {
        if ($request->hasCookie('viewed_news')) {
            $viewedNews = json_decode($request->cookie('viewed_news'));
        } else {
            $viewedNews = [];
        }

        $unreadNews = array_map(function($item) {
            return intval($item);
        }, $request->get('news'));

        $viewedNews = array_unique(array_merge($viewedNews, $unreadNews));

        return response()->json($viewedNews)->withCookie(cookie('viewed_news', json_encode($viewedNews), 24 * 60 * 30));
    }

    public function countUnreadNews(Request $request) {
        if ($request->hasCookie('viewed_news')) {
            $viewedNews = json_decode($request->cookie('viewed_news'));
        } else {
            $viewedNews = [];
        }

        $unreadNews = array_map(function($item) {
            return intval($item);
        }, $request->get('news'));

        return count(array_diff($unreadNews, $viewedNews));
    }
}
