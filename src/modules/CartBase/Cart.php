<?php

namespace thienhungho\Cart\modules\CartBase;

use Yii;
use \thienhungho\Cart\modules\CartBase\base\Cart as BaseCart;
use yii\web\Cookie;

/**
 * This is the model class for table "cart".
 */
class Cart extends BaseCart
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['key'], 'required'],
            [['product', 'quantity', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['key'], 'string', 'max' => 255],
        ]);
    }

    /**
     * @param bool $insert
     *
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->key = get_current_cart_key();
                $check = Cart::find()
                    ->where(['product' => $this->product])
                    ->andWhere(['key' => $this->key])
                    ->one();
                if (!empty($check)) {
                    $this->quantity += $check->quantity;
                    Cart::deleteAll([
                        'key' => $this->key,
                        'product' => $this->product
                    ]);
                }
            }
            return true;
        }

        return false;
    }
}
