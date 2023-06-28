<?php

namespace app\commands;

use app\models\Book;
use app\models\Genre;
use Faker\Factory;
use app\models\Author;
use Yii;
use yii\console\Controller;
use yii\db\Exception;

class DataController extends Controller
{
    /**
     * @throws Exception
     */
    public function actionCreate($countBook = 5, $countGenres = 5, $countAuthors = 10)
    {
        $faker = Factory::create();
        $currentCountGenres = Yii::$app->db->createCommand('SELECT MAX(id) FROM genre')->queryScalar();
        $currentCountAuthors = Yii::$app->db->createCommand('SELECT MAX(id) FROM author')->queryScalar();

        $authors = [];
        $genres = [];

        for ($i = 0; $i < $countAuthors; $i++) {
            $authors[] = [
                $faker->name(),
            ];
        }

        Yii::$app->db->createCommand()->batchInsert('author', ['author_name'], $authors)->execute();

        for ($k = 0; $k < $countGenres; $k++) {
            $genres[] = [
                $faker->word(),
            ];
        }

        Yii::$app->db->createCommand()->batchInsert('genre', ['genre_name'], $genres)->execute();

        for ($j = 0; $j < $countBook; $j++) {

            $authors_book = [];
            $randomNumberAuthors = $faker->numberBetween(1, 3);

            for ($i = 0; $i < $randomNumberAuthors; $i++) {
                $authors_book[] = [
                    $faker->numberBetween(1, $currentCountAuthors)
                ];
            }

            $model = new Book();
            $model->book_name = $faker->sentence();
            $model->genre_id = $faker->numberBetween(1, $currentCountGenres);
            $model->publication_date = $faker->numberBetween(0, 2023);
            $model->authors_book = $authors_book;
            $model->save();
        }

        unset($authors);
        unset($genres);

        die();
    }
}