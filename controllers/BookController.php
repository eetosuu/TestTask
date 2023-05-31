<?php

namespace app\controllers;

use app\models\Book;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

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

    }
    public function actionEdit()
    {

    }

}