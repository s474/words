<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wordlist_word".
 *
 * @property int $id
 * @property int $wordlist_id
 * @property int $word_id
 * @property string|null $definition
 *
 * @property Wordlist $wordlist
 * @property Word $word
 */
class WordlistWord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wordlist_word';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wordlist_id', 'word_id'], 'required'],
            [['wordlist_id', 'word_id'], 'integer'],
            [['definition'], 'string'],
            [['wordlist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wordlist::className(), 'targetAttribute' => ['wordlist_id' => 'id']],
            [['word_id'], 'exist', 'skipOnError' => true, 'targetClass' => Word::className(), 'targetAttribute' => ['word_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wordlist_id' => 'Wordlist',
            'word_id' => 'Word',
            'definition' => 'Wordlist definition',
        ];
    }

    /**
     * Gets query for [[Wordlist]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWordlist()
    {
        return $this->hasOne(Wordlist::className(), ['id' => 'wordlist_id']);
    }

    /**
     * Gets query for [[Word]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWord()
    {
        return $this->hasOne(Word::className(), ['id' => 'word_id']);
    }
}
