<?php
declare (strict_types = 1);

namespace zjutsxj\sms;

use think\facade\Config;

class ThinkAliSms extends AliSms
{
    public function __construct($config = [])
    {
        $default = Config::get('alisms', []);
        $config = array_merge($default, $config);
        parent::__construct($config);
    }
}
