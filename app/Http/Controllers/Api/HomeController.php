<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\Space;
use Illuminate\Http\Request;

class HomeController extends ApiBaseController
{
    /**
     * Spaceの取得
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $space_id)
    {
        $data = $request->all();

        // バリデーションルール
        $rules = [
            'user_id' => 'required|numeric',
            'space_id' => 'numeric',
            'category_id' => 'numeric',
            'usages_id' => 'numeric',
            'main_no' => 'numeric',
            'tree_no' => 'required_with:main_no|numeric'
        ];

        // バリデーションチェック
        $v = \Validator::make($request->all(), $rules);

        if ($v->fails()) {
            // バリデーションエラーの場合、エラーレスポンス
            return $this->failure($v->errors()->all());
        }
        $spaces = Space::where('user_id', $data['user_id']);
        $items = Item::where('user_id', $data['user_id']);
        if ($data['space_id'] != null && $data['space_id'] != 0) {
            $spaces->where('space_id', $data['space_id']);
            $items->where('space_id', $data['space_id']);
        }
        if ($data['category_id'] != null) {
            $spaces->where('category_id', $data['category_id']);
            $items->where('category_id', $data['category_id']);
        }
        if ($data['usages_id'] != null) {
            $spaces->where('usages_id', $data['usages_id']);
            $items->where('usages_id', $data['usages_id']);
        }
        $spaces->get();
        $items->get();

        $result = [];
        foreach ($spaces as $space) {
            $list = ['space' => $space];
            array_merge($result, $list);
        }
        foreach ($items as $item) {
            $list = ['item' => $item];
            array_merge($result, $list);
        }
        return $this->success($result);
    }


    /**
     * @param Request $request
     * @param $main_no
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request, $main_no)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required|',
            'capacity' => 'numeric',
            'category_id' => 'required|numeric'
        ];

        $v = \Validator::make($request->all(), $rules);

        if ($v->fails()) {
            return $this->failure($v->errors()->all());
        }


        $tree_no = 0;
        if ($main_no != null) {
            $tree_no = Space::where('main_no', $main_no)->count();
        } else {
            $main_no = 0;
        }
        Space::create([
            'name' => $data['name'],
            'main_no' => $main_no,
            'tree_no' => $tree_no,
            'comment' => $data['comment'],
            'capacity' => $data['capacity'],
            'category_id' => $data['category_id'],
            'is_show' => 1,
            'is_delete' => 0,
        ]);

        $this->success();
    }
}
