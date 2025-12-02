<?php

/**
 * Main plugin class.
 */
class shopGift4youPlugin extends shopPlugin
{
    /**
     * Returns configured product list ID.
     *
     * @return int
     */
    public function getProductListId()
    {
        return (int) $this->getSettings('product_list_id');
    }

    /**
     * Adds link into frontend navigation.
     *
     * @param array $items
     * @return array
     */
    public function frontendNav($items)
    {
        $items['gift4you'] = array(
            'name' => _wp('Подарок'),
            'url'  => wa()->getRouteUrl('shop/frontend', array(
                'plugin' => 'gift4you',
                'action' => 'gift',
            )),
        );

        return $items;
    }
}




