<?php

namespace app\controllers;

use app\models\Author;
use app\models\Book;
use app\models\Genre;
use app\models\search\BookSearch;
use Yii;
use yii\base\InvalidRouteException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/** @var Book $book */
class BookController extends Controller
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

    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(): string
    {
        $genres = Genre::find()->all();
        $authors = Author::find()->all();
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'genres' => $genres,
            'authors' => $authors,
        ]);
    }

    /**
     * @throws InvalidRouteException|NotFoundHttpException
     */
    public function actionEdit($id = ''): string
    {
        $genres = Genre::find()->all();
        $authors = Author::find()->all();

        if (!empty($id)) {
            $book = $this->findModel($id);
        } else {
            $book = new Book();
        }
        $this->completion($book);
        return $this->render('edit',
            ['book' => $book, 'genres' => $genres,
                'authors' => $authors],
        );
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findModel($id): ?Book
    {
        if (($model = Book::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная страница не существует.');
    }

    /**
     * @param Book|null $book
     * @return void
     * @throws InvalidRouteException
     */
    public function completion(?Book $book): void
    {
        if (Yii::$app->request->isPost) {
            $book->attributes = Yii::$app->request->post('Book');
            if ($book->validate()) {
                $book->authors_book = [];
                foreach (Yii::$app->request->post('Book')['authors_book'] as $author_id) {
                    $book->authors_book[] = (int)$author_id;
                }
                $book->save();
            }

            Yii::$app->getResponse()->redirect('/book');
        }
    }
}