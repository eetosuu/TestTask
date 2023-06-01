<?php

namespace app\models;


use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $author_name
 *
 * @property BookAuthor[] $bookAuthors
 * @property Book[] $books
 */
class Author extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        $messageTooLong = '{attribute} до {max} символов';
        $messageTooShort = '{attribute} от {min} символов.';
        return [
            [['author_name'], 'required', 'message' => 'Заполните имя автора'],
            [['author_name'], 'string', 'min' => 3, 'max' => 50, 'tooLong' => $messageTooLong, 'tooShort' => $messageTooShort],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'author_name' => 'Имя автора',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return ActiveQuery
     */
    public function getBookAuthors(): ActiveQuery
    {
        return $this->hasMany(BookAuthor::class, ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getBooks(): ActiveQuery
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])->viaTable('book_author', ['author_id' => 'id']);
    }

    public static function getAll(): ActiveQuery
    {
        return self::find()->asArray();
    }

    public static function getById($id): ?Author
    {
        return self::findOne($id);
    }

}
