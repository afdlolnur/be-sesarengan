<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function all(Request $request)
    {
        // $limit = $request->input('limit', 100);
        $article = Article::query()->select('id','title','description','created_at')->orderBy('created_at','desc');

        return ResponseFormatter::success(
            $article->get(),
            'Data semua artikel berhasil diambil'
        );
    }
}
