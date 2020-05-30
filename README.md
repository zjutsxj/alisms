# alisms
使用在 Thinkphp5.1 里的阿里云 短信服务  

参考：https://help.aliyun.com/document_detail/55359.html?spm=a2c4g.11186623.4.3.79a04e6atw9hnY  
说明：[PHP]（仅支持5.5以上版本），[SDK轻量版]（轻量版支持php>=5.4，使用方法：先运行Test.php测试PHP环境，测试成功后再运行Demo）  

参考：https://github.com/aliyun/openapi-sdk-php  
本扩展只是封装了 [SDK轻量版] 实现的功能也只能发送验证码短信。

## install
```
composer require zjutsxj/alisms
```

### 配置文件config/alisms.php
```
<?php
return [
    'security' => false, // 是否启用https
    'host' => 'dysmsapi.aliyuncs.com', // 服务器

    'access_key' => '',
    'access_secret' => '',

    'cn_sign_name' => '', // 国内 短信签名
    'cn_temp_code' => '', // 国内 短信模板Code

    'en_sign_name' => '', // 国际 短信签名
    'en_temp_code' => '', // 国际 短信模板Code
];
```
### 使用
```
use yimao\alisms\Sms;

$sms = new Sms;
// 发送验证码 短信模板中有${code}变量
$sms->sendCode('18759201xxx', '123456');
// 发送动态密码 短信模板中有${password}变量
$sms->sendPassword('18759201xxx', '123456');
```

### config remark
|配置|类型|默认|必须配置|说明|
|-|-|-|-|-|
|security|boole|`false`|N|是否启用https|
|host|string|`dysmsapi.aliyuncs.com`|N|阿里云短信服务器域名|
|access_key|string||Y|你的阿里云accessKeyId|
|access_secret|string||Y|你的阿里云accessSecrect|
|sign_name|string||Y|短信签名|
|template_code|string||Y|短信模板|
