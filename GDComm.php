<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/30
 * Time: 19:42
 */
/*
 * 使用GD库画图基本步骤
 */
//创建画布
$image = imagecreatetruecolor(500,500);
//创建颜色
$white = imagecolorallocate($image,255,255,255);
//绘制填充图形
imagefilledrectangle($image,0,0,500,500,$white);
//4.绘画
$randColor = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
imagettftext($image,20,0,100,100,$randColor,'Fonts/courbd.ttf','this is king show time');

//告诉浏览器以什么图像形式显示
header('content-type:image/png');
//输出图像
imagepng($image);
//保存文件
imagepng($image,'images/textpic.png');
//销毁资源
imagedestroy($image);
