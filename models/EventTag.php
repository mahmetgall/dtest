<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event_tag".
 *
 * @property int $id
 * @property int $event_id
 * @property int $tag_id
 */
class EventTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'tag_id'], 'integer'],
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
            'tag_id' => 'Tag ID',
        ];
    }
}
