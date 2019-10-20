<?php

namespace frontend\models;

use common\models\Composition;
use common\models\Products;
use yii\data\ArrayDataProvider;

class FindDish
{
    public $ingridients = [];

    public function SearchDish($params)
    {
        $query = Composition::find();

        $this->ingridients = $params;

        $dataProvider = new ArrayDataProvider([]);

        $query->select(['dish_id']);
        $query->andFilterWhere(['product_id' => $this->ingridients[0]]);
        for ($i = 1; $i < count($this->ingridients); ++$i) {
            $query->orFilterWhere(['product_id' => $this->ingridients[$i]]);
        }
        $result = $this->getProducts($query->asArray()->groupBy('dish_id')->all());

        $concidenceArr = [];
        foreach ($result as $key => $item) {
            if (count($item) == count($this->ingridients)) {
                $concidence = $this->checkProducts($item);
                if ($concidence == true) {
                    array_push($concidenceArr, $key);
                }
            }
        }

        if (!empty($concidenceArr)) {
            $dataProvider->allModels = $concidenceArr;

            return $dataProvider;
        }

        $semiConcidence = [];
        foreach ($result as $key => $item) {
            $count = $this->getCountConcidence($item);
            if ($count) {
                $semiConcidence[] = ['id' => $key, 'count' => $count];
            }
        }

        if (!empty($semiConcidence)) {
            $dataProvider->allModels = $semiConcidence;
            $dataProvider->setSort([
                'attributes' => [
                    'count' => [
                        'default' => SORT_ASC
                    ]
                ],
                'defaultOrder' =>
                    [
                        'count' => SORT_DESC
                    ]
            ]);

            return $dataProvider;
        } else {
            return 'Ничего не найдено';
        }
    }

    /**
     * @param $arr
     * @return bool|int
     */
    private function getCountConcidence($arr)
    {
        $count = 0;
        foreach ($arr as $item) {
            if (Products::getHide($item['product_id'])) {
                return false;
            }
            if (in_array($item['product_id'], $this->ingridients)) {
                $count++;
            }
        }

        if ($count >= 2) {
            return $count;
        }
    }

    /**
     * @param $dishes
     * @return array
     */
    private function getProducts($dishes)
    {
        $array = [];
        foreach ($dishes as $dish) {
            $array[$dish['dish_id']] = Composition::find()->select('product_id')->where(['dish_id' => $dish])->asArray()->all();
        }

        return $array;
    }

    /**
     * @param $dish
     * @return bool
     */
    private function checkProducts($dish)
    {
        $fl = true;
        foreach ($dish as $item) {
            if (Products::getHide($item['product_id'])) {
                return false;
            }
            if (in_array($item['product_id'], $this->ingridients)) {
                $fl = true;
            } else {
                $fl = false;
                break;
            }
        }

        return $fl;
    }
}