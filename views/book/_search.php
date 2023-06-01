<?php

use app\models\Author;
use app\models\Genre;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BookSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-3">
            <?=
            $form->field($model, 'genre_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($genres, 'id', 'genre_name'),
                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => ['multiple' => true]
            ]);

            ?>
        </div>
        <div class="col-3">
            <?=
            $form->field($model, 'authors_book')->widget(Select2::class, [
                'data' => ArrayHelper::map($authors, 'id', 'author_name'),
                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => ['multiple' => true]
            ]);
            ?>
        </div>
        <div class="col-5">
            <div class="row">
                <div class="col-4">
                    <?= $form->field($model, 'fromDate') ?>
                </div>
                <div class="col-4">
                    <?= $form->field($model, 'toDate') ?>
                </div>
                <div class="col align-self-end">
                    <div class="form-group">
                        <?= Html::submitButton('Поиск', ['class' => 'btn btn-outline-primary']) ?>

                    </div>
                </div>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>
