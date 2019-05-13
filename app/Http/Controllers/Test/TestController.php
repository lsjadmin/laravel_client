<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    //对称加密
    public function encrypt(){
        $postInfo=[
            'name'=>'zhangsan',
            'email'=>'3023668879@qq.com'
        ];
        $json_str=json_encode($postInfo);

        $method = 'AES-256-CBC';//加密方法
        $key = '123';//加密密钥
        $options = OPENSSL_RAW_DATA;//数据格式选项（可选）
        $iv='aassddffgghhjjkl';
        $result = openssl_encrypt($json_str, $method, $key, $options,$iv);
       // echo $result;

        $b64=base64_encode($result);
            // echo '原文:'.$b64;echo "<hr>";
            $url="http://api.1809a.com/test";
            echo postcurl($url,$b64);
    }
    //非对称加密
    public function openssl(){
       // echo "a";
        $postInfo=[
            'name'=>'zhangsan',
            'email'=>'3023668879@qq.com'
         ];
        $json_str=json_encode($postInfo);
        //获取私钥
        //echo storage_path('app/keys/private.pem');die;
        $k=openssl_pkey_get_private('file://'.storage_path('app/keys/private.pem')); //获取私钥
        openssl_private_encrypt($json_str,$enc_date,$k);//使用私钥加密数据(把加密的值放到了 $enc_date)
        $b4=base64_encode($enc_date);
        //调用curl
        $url="http://api.1809a.com/openssl";
        echo postcurl($url,$b4);

    }
    //验证签名
    public function sgin(){
    
       $info=[
           'name'=>'oppo',
           'price'=>'2000',
       ];
       $json_str=json_encode($info);
         //获取私钥
        //echo storage_path('app/keys/private.pem');die;
        $k=openssl_pkey_get_private('file://'.storage_path('app/keys/private.pem')); //获取私钥
        openssl_sign($json_str,$sign,$k);
       // echo $sign;echo "<hr>";
        $b4=urlencode(base64_encode($sign));
        //echo $sign;
        //调用curl
        $url="http://api.1809a.com/sgin?sign=".$b4;
        
        //echo $url;die;
        echo postcurl($url,$json_str);
    }
}
