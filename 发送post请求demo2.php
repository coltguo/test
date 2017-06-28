<?php
/**
 * Created by PhpStorm.
 * User: kobe
 * Date: 2017/6/27
 * Time: 下午9:57
 */

    $data= "username=zhangsan&age=8";
    $len =strlen($data);
    //print_r($len);die;
    $errornu = -1;
    $errstr = '';
    $url= 'http://127.0.0.1/socket/post.php';
    $fh = parse_url($url);
    //print_r($fh);die;
    if(!isset($fh['port'])){
        $fh['port'] = 80;
    }
    $conn = fsockopen($fh['host'],$fh['port'],$errornu,$errstr,3);
    //print_r($conn);die;
    if(!$conn){

        echo  " $errstr  ( $errornu )<br />\n" ;
    }else{


        $post = 'POST '.$fh['path'].' HTTP/1.1'."\r\n";
        $post .= 'Host: '.$fh['host']."\r\n";
        $post .= 'Content-type: application/x-www-form-urlencoded'."\r\n";
        $post .= 'Content-length:'.' '.$len."\r\n";
        $post .=  "Connection: Close\r\n\r\n" ;
        $post .=$data;
        //echo $post;die;
        fwrite($conn,$post);
        while(!feof($conn)){

            echo  fgets( $conn ,128 );

        }

        fclose($conn);
    }