<?php

namespace app\controllers;

use app\models\Book;
use app\models\BookAuthor;
use app\models\BookQuery;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;

class BookController extends Controller
{
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

}