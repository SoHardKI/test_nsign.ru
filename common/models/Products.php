<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property int $hide
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['hide'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'hide' => 'Скрыто',
        ];
    }

    /**
     * @return array
     */
    public static function getProductsName()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getDish()
    {
        return $this->hasMany(Dish::className(), ['id', 'dish_id'])
            ->viaTable('composition', ['product_id' => 'id']);
    }

    /**
     * @param $id
     * @return int
     */
    public static function getHide($id)
    {
        return Products::findOne($id)->hide;
    }
}
