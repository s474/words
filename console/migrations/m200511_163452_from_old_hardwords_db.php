<?php

use yii\db\Migration;

/**
 * Class m200511_163452_from_old_hardwords_db
 */
class m200511_163452_from_old_hardwords_db extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200511_163452_from_old_hardwords_db cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200511_163452_from_old_hardwords_db cannot be reverted.\n";

        return false;
    }
    */
}
