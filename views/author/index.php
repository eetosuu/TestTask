<?php
/** @var yii\web\View $this */

use yii\widgets\LinkPager;
use yii\widgets\ListView;

$this->title = 'Авторы';
?>
<h1 class="text-center">Авторы</h1>
<div class="d-flex  justify-content-center">

    <?= ListView::widget([
        'dataProvider' => $authors,
        'options' => ['tag' => 'ul', 'class' => 'list-group w-75'],
        'itemOptions' => ['tag' => 'li', 'class' => 'list-group-item d-flex justify-content-between align-items-center'],
        'itemView' => '_author',
        'summary' => '',
        'layout' => "{items}"
    ]);
    ?>
</div>
<?= LinkPager::widget([
    'pagination' => $authors->pagination,
    'options' => ['class' => 'pagination justify-content-center fixed-bottom mb-5'],
    'activePageCssClass' => 'active',
    'linkContainerOptions' => ['class' => 'page-item'],
    'linkOptions' => ['class' => 'page-link'],
    'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
]) ?>

