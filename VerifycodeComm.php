<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/30
 * Time: 19:53
 */
/*
 * 生成验证码图片
 */
//定义验证码图片宽高
$width = 200;
$height = 40;
//创建画布
$image = imagecreatetruecolor($width,$height);
//创建颜色
$white = imagecolorallocate($image,255,255,255);
//绘制填充矩形
imagefilledrectangle($image,0,0,$width,$height,$white);
//快速创建字符串
$string = join('',array_merge(range(0,9),range('a','z'),range('A','Z')));
//制定验证码字符长度
$length = 4;
//获取随机颜色函数
function getRandColor($image)
{
    return imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
}
//绘制验证码字符串
for($i=0;$i<$length;$i++){
    $randColor = getRandColor($image);
    $size = mt_rand(20,28);
    $angle = mt_rand(-15,15);
    $x = 20+40*$i;
    $y = 30;
    $fontFile = 'Fonts/aparajb.ttf';
    $text = str_shuffle($string)[0];
    imagettftext($image,$size,$angle,$x,$y,$randColor,$fontFile,$text);
}
//添加干扰元素
//添加像素当做干扰元素
for($i=1;$i<=50;$i++){
    imagesetpixel($image,mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
}

//绘制线段当做干扰元素
for($i=1;$i<=3;$i++)
{
    imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
}
//绘制圆弧
for($i=1;$i<=2;$i++)
{
    imagearc($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width/2),mt_rand(0,$height/2),mt_rand(0,360),mt_rand(0,360),getRandColor($image));
}
//告诉浏览器以什么图像形式显示
header('content-type:image/png');
//输出图片
imagepng($image);
//销毁资源
imagedestroy($image);