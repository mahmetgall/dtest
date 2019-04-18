<?php

use yii\db\Migration;

/**
 * Class m190411_084129_table_init
 */
class m190411_084129_table_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'name' => 'varchar(255)',
            'date_begin' => 'int',
            'date_end' => 'int',
            'status' => 'int',
            'image' => 'varchar(255)',
            'address' => 'varchar(255)',
            'description' => 'blob',
            'created_at' => 'int',
            'updated_at' => 'int',

        ], 'engine=innodb');

        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'name' => 'varchar(255)',
            'status' => 'int',
            'mainmenu' => 'int',
            'created_at' => 'int',
            'updated_at' => 'int',
            'frequency' => 'int',

        ], 'engine=innodb');


        $this->createTable('event_tag', [
            'id' => $this->primaryKey(),
            'event_id' => 'int',
            'tag_id' => 'int',


        ], 'engine=innodb');

        $this->createTable('event_user', [
            'id' => $this->primaryKey(),
            'event_id' => 'int',
            'user_id' => 'int',


        ], 'engine=innodb');



        $this->createIndex('{{name}}', 'event', 'name');
        $this->createIndex('{{name}}', 'tag', 'name');
        $this->createIndex('{{event_id}}', 'event_tag', 'event_id');
        $this->createIndex('{{tag_id}}', 'event_tag', 'tag_id');
        $this->createIndex('{{event_id}}', 'event_user', 'event_id');
        $this->createIndex('{{user_id}}', 'event_user', 'user_id');



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190411_084129_table_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190411_084129_table_init cannot be reverted.\n";

        return false;
    }
    */
}
