<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class SpacesController extends ApiBaseController
{
    /**
     * Spaceの取得
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $request->all();

        // バリデーションルール
        $rules = [
            'limit'     => 'required|numeric|max:1000',
            'category_id'  => 'numeric',
            'usages_id'    => 'numeric'
        ];

        // バリデーションチェック
        $v = Validator::make($request->all(), $rules);

        if ($v->fails()) {
            // バリデーションエラーの場合、エラーレスポンス
            return $this->failure($v->errors()->all());
        }



        // 新規登録イベント
        event(new Registered($user));

        //
    }


    public function add(Request $request)
    {

    }
}
