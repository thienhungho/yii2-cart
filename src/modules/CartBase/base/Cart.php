<?php

namespace thienhungho\Cart\modules\CartBase\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "{{%cart}}".
 *
 * @property integer $id
 * @property string $key
 * @property integer $product
 * @property integer $quantity
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \thienhungho\Cart\modules\CartBase\Product $product0
 */
class Cart extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'product0'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['product', 'quantity', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['key'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cart}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'product' => Yii::t('app', 'Product'),
            'quantity' => Yii::t('app', 'Quantity'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct0()
    {
        return $this->hasOne(thienhungho\ProductManagement\models\Product::className(), ['id' => 'product']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \thienhungho\Cart\modules\CartBase\query\CartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \thienhungho\Cart\modules\CartBase\query\CartQuery(get_called_class());
    }
}
