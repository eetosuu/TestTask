<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "genre".
 *
 * @property int $id
 * @property string $genre_name
 *
 * @property Book[] $books
 */
class Genre extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['genre_name'], 'required'],
            [['genre_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'genre_name' => 'Genre Name',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return ActiveQuery
     */
    public function getBooks(): ActiveQuery
    {
        return $this->hasMany(Book::class, ['genre_id' => 'id']);
    }
}
