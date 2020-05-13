<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wordlist".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 *
 * @property User $user
 * @property WordlistWord[] $wordlistWords
 */
class Wordlist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wordlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[WordlistWords]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWordlistWords()
    {
        return $this->hasMany(WordlistWord::className(), ['wordlist_id' => 'id']);
    }
}
