<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class SpacesController extends ApiBaseController
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
            return $this->failure($v->errors()->all());
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
