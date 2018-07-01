<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/30
 * Time: 20:56
 */
include_once 'Captcha.class.php';
$config=array(
    'fontfile' => 'fonts/kartika.ttf',
);
$captcha = new Captcha($config);
session_start();
$_SESSION['verifyCode'] = $captcha->getCaptcha();