<?php

use app\models\Author;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Редактирование автора'
?>
    <h2 class="text-center mt-2"><?= $this->title ?></h2>
<?php $form = ActiveForm::begin([
        'options' => ['class' => 'row justify-content-center mt-3']]); ?>

<?= $form->field($author, 'author_name', ['options' => ['class' => 'col-4']])->textInput(['value'=> $author['author_name']]) ?>
<div class="col-2 d-flex align-items-end">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary'])?>
</div>

<?php ActiveForm::end(); ?>