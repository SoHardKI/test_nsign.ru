<?php
namespace frontend\modules\dish\models;


class Dish extends DishSearch
{
    public $ingridients = [];

    public function rules()
    {
        return [
            ['ingridients', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ingridients' => 'Ингридиенты'
        ];
    }
}