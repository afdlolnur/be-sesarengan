<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Datatables;

class ArticleController extends Controller
{
    public function data()
    {
        $article = Article::get();
        // dd($wisata);
        if (request()->ajax()){
            return datatables()->of($article)
            ->addColumn('aksi', function ($article)
            {
                $button = "  <button class='edit btn  btn-sm btn-warning' id='" . $article->id . "' data-bs-toggle='modal' data-bs-target='#default'>Edit</button>";
                $button .= " <button class='hapus btn  btn-sm btn-danger' id='" . $article->id . "' >Hapus</button>";
                return $button;
            })
        ->rawColumns(['aksi'])
        ->make(true);
        }
        return view('pages.article.index');
    }

    public function index()
    {
        return view('pages.article.index');
    }

    public function store(Request $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->is_publish = $request->is_publish;
        $article->description = $request->description;
        $simpan = $article->save();
        if($simpan){
            return response()->json(['data' => $article,
            'text'=>'article baru berhasil disimpan'],200);
        } else {
            return response()->json(['data' => $article,
            'text'=>'article berhasil disimpan']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $article = Article::find($id);
        return response()->json(['data' => $article]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $articles = [
            'title' => $request->title,
            'is_publish' => $request->is_publish,
            'description' => $request->description,
        ];
        $article = Article::find($id);
        $simpan = $article->update($articles);
        if ($simpan) {
            return response()->json(['text' => 'Berhasil Diubah'], 200);
        } else {
            return response()->json(['text' => 'Gagal diubah'], 422);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $article = Article::find($id);
        $article->delete();
        return response()->json(['text' => 'Berhasil dihapus'], 200);
    }
}
