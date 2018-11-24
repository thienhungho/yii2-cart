<?php

namespace thienhungho\Cart\modules\CartBase\query;

/**
 * This is the ActiveQuery class for [[Cart]].
 *
 * @see Cart
 */
class CartQuery extends \thienhungho\ActiveQuery\models\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Cart[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Cart|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
