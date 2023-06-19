<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = ['mail_address' => $request->email, 'password' => $request->password];

        // 認証が成功したら
        if (Auth::attempt($credentials)) {
            // ログイン中のユーザーを取得
            $user = User::where('mail_address', $request->email)->first();
            // ユーザーに新しいトークンを生成
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json(['message' => 'ログイン成功', 'token' => $token]);
        } else {
            return response()->json(['error' => '認証失敗'], 401);
        }
    }

    public function register(Request $request)
    {
        // バリデーションルール
        $rules = [
            'mail_address' => 'required|string|email|max:50|unique:users',
            'user_password' => 'required|string|min:6',
        ];

        // バリデーションエラーメッセージ
        $messages = [
            'mail_address.required' => 'メールアドレスは必須項目です。',
            'mail_address.string' => 'メールアドレスは文字列である必要があります。',
            'mail_address.email' => 'メールアドレスの形式が不正です。',
            'mail_address.max' => 'メールアドレスは50文字以内で入力してください。',
            'mail_address.unique' => 'そのメールアドレスは既に使用されています。',
            'user_password.required' => 'パスワードは必須項目です。',
            'user_password.string' => 'パスワードは文字列である必要があります。',
            'user_password.min' => 'パスワードは6文字以上で入力してください。',
        ];

        // バリデーションを実行
        $validatedData = $request->validate($rules, $messages);

        // バリデーションが通れば、以下にユーザー登録の処理を書くことができます
        $validatedData['user_password'] = bcrypt($request->user_password);

        $user = User::create([
            'mail_address' => $validatedData['mail_address'],
            'user_password' => $validatedData['user_password'],
            'token' => Str::random(60),  // ランダムなトークンを作成
        ]);

        return response()->json(['message' => 'ユーザーが正常に登録されました。']);
    }
}
