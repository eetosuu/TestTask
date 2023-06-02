<?php

namespace app\controllers;

use app\models\Author;
use Yii;
use yii\base\InvalidRouteException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AuthorController extends Controller
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'edit' => ['GET', 'POST'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $authors = Author::find();

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

    public function actionEdit($id = ''): string
    {
        if (!empty($id)) {
            $author = Author::findOne($id);
        } else {
            $author = new Author();
        }

        $this->completion($author);

        return $this->render('edit',
            ['author' => $author]
        );
    }

    /**
     * @throws InvalidRouteException
     */
    public function completion(?Author $author): void
    {
        if (Yii::$app->request->isPost) {
            $author->attributes = Yii::$app->request->post('Author');
            if ($author->validate()) {
                $author->author_name = Yii::$app->request->post('Author')['author_name'];
                $author->save();
            }

            Yii::$app->getResponse()->redirect('/book');
        }
    }
}