<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function showArticleCreationForm()
    {
        return view('article.create');
    }

    public function publish(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'body' => 'required|min:10'
        ]);
        if ($request->ajax()) return;

        return $request->all();
    }
}
