<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //注册
    public function add(){
        return view('login.add');
    }
    //注册执行
    public function adddo(){
        $user_name=request()->input('user_name');
        $user_pass=request()->input('user_pass');
        $user_email=request()->input('user_email');

        $postInfo=[
            'name'=>$user_name,
            'pass'=>$user_pass,
            'email'=>$user_email

         ];
        $json_str=json_encode($postInfo);
        //获取私钥
        //echo storage_path('app/keys/private.pem');die;
        $k=openssl_pkey_get_private('file://'.storage_path('app/keys/private.pem')); //获取私钥
        openssl_private_encrypt($json_str,$enc_date,$k);//使用私钥加密数据(把加密的值放到了 $enc_date)
        $b4=base64_encode($enc_date);
        //调用curl
        $url="http://api.1809a.com/loginadd";
        echo postcurl($url,$b4);
    }
    //登录
    public function login(){
        return view('login.login');
    }
    //登录执行
    public function logina(){
        $email=request()->input('email');
        $pass=request()->input('pass');
        $postInfo=[
            'pass'=>$pass,
            'email'=>$email
         ];
        $json_str=json_encode($postInfo);
        //获取私钥
        //echo storage_path('app/keys/private.pem');die;
        $k=openssl_pkey_get_private('file://'.storage_path('app/keys/private.pem')); //获取私钥
        openssl_private_encrypt($json_str,$enc_date,$k);//使用私钥加密数据(把加密的值放到了 $enc_date)
        $b4=base64_encode($enc_date);
        //调用curl
        $url="http://api.1809a.com/logina";
        echo postcurl($url,$b4);
    }

}
