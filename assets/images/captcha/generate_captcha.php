<?php

header("Content-type: image/jpeg");

$img_width = 350;
$img_height = 100;
$font_family = "TravelingTypewriter.ttf";
$min_bg_range = 0;
$max_bg_range = 150;
$min_digit_range = 4;
$max_digit_range = 7;
$min_charXaxis_range = 40;
$max_charXaxis_range = 45;
$min_charYaxis_range = 70;
$max_charYaxis_range = 80;
$min_charsize_range = 40;
$max_charsize_range = 60;
$min_charrotation_range = -10;
$max_charrotation_range = 10;
$min_txtcolor_range = 150;
$max_txtcolor_range = 255;
$char_pool = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "v", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
session_start();
$_SESSION['captcha_text'] = "";
$captcha_img;

$captcha_img = imagecreate($img_width, $img_height);
imagecolorallocate($captcha_img, mt_rand($min_bg_range, $max_bg_range), mt_rand($min_bg_range, $max_bg_range), mt_rand($min_bg_range, $max_bg_range));

for($i=0; $i<40; $i++){
    $y1 = mt_rand(1, 350);
    $x2 = mt_rand(1, 350);
    $y2 = mt_rand(1, 350);
    $x1 = mt_rand(1, 350);
    $linecolor = imagecolorallocate($captcha_img, mt_rand($min_txtcolor_range, $max_txtcolor_range), mt_rand($min_txtcolor_range, $max_txtcolor_range), mt_rand($min_txtcolor_range, $max_txtcolor_range));

    imageline($captcha_img, $x1, $y1, $x2, $y2, $linecolor);
}

for($i=0; $i<mt_rand($min_digit_range, $max_digit_range); $i++){
    $captcha_char = $char_pool[mt_rand(0, count($char_pool)-1)]; // Assign valuenya ke session.
    $_SESSION['captcha_text'] .= $captcha_char;
    $charXaxis = mt_rand($min_charXaxis_range, $max_charXaxis_range)*($i+1);
    $charYaxis = mt_rand($min_charYaxis_range, $max_charYaxis_range);
    $charsize = mt_rand($min_charsize_range, $max_charsize_range);
    $charrotation = mt_rand($min_charrotation_range, $max_charrotation_range);
    $txtcolor = imagecolorallocate($captcha_img, mt_rand($min_txtcolor_range, $max_txtcolor_range), mt_rand($min_txtcolor_range, $max_txtcolor_range), mt_rand($min_txtcolor_range, $max_txtcolor_range));

    imagettftext($captcha_img, $charsize, $charrotation, $charXaxis, $charYaxis, $txtcolor, "../../fonts/".$font_family, $captcha_char);
}

// echo $_SESSION['captcha_text'];
imagejpeg($captcha_img);