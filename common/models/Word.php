<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "word".
 *
 * @property int $id
 * @property string $word
 * @property string|null $definition
 *
 * @property WordlistWord[] $wordlistWords
 */
class Word extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'word';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['word'], 'required'],
            [['definition'], 'string'],
            [['word'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word' => 'Word',
            'definition' => 'Definition',
        ];
    }

    /**
     * Gets query for [[WordlistWords]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWordlistWords()
    {
        return $this->hasMany(WordlistWord::className(), ['word_id' => 'id']);
    }
}
