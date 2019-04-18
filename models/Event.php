<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use app\models\Tag;
use dosamigos\taggable\Taggable;




/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $name
 * @property int $date_begin
 * @property int $date_end
 * @property int $status
 * @property string $image
 * @property resource $description
 * @property int $created_at
 * @property int $updated_at
 */
class Event extends \yii\db\ActiveRecord
{
    const IMAGE_PATH = 'img_mer';
    const IMAGE_SMALL_PREF = 's_';

    public $fimage;

    public function behaviors()
    {
        return [

            [
                'class' => TimestampBehavior::className(),

            ],

            [
                'class' => Taggable::className(),
            ],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }


    public function init()
    {
        $this->fimage = '';

        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['description'], 'string'],
            [['date_begin', 'date_end'], 'safe'],
            [['name', 'image', 'address' ], 'string', 'max' => 255],
            [['fimage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg','checkExtensionByMimeType'=>false],
            [['fimage'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg','checkExtensionByMimeType'=>false, 'on' => 'create'],
            [['tagNames'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_begin' => 'Дата начала',
            'date_end' => 'Дата конца',
            'status' => 'Статус',
            'image' => 'Картинка размером 400x200',
            'description' => 'Описание',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'fimage' => 'Изображение',
            'address' => 'Адрес',
            'tagNames' => 'Тэги',

        ];
    }


    /*
    * relations
    *
    * получить соединение с user по 2 таблицам
    * yii2
    */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id' ])
            ->viaTable('event_user', ['event_id' => 'id']);

    }

    /*
    * relations
    *
    * получить соединение с tag по 2 таблицам
    * yii2
    */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id' ])
            ->viaTable('event_tag', ['event_id' => 'id']);

    }

    /*
     * сохранить картинку (оригинал и маленькую копию)
     */
    public function saveImage($fileName)
    {
        $fullName = $_SERVER['DOCUMENT_ROOT'].'/'.Event::IMAGE_PATH.'/' . $fileName;
        $this->fimage->saveAs($fullName);


            if (strtolower($this->fimage->extension) == 'jpg' || strtolower($this->fimage->extension) == 'jpeg'){
                $source = imagecreatefromjpeg ($fullName);
                $tip = 'jpg';
            }

            if (strtolower($this->fimage->extension) == 'png'){
                $source = imagecreatefrompng ($fullName);
                $tip = 'png';
            }


            // картинка для вывода на главной
            $imgsize = $this->littleImage($source, $tip, $fileName);

            if (!$imgsize) {
                $this->addError('fimage', 'Размер должен быть не менее 400x200 пикселей');
                unlink($fullName);
                return false;
            }

            return true;

    }

    // маленькая картинка - для вывода на главной
    private function littleImage($source, $tip, $filename, $st_shir = 400, $st_vis = 200, $pref = Event::IMAGE_SMALL_PREF, $end = 0){

        $max_shir = 400;
        $max_vis = 200;


        $w_src = imagesx($source);
        $h_src = imagesy($source);

        if ($max_shir > $w_src || $max_vis > $h_src) {
            //echo "Файл меньше 200x400 пикселей.";
            return false;
        }


        $vis = $st_vis;
        $koof = $h_src/$vis;

        $shir = (int) ($w_src/$koof);

        if ($shir < $st_shir) {
            $shir = $st_shir;
            $koof = $w_src/$shir;

            $vis = (int) ($h_src/$koof);
        }

        $smesh_y = (int) (($vis - $st_vis)/2);
        $smesh_x = (int) (($shir - $st_shir)/2);

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


        $PUTH = $_SERVER['DOCUMENT_ROOT'].'/'.Event::IMAGE_PATH.'/';

        $name = $PUTH.$pref.$filename;

        if ($tip == 'jpg') {
            imagejpeg($dest2, $name);
        }

        if ($tip == 'png') {
            imagepng($dest2, $name);
        }



        if ($end == 1) {
            imagedestroy($dest);
            imagedestroy($dest2);
            imagedestroy($source);
        }
        return true;

    }








}
