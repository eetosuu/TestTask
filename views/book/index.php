<?php

use yii\widgets\LinkPager;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var \app\models\search\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var array $authors */
/** @var array $genres */

$this->title = 'Книги';
?>
<div class="book-index">

    <?php Pjax::begin(); ?>
    <div class="row align-items-center">
        <div class="col-4">
            <div class="d-flex justify-content-around flex-column">
                <?= $dataProvider->sort->link('book_name', ['class' => 'text-decoration-none text-secondary fs-5', 'label' => 'Сортировка по названию']); ?>

                <?= $dataProvider->sort->link('publication_date', ['class' => 'text-decoration-none text-secondary fs-5', 'label' => 'Сортировка по дате издания']); ?>
            </div>
        </div>
        <div class="col">
            <?php
            echo $this->render('_search', ['model' => $searchModel, 'authors' => $authors, 'genres' => $genres]); ?>
        </div>
    </div>
    <?= ListView::widget(['dataProvider' => $dataProvider,
        'options' => ['class' => 'row row-cols-3 justify-content-center gy-3 mt-3'],
        'itemOptions' => ['class' => 'col-4'],
        'itemView' => '_book',
        'summary' => '',
        'emptyText' => '<h2>Нет результатов</h2>',
        'layout' => "{items}"]);
    ?>
    <?= LinkPager::widget(['pagination' => $dataProvider->pagination,
        'options' => ['class' => 'pagination justify-content-center mb-2 mt-3'],
        'activePageCssClass' => 'active',
        'linkContainerOptions' => ['class' => 'page-item'],
        'linkOptions' => ['class' => 'page-link'],
        'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],]) ?>

    <?php Pjax::end(); ?>

</div>
