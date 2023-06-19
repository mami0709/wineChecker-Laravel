<?php

namespace App\Http\Controllers;

use App\Models\Recommend;
use Illuminate\Http\Request;

class RecommendController extends Controller
{
    public function index()
    {
        // DBよりrecommendsテーブルの値を全て取得
        $resultAka = Recommend::all();

        // JSON形式にエンコードしてレスポンスとして返す
        return response()->json($resultAka, 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function show($id)
    {
        // 指定されたIDのワイン情報を取得する
        $wineData = Recommend::find($id);

        if (!$wineData) {
            // データが存在しない場合は404エラーを返す
            return response()->json('Data not found', 404);
        }

        // JSON形式にエンコードしてレスポンスとして返す
        return response()->json($wineData, 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
