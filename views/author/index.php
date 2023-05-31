<?php
/** @var yii\web\View $this */

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

