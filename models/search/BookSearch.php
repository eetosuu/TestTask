<?php

namespace app\models\search;

use app\models\Book;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BookSearch represents the model behind the search form of `app\models\Book`.
 */
class BookSearch extends Book
{
    public $fromDate;
    public $toDate;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['publication_date'], 'integer'],
            [['authors_book', 'genre_id', 'toDate', 'fromDate', 'book_name'], 'safe'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'authors_book' => 'Автор',
            'genre_id' => 'Жанр',
            'toDate' => 'Год до',
            'fromDate' => 'Год от',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith('authors');
        $query->andFilterWhere([
            'id' => $this->id,
            'genre_id' => $this->genre_id,
            'publication_date' => $this->publication_date,
            'author_id' => $this->authors_book,
        ]);

        if (!empty($this->fromDate)) {
            if (!empty($this->toDate)) {
                $query->andFilterWhere(['between', 'publication_date', $this->fromDate, $this->toDate]);
            } else {
                $query->andFilterWhere(['>=', 'publication_date', $this->fromDate]);
            }
        } elseif (!empty($this->toDate)) {
            $query->andFilterWhere(['<=', 'publication_date', $this->toDate]);
        }

        $query->andFilterWhere(['like', 'book_name', $this->book_name]);
        $query->addGroupBy('id');

        return $dataProvider;
    }
}
