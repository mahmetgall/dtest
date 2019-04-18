<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event_user".
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 */
class EventUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'user_id' => 'User ID',
        ];
    }
}
