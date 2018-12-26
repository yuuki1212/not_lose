<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client;

class RegisterController extends Controller
{
    /**
     * 新規登録
     * @param Request $request
     * @return
     */
    public function register(Request $request)
    {
        $data = $request->all();

        // バリデーションチェック
        $v = $this->validator($data);
        if ($v->fails()) {
            // バリデーションエラーの場合、エラーレスポンス
            $jsonError = response()->json($v->errors()->all(), 400);
            return Response::json($jsonError);
        }

        // ユーザー新規登録処理
        $user = $this->create($data);

        // 新規登録イベント
        event(new Registered($user));
        // クライアントの取得
        $client = Client::find(2);
        $request->request->add([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $data['email'],
            'password' => $data['password'],
            'scope' => null
        ]);
        $token = Request::create(
            'oauth/token',
            'POST'
        );
        return Route::dispatch($token);
    }

    /**
     * バリデーションチェック
     * @param Request $data
     * @return array
     */
    private function validator($data)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];

        return Validator::make($data, $rules);
    }

    /**
     *
     */
    private function create($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'is_delete' => 0
        ]);
    }

}