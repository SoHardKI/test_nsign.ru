<?php

use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\dish\models\DishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php Pjax::begin(); ?>
<?= \yii\helpers\Html::a('Вернуться к составлению блюд', ['/site/index'], ['class' => 'btn btn-success']) ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Блюдо',
            'value' => function ($data) {
                return \common\models\Dish::getName($data['id'] ? $data['id'] : $data);
            }
        ],
        [
            'label' => 'Кол-во совпадений',
            'value' => function ($data) {
                return $data['count'] ? $data['count'] : '100%';
            }
        ],
    ],
]);
?>