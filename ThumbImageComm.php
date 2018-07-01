<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/30
 * Time: 20:05
 */
/*
 * 生成图片缩略图
 */
$filename = 'images/001.jpg';
//得到图片的信息
$fileInfo = getimagesize($filename);
//获得图片宽高
list($src_w,$src_h) = $fileInfo;
;
//定义缩略图宽高
$dst_w = 100;
$dst_h = 100;
//创建目标画布资源
$dst_image = imagecreatetruecolor($dst_w,$dst_h);
//通过图片文件创建画布资源imagecreatefromjpeg(),imagecreatefrompng(),imagecreatefrompng()
$src_image = imagecreatefromjpeg($filename);
//创建缩略图
imagecopyresampled($dst_image,$src_image,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
//保存文件
imagejpeg($dst_image,'images/thumb_100x100.jpg');
//销毁资源
imagedestroy($src_image);
imagedestroy($dst_image);