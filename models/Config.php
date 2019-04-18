<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "catalog".
 *
 * @property int $idd
 * @property int $id
 * @property int $sid
 * @property string $name
 * @property int $priority
 * @property int $priority_home
 * @property int $priority_menu
 * @property int $is_hidden_in_menu
 * @property string $path
 * @property int $level
 * @property int $type
 * @property string $photo
 * @property string $icon
 * @property int $is_leaf
 * @property string $full_slug
 * @property string $description
 */
class Config extends Model
{
   const CURR = 'руб.';

   // дата для присвоения модели и записи в таблицу
   public static function date_now()
   {
       $dd = date('Y-m-d H:i:s');
       $date = \DateTime::createFromFormat('Y-m-d H:i:s', $dd);
       $date1 = $date->format('Y-m-d H:i:s');
       return Yii::$app->formatter->asDate($date1 . Yii::$app->timeZone, 'php:Y-m-d H:i:s');
   }

   public static function date_time_to_str($date)
   {
       if (!$date){
           return '';
       }
       $date1 = \DateTime::createFromFormat('Y-m-d H:i:s',$date);
       return date_format($date1, 'd.m.Y H:i');
   }

    public static function date_to_str_short($date)
    {
        if (!$date){
            return '';
        }
        $date1 = date('d.m.Y',$date);
        return $date1;
    }

    public static function timestamp_to_str($date)
    {
        if (!$date){
            return '';
        }
        $date1 = date('d.m.Y H:i',$date);
        return $date1;
    }


    public static function strdate_to_timestamp($date)
    {
        if (!$date){
            return '';
        }
        $date1 = \DateTime::createFromFormat('d.m.Y H:i',$date);
        return $date1->getTimestamp();
    }
}
