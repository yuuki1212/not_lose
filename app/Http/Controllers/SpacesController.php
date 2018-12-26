<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpacesController extends Controller
{
    //
    public function getSpaces(Request $request){
        // バリデーションルール
        $rules = [
            '' => '',
        ];

        // バリデーションチェック
        $v = Validator::make($request->all(), $rules);

        if ($v->fails()) {
            // バリデーションエラーの場合、エラーレスポンス
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        // ユーザー新規登録処理
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'is_delete' => 0
        ]);

        // 新規登録イベント
        event(new Registered($user));

        //
    }
}
