<?php

/** @var yii\web\View $this */


use yii\widgets\LinkPager;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = 'Книги';
?>

<?php Pjax::begin(); ?>

<div class="row">
    <div class="col-4">
        <div class="d-flex justify-content-between">
            <?= $books->sort->link('book_name', ['class' => 'text-decoration-none text-secondary fs-4']); ?>
            <?= $books->sort->link('publication_date', ['class' => 'text-decoration-none text-secondary fs-4']); ?>
        </div>
    </div>
</div>

    <?= ListView::widget(['dataProvider' => $books,
        'options' => ['class' => 'row row-cols-3 justify-content-center gy-3 mt-3'],
        'itemOptions' => ['class' => 'col-4'],
        'itemView' => '_book',
        'summary' => '',
        'layout' => "{items}"]);
    ?>

    <?= LinkPager::widget(['pagination' => $books->pagination,
        'options' => ['class' => 'pagination justify-content-center fixed-bottom mb-5'],
        'activePageCssClass' => 'active',
        'linkContainerOptions' => ['class' => 'page-item'],
        'linkOptions' => ['class' => 'page-link'],
        'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],]) ?>

    <?php Pjax::end(); ?>

