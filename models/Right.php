<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "box".
 *
 * @property int $id
 * @property int $id_user
 * @property int $sid
 * @property int $id_tov
 * @property string $name
 * @property int $kol
 */
class Right extends Model
{
   const ADMIN = 1;


   public static function isAdmin(){
       if (Yii::$app->user->id == self::ADMIN){
           return true;
       }
   }

   public static function isGuest(){
       if (Yii::$app->user->isGuest) {//1
            return true;
       }
       return false;
   }


}
