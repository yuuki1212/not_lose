<?php
/**
 * Created by PhpStorm.
 * User: kirin-dev31
 * Date: 2018/12/12
 * Time: 12:53
 */

trait JsonResponseTrait {
    protected $meta = null;
    protected $response_data = [
        'message' => null
    ];
    protected $errors = [];

    /**
     * JSONレスポンスの処理
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson ()
    {
        return response()->json($this->response_data);
    }

    /**
     * 成功
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data = null)
    {
        if (!empty($data)) {
            $this->response_data['data'] = $data;
        }
        return $this->responseJson();
    }

    /**
     * エラー
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function failure ($data)
    {
        if (!empty($data)) {
            $this->response_data['message'] = $data;
        }
        return $this->responseJson();
    }

}