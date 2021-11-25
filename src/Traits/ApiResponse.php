<?php

namespace Surest\CoreHyperfSdk\Traits;

trait ApiResponse
{
    /**
     * 正确码
     * @var int
     */
    private $code = 200;

    /**
     * 异常码
     * @var int
     */
    private $errCode = 200;

    /**
     * Api 成功响应
     * DateTime: 2021/11/25 3:44 下午
     * @param array $data
     * @param string $message
     * @return false|string
     */
    public function success($data = [], $message = '')
    {
        return $this->response($data, $message, $this->errCode);
    }

    /**
     * Api 失败响应
     * User: surest
     * DateTime: 2021/11/25 3:39 下午
     */
    public function error($message = 'error', $data = [])
    {
        return $this->response($data, $message, $this->errCode);
    }

    /**
     * 响应
     * User: surest
     * DateTime: 2021/11/25 3:43 下午
     * @param $data array
     * @param $message string
     * @param $code int
     * @return false|string
     */
    private function response($data, $message, $code)
    {
        return json_encode(compact('data', 'message', 'code'));
    }
}