<?php

namespace Surest\CoreHyperfSdk;

class Example
{
    public function test()
    {
        $config = [
            'logger_file_path' => __DIR__ . '/storage/logs',
            'version' => 'v1'
        ];
        $profile = new Profile($config);
        $profile->event(Profile::login)->send([
            'user_id' => 1
        ]);
    }
}