<?php
       function postcurl($url,$data){
        $url=$url;
        //初始化curl
        $ch=curl_init();
        //通过 curl_setopt() 设置需要的全部选项
        curl_setopt($ch, CURLOPT_URL,$url);
        //禁止浏览器输出 ，使用变量接收
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST,1);
        //把数据传输过去
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        //执行会话
        $res=curl_exec($ch);
        //结束一个会话
        curl_close($ch);
       return $res;
    }

?>