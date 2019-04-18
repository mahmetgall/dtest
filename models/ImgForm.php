<?php


namespace app\models;

use app\models\Ak;
use yii\base\Model;
use Yii;


/**
 * Signup form
 */
class ImgForm extends Model
{
 
public $fimage;
public $id_ak;


 public function rules()
    {
        return [
           
         
			 [['fimage'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg','checkExtensionByMimeType'=>false],

            
        ];
    }
	
	
	 public function attributeLabels()
    {
        return [
          
            'fimage' => 'Изображение не менее 560x300 пикселей',
          
			
        ];
    }
	
	
	public function saveImg($id_ak){
		
		if ($this->validate()) {
		
    

			 
			// $this->resizeImage($fullName);
			// $this->res($fullName);
			
			
            $img = new Img();
			
           
			
			$img->id_user = Yii::$app->user->id;
			$img->id_ak = $id_ak;
			
			$filename = 'ak_'.$img->id_user.'_'.$img->id_ak.'_'.substr(md5(uniqid(mt_rand(), true)), 0, 8).'.'.$this->fimage->extension;
			 $fullName = $_SERVER['DOCUMENT_ROOT'].'/img_ak/' . $filename;
			
		 	$img->img = $filename;	
			
			
			
			//echo '<pre>';
			//var_dump($ak);
		

			
			if($img->validate()){
				$this->fimage->saveAs($fullName);
				if ($this->fimage->extension == 'jpg'){
    				$source = imagecreatefromjpeg ($fullName);
    				$tip = 'jpg';
				}
				
				if ($this->fimage->extension == 'png'){
    				$source = imagecreatefrompng ($fullName);
    				$tip = 'png';
				}
				
				//die('111');
				
				// большая картинка для ротатора
				$imgsize = $this->littleImage($source, $tip, $filename, 'img_ak/', 560, 300, 'b_', 0);
				if($imgsize!=1){
					$this->addError('fimage', 'Размер должен быть не менее 560x300 пикселей');
					unlink($fullName);
					return;
				}
				
				
				// картинка для акции
				$imgsize = $this->littleImage($source, $tip, $filename, 'img_ak/', 400, 200, 's_', 0);
				if($imgsize!=1){
					$this->addError('fimage', 'Размер должен быть не менее 560x300 пикселей');
					unlink($fullName);
					return;
				}
				
				// для топа маленькая картинка
				$imgsize = $this->littleImage($source, $tip, $filename, 'img_ak/',  218, 109, 'l_', 1);
				if($imgsize!=1){
					$this->addError('fimage', 'Размер должен быть не менее 560x300 пикселей');
					//unlink($fullName);
					return;
				}
			
				

			

            if ($img->save()) {
				//	echo "oksave2";
                return $img;
            }
			}
			
        }

        return null;
    }
	
	
	// маленькая картинка - в акции
private function littleImage($source, $tip, $filename, $root, $st_shir=400, $st_vis = 200, $pref='s_', $end = 0){
    //*************  маленький размер *********************

				
//$st_shir = 450;
//$st_vis = 250;
$max_shir = 560;
$max_vis = 300;


$w_src = imagesx($source);

$h_src = imagesy($source);

if($max_shir > $w_src || $max_vis > $h_src){
    //echo "Файл меньше 200x400 пикселей.";
    return 0;
   
}

/*
echo $w_src;
echo '<br>';
echo $h_src;
echo '<br>';
*/
//return;
/*
echo "perv_shir-".$w_src;
echo '<br>';
echo "perv_vis-".$h_src;
echo '<br>';
echo '<br>';
*/
    $vis = $st_vis;
    $koof = $h_src/$vis;

    $shir = (int) ($w_src/$koof);
/*
echo "shir-".$shir;
echo '<br>';
echo "vis-".$vis;
echo '<br>';
echo '<br>';
*/
	
	if($shir < $st_shir){
		$shir = $st_shir;
    $koof = $w_src/$shir;

    $vis = (int) ($h_src/$koof);
		
		
	}
/*
	echo "shir-".$shir;
echo '<br>';
echo "vis-".$vis;
echo '<br>';
*/	
	
//	die('o');

    $smesh_y = (int) (($vis - $st_vis)/2);
    $smesh_x = (int) (($shir - $st_shir)/2);
    
        
    

/*
echo $shir;
echo '<br>';
echo $vis;
echo '<br>';
echo $smesh_x;
echo '<br>';
echo $smesh_y;
echo '<br>';
echo $sm_x;
echo '<br>';
echo $sm_y;
echo '<br>';
*/
$dest = imagecreatetruecolor($shir, $vis);
imageAlphaBlending($dest, false);
imageSaveAlpha($dest, true);

$color = imagecolorallocate ( $dest , 255 , 255 , 255 );
    imagefill ( $dest, 0 , 0 ,  $color );

imagecopyresampled($dest, $source, 0, 0, 0, 0, $shir, $vis, $w_src, $h_src);


$dest2 = imagecreatetruecolor($st_shir, $st_vis);
imageAlphaBlending($dest2, false);
imageSaveAlpha($dest2, true);

$color = imagecolorallocate ( $dest2 , 255 , 255 , 255 );
    imagefill ( $dest2, 0 , 0 ,  $color );



imagecopyresampled($dest2, $dest, 0, 0, $smesh_x, $smesh_y, $shir, $vis, $shir, $vis);


       
  $PUTH = $root;     
        
        $name=$PUTH.$pref.$filename;
 //       echo "small-".$name;


if($tip == 'jpg'){
    imagejpeg($dest2, $name);
}

if($tip == 'png'){
    imagepng($dest2, $name);
}



if($end==1){
	

imagedestroy($dest);
imagedestroy($dest2);
imagedestroy($source);
}
return 1;

    
    
}



	
	
	
	}