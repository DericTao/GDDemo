<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/30
 * Time: 13:26
 */
/*
 * 验证码图片生成类
 */
Class Captcha{
    //字体文件
    private $_fontfile='';
    //
    private $_size = 28;
    //画布宽度
    private $_width=120;
    //画布高度
    private $_height=40;
    //验证码长度
    private $_length=4;

    //画布资源
    private $_image= null;

    //干扰元素*的个数
    private $_snow = 0;

    //干扰元素线条的条数
    private $_line = 5;

    //干扰元素像素个数
    private $_pixel = 80;

    public function __construct($config=array())
    {
        if(is_array($config)&& count($config)>0)
        {
            if(isset($config['fontfile'])&&is_file($config['fontfile'])&&is_readable($config['fontfile']))
            {
                $this->_fontfile = $config['fontfile'];
            }
            else
            {
                return false;
            }
            if(isset($config['size'])&&$config['size']>0)
            {
                $this->_size = (int)$config['size'];
            }
            if(isset($config['width'])&&$config['width']>0)
            {
                $this->_width = (int)$config['width'];
            }
            if(isset($config['height'])&&$config['height']>0)
            {
                $this->_height = (int)$config['height'];
            }
            if(isset($config['length'])&&config['length']>0)
            {
                $this->_length = $config['length'];
            }
            if(isset($config['snow'])&&$config['snow']>0)
            {
                $this->_snow = $config['snow'];
            }
            if(isset($config['pixel'])&&$config['pixel']>0)
            {
                $this->_pixel = $config['pixel'];
            }
            if(isset($config['line'])&&$config['line']>0)
            {
                $this->_line = $config['line'];
            }
            $this->_image = imagecreatetruecolor($this->_width,$this->_height);
        }
        else
        {
            return false;
        }
    }

    /*
     * 获得验证码图片
     */
    public function getCaptcha(){
        $white = imagecolorallocate($this->_image,255,255,255);
        imagefilledrectangle($this->_image,0,0,$this->_width,$this->_height,$white);
        //生成验证码
        $str = $this->_generateStr($this->_length);
        if(false === $str)
        {
            return false;
        }
        $fontfile = $this->_fontfile;

        //绘制验证码
        for($i=0;$i<$this->_length;$i++)
        {
            $size =$this->_size;
            $angle=mt_rand(-30,30);
            $x = ceil($this->_width/$this->_length)*$i+mt_rand(5,10);
            $y = ceil($this->_height/1.5);
            $color = $this->_getRandColor($this->_image);
            $text=$str[$i];
            imagettftext($this->_image,$size,$angle,$x,$y,$color,$fontfile,$text);
        }

        if($this->_snow>0)
        {
            $this->_getSnow();
        }
        else
        {
            $this->_getPixel();
            $this->_getLine();
        }

        header('content-type:image/png');
        imagepng($this->_image);
        imagedestroy($this->_image);
        return strtolower($str);
    }

    /*
     * 生成验证码字符串
     * @param $length Integer 验证码字符长度
     */
    private function _generateStr($length)
    {
        if($length<1 || $length>30)
        {
            return false;
        }
        $chars = array(
            'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
            'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
            0,1,2,3,4,5,6,7,8,9
        );

        $str = join('',array_rand(array_flip($chars),$length));
        return $str;
    }
    /*
     * 获得随机颜色值
     */
    private function _getRandColor()
    {
        return imagecolorallocate($this->_image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    }

    /*
     *  生成*干扰元素
     */
    private function _getSnow(){
        for($i=0;$i<$this->_snow;$i++)
        {
            imagestring($this->_image,mt_rand(1,5),mt_rand(0,$this->_width),mt_rand(0,$this->_height),'*',$this->_getRandColor());
        }

    }
    /*
     * 生成干扰像素
     */
    private function _getPixel()
    {
        for($i=0;$i<=$this->_pixel;$i++){
            imagesetpixel($this->_image,mt_rand(0,$this->_width),mt_rand(0,$this->_height),$this->_getRandColor());
        }
    }
    /*
     * 生成干扰线条
     */
    private function _getLine()
    {
        for($i=0;$i<=$this->_line;$i++)
        {
            imageline($this->_image,mt_rand(0,$this->_width),mt_rand(0,$this->_height),mt_rand(0,$this->_width),mt_rand(0,$this->_height),$this->_getRandColor());
        }
    }


}
