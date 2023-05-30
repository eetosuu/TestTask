<?php

?>


    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <span class="card-title fs-5"><?= $model['book_name'] ?></span>
                <a href="/book/edit?id=<?=$model['id'] ?>"
                   class="btn btn-outline-success align-self-start">Ред.</a>
            </div>
            <div class="card-subtitle mb-2 fs-6">
                <?php $authors = []?>
                <?php foreach($model['bookAuthors'] as $author): ?>
                    <?php
                    $authors[] = $author['author']['author_name'];
                    ?>
                <?php endforeach; ?>
                <?= implode(', ', $authors) . ', ' . $model['publication_date']?>
            </div>
            <div class="card-subtitle mb-1">
                <?= $model['genre']['genre_name']?>
            </div>
        </div>
    </div>

