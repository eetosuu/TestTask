<?php

use app\models\Author;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var Author $author */

$this->title = 'Создание автора'
?>
<h2 class="text-center mt-2"><?= $this->title ?></h2>
<?php $form = ActiveForm::begin(); ?>
<div class="row justify-content-center mt-3">
    <?=
$form->field($author, 'author_name', ['options' => ['class' => 'col-4']])->textInput() ?>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-3 d-flex justify-content-center">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary'])?>
    </div>
</div>


<?php ActiveForm::end(); ?>
