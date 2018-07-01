<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/30
 * Time: 20:24
 */
/*
 * 添加水印图片
 */
$logo = 'images/logo.jpg';
//获得图片水印图片宽高
$logoInfo = getimagesize($logo);
list($src_w,$src_h) = $logoInfo;
//指定需要添加水印图片的图片
$filename = 'images/001.jpg';
//创建图片画布(讲$logo图片作为水印图片添加到$filename图片上去)
$dst_im = imagecreatefromjpeg($filename);
$src_im = imagecreatefromjpeg($logo);
//添加水印图片
imagecopymerge($dst_im,$src_im,100,0,0,0,$src_w,$src_h,30);
//告诉浏览器输出的文件内容
header('content-type:image/jpeg');
//输出图片，输出到文件时，在imagejpeg()函数第二个参数中指定目标文件路径
imagejpeg($dst_im);
//销毁资源
imagedestroy($src_im);
imagedestroy($dst_im);