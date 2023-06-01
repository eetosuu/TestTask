<?php

use app\models\Book;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var Book $book */
/** @var array $authors */
/** @var array $genres */

$this->title = 'Создание книги'
?>

<h2 class="text-center mt-2"><?= $this->title ?></h2>

<?php $form = ActiveForm::begin(); ?>
<div class="row justify-content-center mt-3">
    <?=
    $form->field($book, 'book_name', ['options' => ['class' => 'col-4']])->textInput() ?>
</div>
<div class="row justify-content-center mt-3">
    <?= $form->field($book, 'publication_date', ['options' => ['class' => 'col-4']])->textInput() ?>
</div>
<div class="row justify-content-center mt-3">
    <?=
    $form->field($book, 'genre_id', ['options' => ['class' => 'col-4']])
        ->dropDownList(
            ArrayHelper::map($genres, 'id', 'genre_name'))
    ?>
</div>
<div class="row justify-content-center mt-3">
    <?=
    $form->field($book, 'authors_book', ['options' => ['class' => 'col-4']])->widget(Select2::class, [
        'data' => ArrayHelper::map($authors, 'id', 'author_name'),
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['multiple' => true]
    ]);

    ?>
</div>
<div class="row justify-content-center mt-3">
    <div class="col-3 d-flex justify-content-center">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
