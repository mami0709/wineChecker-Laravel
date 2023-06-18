<?php

namespace App\Http\Controllers;

use App\Models\ResultAkaWine;

class ResultAkaController extends Controller
{
    public function index()
    {
        // DBよりresult_aka_winesテーブルの値を全て取得
        $resultAka = ResultAkaWine::all();

        // エンコードオプションを指定してJSON形式にエンコードしてレスポンスとして返す
        return response()->json($resultAka, 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
