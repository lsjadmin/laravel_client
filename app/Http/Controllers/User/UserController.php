<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //对称加密（加密）
    public function encrypt(){
        $data = 'hello word';//加密明文
        $method = 'AES-256-CBC';//加密方法
        $key = '123';//加密密钥
        $options = OPENSSL_RAW_DATA;//数据格式选项（可选）
        $iv='aassddffgghhjjkl';
        $result = openssl_encrypt($data, $method, $key, $options,$iv);
       // echo $result;
        $b64=base64_encode($result);
        $url=urlencode($b64);
        echo '原文:'.$url;echo "<hr>";
    }

    //凯撒加密
    function aencry($str){
        $count=strlen($str);
        $p1='';
        for($i=0;$i<$count;$i++){
            $p0=ord($str[$i])+1;
            $p1.=chr($p0);
        }
        return $p1;
    }
    //凯撒解密
    public function a(){
        $str='abc';
        $a=$this->aencry($str);
        echo $a;
        // $str='bcd';
        // // echo $str;die;
        // $count=strlen($str);
        // for($i=0;$i<$count;$i++){
        // $p0=ord($str[$i])-1;
        // $p1=chr($p0);
        // echo $p1;
            //  }
      
        
    }
    //对称加密（解密）
    public function decode(){
        $method = 'AES-256-CBC';//加密方法
        $key = '123';//加密密钥
        $options = OPENSSL_RAW_DATA;//数据格式选项（可选）
        $iv='aassddffgghhjjkl';
        //解密
        $a=$_GET['str'];
        $deb64=base64_decode($a);
        //echo $deb64;die;
        $resulta = openssl_decrypt($deb64, $method, $key, $options,$iv);
        echo '密文:'.$resulta;echo "<hr>";

    }
    
    
        

}
