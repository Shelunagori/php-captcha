<?php
session_start();
function generateCaptchaCode($characters=6) {
	/* list all possible characters */
	$captcha_string = '0123456789abcdefghijklmnopqrstvwyz';
	$code = '';
	for ($i=0;$i < $characters;$i++) { 
		$code .= substr($captcha_string, mt_rand(0, strlen($captcha_string)-1), 1);
	}          
	return $code;
}

function generateCaptchaImage($characters=6,$width='160',$height='40') {
        /*get random string */
		$code = generateCaptchaCode($characters);
		$font = 'C:\xampp\htdocs\php-captcha\captcha.ttf';	
		
        /* font size will be 75% of the image height */
        $font_size = $height * 0.75;
        $image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
        
		/* set the colours */
        $background_color = imagecolorallocate($image, 250, 250, 250);
        $text_color = imagecolorallocate($image, 10, 30, 80);
        $noise_color = imagecolorallocate($image, 150, 180, 220);
        
		/* generate random dots in background */
        for( $i=0; $i<($width*$height)/5; $i++ ) {
                imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
        }
        
		/* generate random lines in background */
        for( $i=0; $i<($width*$height)/200; $i++ ) {
                imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
        }
        
		/* create textbox and add text */
        $textbox = imagettfbbox($font_size, 0, $font, $code) or die('Error in imagettfbbox function');
        $x = ($width - $textbox[4])/2;
        $y = ($height - $textbox[5])/2;
        $y -= 5;
        imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code) or die('Error in imagettftext function');
        
		/* output captcha image to browser */
        header('Content-Type: image/jpeg');
        imagejpeg($image);
        imagedestroy($image);

        $_SESSION['captcha_code_value']=$code;
    }
	
generateCaptchaImage();
?>