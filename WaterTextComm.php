<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/30
 * Time: 20:14
 */
/*
 * 给图片添加水印文字
 */
$filename = 'images/001.jpg';
//获得图片信息
$fileInfo = getimagesize($filename);
//获得图片类型
$mime = $fileInfo['mime'];
//不同图片类型，使用不同函数根据图片创建画布
$createFun = str_replace('/','createfrom',$mime);
//不同图片类型，使用不同的函数输出图片
$outFun = str_replace('/',null,$mime);
//创建图片画布
$image = $createFun($filename);
//创建颜色，并添加透明度
$red = imagecolorallocatealpha($image,255,0,0,60);
//指定字体文件
$fontFile = 'Fonts/kaiu.ttf';
imagettftext($image,30,0,100,100,$red,$fontFile,'King的男神');
//告诉浏览器输出什么内容
header('content-type:'.$mime);
//输出图像
$outFun($image);
//销毁资源
imagedestroy($image);