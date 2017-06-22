<?php
/**
 * Created by PhpStorm.
 * User: kobe
 * Date: 2017/6/22
 * Time: 上午10:17
 */
  $url ='http://news.163.com/17/0621/22/CNG650GS000189FH.html';
  $errornu = -1;
  $errstr = '';
  $fh = parse_url($url);
  //print_r($fh);

  if(!isset($fh['port'])){
      $fh['port'] = 80;
  }

 //用socket连接

  $conn = fsockopen($fh['host'],$fh['port'],$errornu,$errstr,3);
  if(!$conn){

      echo  " $errstr  ( $errnu )<br />\n" ;
  }else{


      $get = 'GET '.$fh['path'].' HTTP/1.1'.'\r\n';
      $get .= 'Host: '.$fh['host'].'\r\n';
      $get .=  "Connection: Close\r\n\r\n" ;
      fwrite($conn,$get);
      while(!feof($conn)){

          echo  fread ( $conn ,128 );
      }
     fclose($conn);
  }
