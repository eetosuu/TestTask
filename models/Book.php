<?php

namespace app\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $book_name
 * @property int $genre_id
 * @property int $publication_date
 *
 * @property Author[] $authors
 * @property BookAuthor[] $bookAuthors
 * @property Genre $genre
 */
class Book extends \yii\db\ActiveRecord
{
    public $authors_book;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        $dateMessage = 'Введите год в диапазоне от 1 до 2023';
        return [
            [['book_name', 'genre_id', 'publication_date', 'authors_book'], 'required', 'message' => 'Не может быть пустым'],
            [['genre_id', 'publication_date'], 'integer'],
            [['book_name'], 'string', 'max' => 255, 'min' => 3],
            [['genre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genre::class, 'targetAttribute' => ['genre_id' => 'id']],
            [['publication_date'], 'integer', 'min' => 1, 'max' => 2023, 'tooBig' => $dateMessage, 'tooSmall' => $dateMessage],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'book_name' => 'Название книги',
            'genre_id' => 'Жанр',
            'publication_date' => 'Дата издания',
            'authors_book' => 'Автор'
        ];
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->viaTable('book_author', ['book_id' => 'id']);
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return ActiveQuery
     */
    public function getBookAuthors(): ActiveQuery
    {
        return $this->hasMany(BookAuthor::class, ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Genre]].
     *
     * @return ActiveQuery
     */
    public function getGenre(): ActiveQuery
    {
        return $this->hasOne(Genre::class, ['id' => 'genre_id']);
    }

    public static function getAll(): ActiveQuery
    {
        return self::find()->with('bookAuthors.author')->with('genre')->asArray();
    }

    public static function getById($id)
    {
        return self::find()
            ->with('bookAuthors.author')
            ->with('genre')
            ->where(['id' => $id])
            ->one();
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->authors_book = ArrayHelper::getColumn($this->authors, 'id');
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if (!$this->isNewRecord) {
            $this->unlinkAll('authors', true);
        }

        foreach ($this->authors_book as $author_id) {
            $author = Author::findOne($author_id);
            $this->link('authors', $author);
        }
    }
}
