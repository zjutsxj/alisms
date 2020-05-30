<?php
namespace yimao\alisms;

use think\facade\Config;
use yimao\alisms\SignatureHelper;

/**
 * 阿里云发送短信
 */
class Sms
{
    // 默认配置
    private $config = [
        'security' => false, // 是否启用https
        'host' => 'dysmsapi.aliyuncs.com', // 服务器

        'access_key' => '',
        'access_secret' => '',

        'cn_sign_name' => '', // 国内 短信签名
        'cn_temp_code' => '', // 国内 短信模板Code

        'en_sign_name' => '', // 国际 短信签名
        'en_temp_code' => '', // 国际 短信模板Code
    ];

    private $error = 'not error';

    public function __construct($config = [])
    {
        // 配置文件
        $default = Config::get('alisms.', []);

        // 生成配置
        $config = array_merge($default, $config);

        // 合并配置
        $this->config = array_merge($this->config, $config);
    }

    // 发送验证码
    public function sendCode($phone, $code)
    {
        $config = $this->config;
        $keys = ['access_key', 'access_secret', 'cn_sign_name', 'cn_temp_code'];
        foreach ($keys as $key) {
            if (empty($config[$key])) {
                $this->error = $key . ' 不存在!';
                return false;
            }
        }

        $params = array();

        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $phone;

        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = $config['cn_sign_name'];

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = $config['cn_temp_code'];

        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = array(
            "code" => $code,
        );

        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        $params = array_merge($params, array(
            "RegionId" => "cn-hangzhou",
            "Action" => "SendSms",
            "Version" => "2017-05-25",
        ));

        $helper = new SignatureHelper;
        // 此处可能会抛出异常，注意catch
        try {
            $content = $helper->request($config['access_key'], $config['access_secret'], $config['host'], $params, $config['security']);
            return $content;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
        return false;
    }

    // 发送密码
    public function sendPassword($phone, $password)
    {
        $config = $this->config;
        $keys = ['access_key', 'access_secret', 'cn_sign_name', 'cn_temp_code'];
        foreach ($keys as $key) {
            if (empty($config[$key])) {
                $this->error = $key . ' 不存在!';
                return false;
            }
        }

        $params = array();

        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $phone;

        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = $config['cn_sign_name'];

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = $config['cn_temp_code'];

        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = array(
            "password" => $password,
        );

        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        $params = array_merge($params, array(
            "RegionId" => "cn-hangzhou",
            "Action" => "SendSms",
            "Version" => "2017-05-25",
        ));

        $helper = new SignatureHelper;
        // 此处可能会抛出异常，注意catch
        try {
            $content = $helper->request($config['access_key'], $config['access_secret'], $config['host'], $params, $config['security']);
            return $content;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
        return false;
    }
}
