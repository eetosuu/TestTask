<?php

namespace app\controllers;

use app\models\Author;
use app\models\Book;
use app\models\Genre;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/** @var Book $book */
class BookController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $books = Book::getAll();

        $booksAll = new ActiveDataProvider(
            [
                'query' => $books,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]
        );

        return $this->render('index', [
            'books' => $booksAll,
        ]);
    }

    public function actionAdd()
    {
        $genres = Genre::find()->all();
        $authors = Author::find()->all();
        $book = new Book;
        if (Yii::$app->request->isPost) {
            $book->attributes = Yii::$app->request->post('Book');
            if ($book->validate()) {
                $book->book_name = Yii::$app->request->post('Book')['book_name'];
                $book->genre_id = Yii::$app->request->post('Book')['genre_id'];
                $book->publication_date = Yii::$app->request->post('Book')['publication_date'];
                $book->authors_ids = [];
                foreach (Yii::$app->request->post('Book')['authors_book'] as $author_id) {
                    $book->authors_ids[] = (int)$author_id;
                }
                $book->save();
            }
            Yii::$app->getResponse()->redirect('/book');
        }

        return $this->render('add',
            ['book' => $book, 'genres' => $genres,
                'authors' => $authors],
        );


    }

    public
    function actionEdit()
    {
        $bookId = Yii::$app->request->get()['id'];

        $book = Book::getById($bookId);
        $genres = Genre::find()->all();
        $authors = Author::find()->all();
        if (Yii::$app->request->isPost) {
            $book->attributes = Yii::$app->request->post('Book');
            if ($book->validate()) {
                $book->book_name = Yii::$app->request->post('Book')['book_name'];
                $book->genre_id = Yii::$app->request->post('Book')['genre_id'];
                $book->publication_date = Yii::$app->request->post('Book')['publication_date'];
                $book->authors_ids = [];
                foreach (Yii::$app->request->post('Book')['authors_book'] as $author_id) {
                    $book->authors_ids[] = (int)$author_id;
                }
                $book->save();
            }
            Yii::$app->getResponse()->redirect('/book');
        }

        return $this->render('edit',
            ['book' => $book, 'genres' => $genres,
                'authors' => $authors],
        );
    }

}