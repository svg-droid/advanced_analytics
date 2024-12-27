<?php
function createThumbs($file, $pathToThumbs, $thumbWidth ,$thumbHeight =0,$filepath='')
{
 $pathToImages=$filepath.$file;
  $info = pathinfo($pathToImages);
    if ( strtolower($info['extension']) == 'jpg'  or  strtolower($info['extension']) == 'jpeg')
    {
      $img = imagecreatefromjpeg($pathToImages);
      $width = imagesx( $img );
      $height = imagesy( $img );
	  if($thumbWidth >0)	  
      	$new_width = $thumbWidth;
	  else
		$new_width = floor( $width * ( $thumbHeight / $height ) );	
	  if($thumbHeight >0)
	  	$new_height = $thumbHeight;
	  else
     	$new_height = floor( $height * ( $thumbWidth / $width ) );
     $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      //imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	  imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
      imagejpeg( $tmp_img, $pathToThumbs.$file ,100);
  }
  else if(strtolower($info['extension']) == 'gif')
  {
   $img = imagecreatefromgif($pathToImages);
      $width = imagesx( $img );
      $height = imagesy( $img );
	  if($thumbWidth >0)	  
      	$new_width = $thumbWidth;
	  else
		$new_width = floor( $width * ( $thumbHeight / $height ) );	
	  if($thumbHeight >0)
	  	$new_height = $thumbHeight;
	  else
     	 $new_height = floor( $height * ( $thumbWidth / $width ) );
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      //imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	  imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
       imagegif( $tmp_img, $pathToThumbs.$file );
  } else if(strtolower($info['extension']) == 'png')
  {
   $img = imagecreatefrompng($pathToImages);
      $width = imagesx( $img );
      $height = imagesy( $img );
	  if($thumbWidth >0)	  
      	$new_width = $thumbWidth;
	  else
		$new_width = floor( $width * ( $thumbHeight / $height ) );	
	  if($thumbHeight >0)
	  	$new_height = $thumbHeight;
	  else
     	 $new_height = floor( $height * ( $thumbWidth / $width ) );
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      //imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	  imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
       imagepng( $tmp_img, $pathToThumbs.$file,100 );
  }
}

/**************    Middle size  Image Function  ****************/

function createThumbs1($file, $pathToThumbs, $thumbWidth ,$thumbHeight =0,$filepath='')
{
 $pathToImages=$filepath.$file;
    $info = pathinfo($pathToImages);
    if ( strtolower($info['extension']) == 'jpg'  or  strtolower($info['extension']) == 'jpeg')
    {
      $img = imagecreatefromjpeg($pathToImages);
      $width = imagesx( $img );
      $height = imagesy( $img );
	  if($thumbWidth >0)	  
      	$new_width = $thumbWidth;
	  else
		$new_width = floor( $width * ( $thumbHeight / $height ) );	
	  if($thumbHeight >0)
	  	$new_height = $thumbHeight;
	  else
     	$new_height = floor( $height * ( $thumbWidth / $width ) );
     $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
      imagejpeg( $tmp_img, $pathToThumbs.$file );
  }
  else if(strtolower($info['extension']) == 'gif')
  {
   $img = imagecreatefromgif($pathToImages);
      $width = imagesx( $img );
      $height = imagesy( $img );
	  if($thumbWidth >0)	  
      	$new_width = $thumbWidth;
	  else
		$new_width = floor( $width * ( $thumbHeight / $height ) );	
	  if($thumbHeight >0)
	  	$new_height = $thumbHeight;
	  else
     	 $new_height = floor( $height * ( $thumbWidth / $width ) );
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
       imagegif( $tmp_img, $pathToThumbs.$file );
  } else if(strtolower($info['extension']) == 'png')
  {
   $img = imagecreatefrompng($pathToImages);
      $width = imagesx( $img );
      $height = imagesy( $img );
	  if($thumbWidth >0)	  
      	$new_width = $thumbWidth;
	  else
		$new_width = floor( $width * ( $thumbHeight / $height ) );	
	  if($thumbHeight >0)
	  	$new_height = $thumbHeight;
	  else
     	 $new_height = floor( $height * ( $thumbWidth / $width ) );
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
       imagepng( $tmp_img, $pathToThumbs.$file );
  }
}

/**************    Middle size  Image Function  ****************/
function createThumbs3($file, $pathToThumbs, $thumbWidth ,$thumbHeight =0,$filepath='')
{
 $pathToImages=$filepath.$file;
    $info = pathinfo($pathToImages);
    if ( strtolower($info['extension']) == 'jpg'  or  strtolower($info['extension']) == 'jpeg')
    {
      $img = imagecreatefromjpeg($pathToImages);
      $width = imagesx( $img );
      $height = imagesy( $img );
	  if($thumbWidth >0)	  
      	$new_width = $thumbWidth;
	  else
		$new_width = floor( $width * ( $thumbHeight / $height ) );	
	  if($thumbHeight >0)
	  	$new_height = $thumbHeight;
	  else
     	$new_height = floor( $height * ( $thumbWidth / $width ) );
     $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
      imagejpeg( $tmp_img, $pathToThumbs.$file );
  }
  else if(strtolower($info['extension']) == 'gif')
  {
   $img = imagecreatefromgif($pathToImages);
      $width = imagesx( $img );
      $height = imagesy( $img );
	  if($thumbWidth >0)	  
      	$new_width = $thumbWidth;
	  else
		$new_width = floor( $width * ( $thumbHeight / $height ) );	
	  if($thumbHeight >0)
	  	$new_height = $thumbHeight;
	  else
     	 $new_height = floor( $height * ( $thumbWidth / $width ) );
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
       imagegif( $tmp_img, $pathToThumbs.$file );
  } else if(strtolower($info['extension']) == 'png')
  {
   $img = imagecreatefrompng($pathToImages);
      $width = imagesx( $img );
      $height = imagesy( $img );
	  if($thumbWidth >0)	  
      	$new_width = $thumbWidth;
	  else
		$new_width = floor( $width * ( $thumbHeight / $height ) );	
	  if($thumbHeight >0)
	  	$new_height = $thumbHeight;
	  else
     	 $new_height = floor( $height * ( $thumbWidth / $width ) );
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
       imagepng( $tmp_img, $pathToThumbs.$file );
  }
}
?>