# alisms
php plugin for aliyun sms,only send sms
https://help.aliyun.com/document_detail/55359.html?spm=a2c4g.11186623.4.3.79a04e6atw9hnY

## install
```
composer require zjutsxj/alisms
```

### step1 新增配置文件config/alisms.php
```
<?php
return [
    'security' => false, // 是否启用https
    'host' => 'dysmsapi.aliyuncs.com', // 服务器

    'access_key' => '',
    'access_secret' => '',

    'sign_name' => '', // 短信签名
    'template_code' => '', // 短信模板Code
];
```
### step2 使用
#### example 1
```
use yimao\alisms\Sms;

$sms = new Sms;
$sms->sendSms('18759201xxx',['code'=>123456]);
```

## config remark
|配置|类型|默认|必须配置|说明|
|-|-|-|-|-|
|security|boole|`false`|N|是否启用https|
|host|string|`dysmsapi.aliyuncs.com`|N|阿里云短信服务器域名|
|region_id|string|`cn-hangzhou`|Y|阿里云短信服务器所在地区,请从阿里云短信服务获取|
|access_key|string||Y|你的阿里云accessKeyId|
|access_secret|string||Y|你的阿里云accessSecrect|
