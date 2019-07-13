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
function empty_current_cart()
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
    $key = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : null;
    if (empty($key)) {
        $key = generate_random_string(32);
        add_cookie([
            'name'   => 'cart_key',
            'value'  => $key,
            'expire' => time() + 86400 * 365,
        ]);
    }
    return $key;
}