<?php

namespace App\Http\Controllers;

use App\Models\Recommend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


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

    public function store(Request $request)
    {
        // バリデーションルールを定義
        $rules = [
            'wine_name' => 'required|max:50',
            'english_wine_name' => 'max:50',
            'winery' => 'required|max:20',
            'wine_type' => 'required|max:10',
            'wine_image' => 'required|max:500',
            'wine_country' => 'required|max:20',
            'wine_url' => 'required|max:500',
            'years' => 'nullable|integer',
            'producer' => 'max:30',
            'breed' => 'required|max:50',
            'capacity' => 'nullable|integer',
            'one_word' => 'max:100',
            'comment' => 'max:500'
        ];


        $messages = [
            'wine_name.required' => 'ワイン名が未入力です',
            'winery.required' => 'ワイナリーが未入力です',
            'wine_type.required' => 'ワインの種類が未入力です',
            'wine_image.required' => 'ワインの画像が未入力です',
            'wine_country.required' => '産地が未入力です',
            'wine_url.required' => 'ワインのURLが未入力です',
            'breed.required' => 'ぶどうの種類が未入力です',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // バリデーションを実行
        $request->validate($rules);

        // リクエストからデータを取得
        $data = $request->all();

        // 新しいレコードを作成
        $recommend = new Recommend;
        $recommend->fill($data);

        Log::info('Attempting to save data', $data);

        // データを保存
        $recommend->save();

        Log::info('Data saved successfully');

        // 成功メッセージとともに201ステータスコードを返す
        return response()->json(['message' => 'ワインの投稿が完了しました！'], 201);
    }
}
