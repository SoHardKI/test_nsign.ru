<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Dish */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dish-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ingridients')->widget(\unclead\multipleinput\MultipleInput::className(), [
        'max' => 5,
        'columns' => [
            [
                'name' => 'ingridients',
                'type' => 'dropDownList',
                'defaultValue' => 1,
                'items' => \common\models\Products::getProductsName(),
            ],
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
