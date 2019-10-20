<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "composition".
 *
 * @property int $id
 * @property int $product_id
 * @property int $dish_id
 */
class Composition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'composition';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'dish_id'], 'required'],
            [['product_id', 'dish_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'dish_id' => 'Dish ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasMany(Products::className(), ['id' => 'product_id'])->with('dish');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasMany(Dish::className(), ['id' => 'dish_id'])->with('product');
    }
}
