<?php

namespace App\Http\Controllers;

use App\Models\Recommend;

class RecommendController extends Controller
{
    public function index()
    {
        // DBよりrecommendsテーブルの値を全て取得
        $resultAka = Recommend::all();

        // エンコードオプションを指定してJSON形式にエンコードしてレスポンスとして返す
        return response()->json($resultAka, 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
