<?php

namespace Surest\CoreHyperfSdk;

/**
 * 教师资料变更
 */
class Profile
{
    /**
     * 注册
     * @var int
     */
    const register = 1;

    /**
     * 登录
     * @var int
     */
    const login = 2;

    /**
     * 入职
     * @var int
     */
    const induction = 3;

    /**
     * 触发事件
     * @var string
     */
    protected $event;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Url
     * @var string
     */
    protected $url = '/%s/user/profile/%s';

    /**
     * @throws ConfigException
     */
    public function __construct($config = [])
    {
        Config::loadConfig($config);
        $this->request = new Request();
    }

    /**
     * 获取有效事件
     * User: surest
     * DateTime: 2021/11/25 4:58 下午
     * @return string[]
     */
    public function events()
    {
        return [
            self::register => 'register',
            self::login => 'register',
            self::induction => 'induction',
        ];
    }

    /**
     * 设置请求头
     * User: surest
     * DateTime: 2021/11/25 4:27 下午
     * @param $data
     */
    public function header($data)
    {
    }

    /**
     * 设置事件
     * DateTime: 2021/11/25 4:23 下午
     * @param string $event
     * @return $this
     */
    public function event($event = '')
    {
        try {
            $this->event = $event;
            $this->url = sprintf($this->url, Config::getConfig('version'), $this->events()[$this->event]);
        } catch (\Exception $exception) {
            throw new RequestException("event 【匹配的事件不存在】#333");
        }
        return $this;
    }

    /**
     * 设置内容
     * User: surest
     * DateTime: 2021/11/25 4:23 下午
     * @return array | bool
     */
    public function send($content = [])
    {
        return $this->request->request($this->url, $content);
    }
}