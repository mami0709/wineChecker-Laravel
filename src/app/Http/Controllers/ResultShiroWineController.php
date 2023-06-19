<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResultShiroWine;

class ResultShiroWineController extends Controller
{
    public function index()
    {
        // DBよりresult_shiro_winesテーブルの値を全て取得
        $resultShiro = ResultShiroWine::all();

        // エンコードオプションを指定してJSON形式にエンコードしてレスポンスとして返す
        return response()->json($resultShiro, 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
