<?php
/**
 * @return array|\BaseApp\ecommerce\modules\CartBase\Cart[]
 * @throws \yii\base\Exception
 */
function get_current_cart()
{
    return \thienhungho\Cart\models\Cart::find()
        ->where(['key' => get_current_cart_key()])
        ->all();
}

/**
 * @throws \yii\base\Exception
 */
function do_empty_current_cart()
{
    \thienhungho\Cart\models\Cart::deleteAll([
        'key' => get_current_cart_key()
    ]);
}

/**
 * @return null|string
 * @throws \yii\base\Exception
 */
function get_current_cart_key()
{
    $key = isset($_COOKIE['_cart_key']) ? $_COOKIE['_cart_key'] : null;
    if (empty($key)) {
        $key = generate_random_string(32);
        add_cookie([
            'name'   => '_cart_key',
            'value'  => $key,
            'expire' => time() + 86400 * 365,
        ]);
    }
    return $key;
}

/**
 * @param $product_id
 * @param $quantity
 * @return bool
 * @throws \yii\base\Exception
 */
function add_item_to_current_cart($product_id, $quantity) 
{
    $model = new \thienhungho\Cart\models\Cart();
    $model->key = get_current_cart_key();
    $model->product = $product_id;
    $model->quantity = $quantity;
    return $model->save();
}

/**
 * @return int
 * @throws \yii\base\Exception
 */
function get_number_item_of_current_cart()
{
    $value = \thienhungho\Cart\models\Cart::find()
        ->where(['key' => get_current_cart_key()])
        ->sum('quantity');
    return empty($value) ? 0 : $value;
}