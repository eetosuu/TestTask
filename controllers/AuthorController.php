<?php

namespace app\controllers;

use app\models\Author;
use Yii;
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
                'pagination' => [
                    'pageSize' => 10,
                ],
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
        $authorId = Yii::$app->request->get()['id'];
        $author = Author::getById($authorId);
        if (Yii::$app->request->isPost) {
            $author->author_name = Yii::$app->request->post()['Author']['author_name'];
            $author->save();

            Yii::$app->getResponse()->redirect('/author');
        }
        return $this->render('edit',
            ['author' => $author]
        );

    }

}