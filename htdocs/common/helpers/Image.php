<?php

namespace common\helpers;

use Yii;

class Image
{
	 public static function cut($src, $size = 'original')
	 {
	 	$file 	= preg_split("~(.+/)~ui", $src);
	 	$file 	= str_replace("original", "", $file[1]);
	 	return pathinfo($src, PATHINFO_DIRNAME) . '/' . $size . $file;
	 }
}
?>