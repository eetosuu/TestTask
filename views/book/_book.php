<?php

/** @var array $model */

use yii\helpers\Html;

?>


<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <span class="card-title fs-5"><?=
                $model['book_name'] ?></span>
            <?= Html::a('Ред.', ['/book/edit', 'id' => $model['id']], ['class' => 'btn btn-outline-success align-self-start']) ?>
        </div>
        <div class="card-subtitle mb-2 pt-3 fs-6">
            <?php $authors = [] ?>
            <?php foreach ($model['bookAuthors'] as $author): ?>
                <?php
                $authors[] = $author['author']['author_name'];
                ?>
            <?php endforeach; ?>
            <?= implode(', ', $authors) . ', ' . $model['publication_date'] ?>
        </div>
        <div class="card-subtitle mb-1">
            <?= $model['genre']['genre_name'] ?>
        </div>
    </div>
</div>

