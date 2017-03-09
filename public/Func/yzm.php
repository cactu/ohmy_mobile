<?php

    session_start();
    /**
     * 写个验证码玩玩
     **/

    // 1. 创建画布
    $img = imagecreatetruecolor(100, 40);

    // 2. 分配颜色，已经被函数拿下

    // 3. 填充背景
    imagefill($img, 0,0, lightColor($img));

    // 4. 画干扰点、画干扰线、写字
    for($i=0; $i<20; $i++){
        $x = mt_rand(0, 100);
        $y = mt_rand(0, 40);
        imagesetpixel($img, $x,$y, darkColor($img));
    }

    for($i=0; $i<5; $i++){
        $startX = mt_rand(0, 100);
        $startY = mt_rand(0, 40);
        $endX = mt_rand(0, 100);
        $endY = mt_rand(0, 40);
        imageline($img, $startX, $startY, $endX, $endY, darkColor($img));
    }

    //  写字相对要复杂一点点
    $str = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    $str = substr(str_shuffle($str),0,4);

    // 要记得将这个字符写入SESSION数组，在不久的将来有用
    $_SESSION['code'] = $str;

    // 写字
    $w = 100/4;

    for( $i=0; $i<4; $i++ ){
        $x = $w*$i+5;
        $y = mt_rand(10,40);

        imagettftext($img, 12.5, mt_rand(-30, 30), $x, $y, darkColor($img),  mt_rand(1,2).'.ttf', $str{$i});
    }

    // 5. 输出图片
    header("content-type:image/png");
    imagepng($img);

    // 6. 关闭图片资源
    imagedestroy($img);


    // 声明两个函数，专门用来产生颜色，一个是深色（写字 画干扰点 画干扰线 ） 一个是浅色(背景)
    function darkColor($img){
        return imagecolorallocate($img, mt_rand(0,120),  mt_rand(0,120),  mt_rand(0,120));
    }
    
    function lightColor($img){
        return imagecolorallocate($img, mt_rand(125,255),  mt_rand(125,255),  mt_rand(125, 255));
    }
