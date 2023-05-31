<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $author_name
 *
 * @property BookAuthor[] $bookAuthors
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $messageTooLong = '{attribute} до {max} символов';
        $messageTooShort = '{attribute} от {min} символов.';
        return [
            [['author_name'], 'required','message' => 'Заполните имя автора'],
            [['author_name'], 'string', 'min' => 3, 'max' => 50, 'tooLong' => $messageTooLong, 'tooShort' => $messageTooShort ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_name' => 'Имя автора',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::class, ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])->viaTable('book_author', ['author_id' => 'id']);
    }

    public static function getAll()
    {
        return self::find()->asArray();
    }
    public static function getById($id)
    {
        return self::findOne($id);
    }
}
