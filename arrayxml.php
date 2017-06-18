<?php
/**
 * Created by PhpStorm.
 * User: kobe
 * Date: 2017/6/18
 * Time: 下午1:06
 */


$arr = array(

      'name'=>'张三',
      'age'=>29,
      'job'=>array(

          'title'=>'经理',
          'salary'=>8888,
          'team'=>array('小明','小红','小黄')
      )

      );

     function arr2xml($arr,$node =null){
     //判断是否有根节点
         if($node ===null){
             $sim = new simpleXMLElement('<?xml version="1.0"  encoding="utf-8" ?><root></root>');
         }else{

             $sim = $node;
         }


          foreach ($arr as $k=>$v){
             if(is_array($v)){
                 arr2xml($v,$sim->addChild($k));
             }else if(is_numeric($k)){   //判断是否有数字
                 $sim->addChild('chenfei'.$k,$v);
             } else{
                 $sim->addChild($k,$v);
             }


         }

         return $sim->saveXML();

     }


     header('content-type:text/xml');
     echo  arr2xml($arr);

