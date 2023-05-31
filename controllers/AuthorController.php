<?php

namespace app\controllers;

use app\models\Author;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class AuthorController extends Controller
{

    public function actionIndex()
    {
        $authors = Author::getAll();

        $authorsAll = new ActiveDataProvider(
            [
                'query' => $authors,
            ]
        );

        return $this->render('index', [
            'authors' => $authorsAll,
        ]);
    }
    public function actionAdd()
    {

    }
    public function actionEdit()
    {

    }

}