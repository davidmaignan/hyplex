<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexImage
 *
 * @author david
 */
class PlexImage {
    //put your code here

    private $width;
    private $height;
    private $url;
    private $targetPath;
    private $arMimes = array('image/jpeg'=>'imagecreatefromjpeg', 'image/png'=>'imagecreatefrompng','image/gif'=>'imagecreatefromgif');
    private $arImageFunction = array('image/jpeg'=>'imagejpeg', 'image/png'=>'imagepng','image/gif'=>'imagegif');

    public function  __construct($url) {

        $this->url = $url;
        $dimensions = sfConfig::get('app_hotel_thumb');
        $this->width = $dimensions['width'];
        $this->height = $dimensions['height'];
        

        //echo $this->url;
        //var_dump($this->width);
        //var_dump($this->height);

        $this->targetPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'hotels'.DIRECTORY_SEPARATOR.'baseImage'.DIRECTORY_SEPARATOR;

        
        //break;

        if(!file_exists(sfConfig::get('sf_upload_dir').
                DIRECTORY_SEPARATOR.'hotels'.
                DIRECTORY_SEPARATOR.'baseImage/'.
                $this->getFileName($url))){
            //echo 'here';
            
            $this->createThumb($url, $this->width, $this->height);
        }else{
            
        }
        //$this->createThumb($url, $this->width, $this->height);

    }

    

    public function createThumb($url, $width, $height){

        $name = $this->getFileName($url);
        $fullName = $this->targetPath.$name;
        //echo $fullName."<br />";

        //var_dump(getimagesize($url));

        $handle = @fopen($url, 'r');

        //Better solution to implement when will have extra time
        //http://php.net/manual/en/function.imagecreatefrompng.php see example 1
        if(!$handle){
            
            $url = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'generic'.DIRECTORY_SEPARATOR.'no_image_available.png';
        }
        //var_dump(file_exists($url));
        //break;
        
        $infoSrc = getimagesize($url);
        //var_dump($infoSrc);
        $srcWidth = $infoSrc[0];
        $srcHeight = $infoSrc[1];


        //Define the maximum size of the source image

        //Ratio targeted
        $destRatio = $width/$height;
        $srcRatio = $srcWidth/$srcHeight;

        //echo "srcWidth: $srcWidth<br />";
        //echo "srcHeight: $srcHeight<br />";
        //echo "destRatio: $destRatio<br />";
        //echo "srcRatio: $srcRatio<br /><br />";

        //If srcRation > destRatio : height is the one to choose
        if($srcRatio == $destRatio){

            $src_w = $width;
            $src_h = $height;
            $dst_x = 0;
            $dst_y = 0;
            $src_x = 0;
            $src_y = 0;


        }else if($srcRatio > $destRatio){
            $src_h = $srcHeight;
            $src_w = $width*($srcHeight/$height);
            $src_x = $srcWidth/2-($src_w/2);
            $src_y = 0;

        }else{
            $src_w = $srcWidth;
            $src_h = $height*($srcWidth/$width);
            $src_x = 0;
            $src_y = $srcHeight/2-($src_h/2);
        }


        //echo "src_h: $src_h<br />";
        //echo "src_w: $src_w<br />";
        //echo "src_y: $src_y<br />";
        //echo "src_x: $src_x<br />";


        //var_dump($infoSrc);
        //break

        $function = $this->arMimes[$infoSrc['mime']];
        //echo $function;

        $src = $function($url);

        $dest = imagecreatetruecolor($width, $height);
        $bg = imagecolorallocate ( $dest, 230, 230,230 );
        imagefilledrectangle($dest, 0, 0, $width, $height, $bg);

        //imagecopyresized($dest, $src, 0, 0, 0, 0, 150, 120, 150*(210/120), 210);
        imagecopyresized($dest, $src, 0, 0, $src_x, $src_y, $width, $height, $src_w, $src_h);

        $functionImage = $this->arImageFunction[$infoSrc['mime']];

        $functionImage($dest, $fullName);

    }

    public function getFileName($url){
        $filename = strrpos($url, DIRECTORY_SEPARATOR);
        return substr($url, $filename+1);
    }


}
?>
