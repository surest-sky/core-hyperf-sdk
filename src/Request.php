<?php

namespace Surest\CoreHyperfSdk;

use GuzzleHttp\Client;

class Request
{
    private $post = 'POST';
    private $get = 'GET';
    private $method;
    private $logger;
    private $timeout;
    private $params = [
        'headers' => [],
        'json' => []
    ];
    private $url = "http://hyperf.test/%s";

    public function __construct($method = 'POST')
    {
        $this->method = $method;
        $this->logger = new Logger();
        $this->timeout = Config::getConfig('request_time_out');
    }

    /**
     * 发起一个请求
     * User: surest
     * DateTime: 2021/11/25 3:48 下午
     */
    public function request($url, $data)
    {
        if (!$url) throw new RequestException("$url 不存在");
        $logger = $this->logger;
        $params = $this->params;
        $params['json'] = $data;
        $url = sprintf($this->url, $url);

        $client = new Client(['timeout' => $this->timeout, 'verify' => false]);
        $logger->info('request:', compact('url', 'params'));
        $method = strtoupper($this->method);
        $content = [];

        try {
            $logger->info('requesting: ', compact('url', 'params', 'method'));
            $response = $client->request($method, $url, $params);
            $content = $response->getBody()->getContents();
            $content = json_decode($content, true);
        } catch (\Exception $exception) {
            $errMsg = $exception->getMessage();
            $logger->info('request error: ', compact('url', 'params', 'errMsg', 'content', 'method'));
            return false;
        }

        $logger->info('request end: ', compact('url', 'params', 'content', 'method'));
        return $content;
    }

    /**
     * POST 请求
     * User: surest
     * DateTime: 2021/11/25 3:47 下午
     * @param string $method
     */
    public function post($method = 'POST', $url = "", $params = [])
    {
        $this->method = $method;
        return $this->request($url, $params);
    }

    /**
     * GET 请求
     * User: surest
     * DateTime: 2021/11/25 3:47 下午
     * @param string $method
     */
    public function get($method = 'GET', $url = "", $params = [])
    {
        $this->method = $method;
        return $this->request($url, $params);
    }

    /**
     * 设置请求方法
     * User: surest
     * DateTime: 2021/11/25 3:48 下午
     * @param string $method
     */
    public function setMethod($method = 'POST')
    {
        $this->method = $method;
    }
}