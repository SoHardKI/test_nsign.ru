<?php

/* @var $this yii\web\View
 * @var $model
 */

$this->title = 'Модуль выборки блюд';

use yii\helpers\Html; ?>
<div class="site-index">

    <?= \yii\helpers\Html::a('Работа с ингридиентами', ['/site/product'], ['class' => 'btn btn-success']) ?>
    <?= \yii\helpers\Html::a('Работа с блюдами', ['/site/dish'], ['class' => 'btn btn-success']) ?>

    <h2>Выберите ингридиенты, что-бы приготовить блюдо</h2>

    <?php
    $form = \yii\widgets\ActiveForm::begin(['options' => ['class' => 'form-horizontal'],]) ?>
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
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Поиск блюд', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php \yii\widgets\ActiveForm::end() ?>
</div>
