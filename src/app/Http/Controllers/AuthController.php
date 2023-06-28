<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use Exception;

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

            // トークンをDBに保存
            $user->token = $token;
            $user->save();

            return response()->json(['message' => 'ログイン成功', 'token' => $token]);
        } else {
            return response()->json(['error' => '認証失敗'], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->token()->revoke();
            return response()->json(['message' => 'ログアウトしました'], 200);
        }

        return response()->json(['message' => '認証されたユーザーが存在しません'], 404);
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

    public function getUser(Request $request)
    {
        try {
            // クエリパラメータからトークンを取得
            $token = $request->query('token');

            // トークンを使用して認証ユーザーを取得
            $user = User::where('token', $token)->first();

            // トークンに対応するユーザーがいない場合はエラーを返す
            if (!$user) {
                throw new Exception("Invalid token");
            }

            return response()->json([
                'id' => $user->id,
                'user_name' => $user->user_name,
                'user_name_hiragana' => $user->user_name_hiragana,
                'nickname' => $user->nickname,
                'mail_address' => $user->mail_address,
                'telephone_number' => $user->telephone_number,
                'user_password' => $user->user_password,
            ]);
        } catch (Exception $e) {
            Log::error('getUser error: ' . $e->getMessage());
            return response()->json(['message' => 'ユーザー情報の取得に失敗しました。'], 500);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            Log::info('updateUser called');

            // クエリパラメータからトークンを取得
            $token = $request->query('token');
            Log::info('Token: ' . $token);

            // トークンを使用して認証ユーザーを取得
            $user = User::where('token', $token)->first();
            Log::info('User: ', array($user));

            if (!$user) {
                throw new Exception("Invalid token");
            }

            // リクエストの内容をログに出力
            $requestData = json_decode($request->getContent(), true);
            Log::info('Request data: ', $requestData);

            // リクエストからユーザー情報を更新
            $user->user_name = $requestData['user_name'];
            $user->user_name_hiragana = $requestData['user_name_hiragana'];
            $user->nickname = $requestData['nickname'];
            $user->mail_address = $requestData['mail_address'];
            $user->telephone_number = $requestData['telephone_number'];
            $user->user_password = $requestData['user_password'];

            if ($requestData['user_password'] !== $user->user_password) {
                $user->user_password = Hash::make($requestData['user_password']);
            }

            $user->save();

            return response()->json(['message' => 'ユーザー情報が更新されました！']);
        } catch (Exception $e) {
            Log::error('updateUser error: ' . $e->getMessage());
            return response()->json(['message' => 'ユーザー情報の更新に失敗しました。'], 500);
        }
    }
}
