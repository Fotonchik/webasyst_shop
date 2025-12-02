<?php

class shopGift4youFrontendGiftSpinController extends waJsonController
{
    public function execute()
    {
        /** @var shopGift4youPlugin $plugin */
        $plugin = wa('shop')->getPlugin('gift4you');
        $list_id = $plugin->getProductListId();

        if (!$list_id) {
            $this->setError(_wp('Список товаров не настроен.'));
            return;
        }

        $collection = new shopProductsCollection('list/' . (int) $list_id);
        $count = $collection->count();

        if (!$count) {
            $this->setError(_wp('Список пуст.'));
            return;
        }

        $offset = mt_rand(0, max(0, $count - 1));
        $products = $collection->getProducts('*', $offset, 1);
        $product = reset($products);

        if (!$product) {
            $this->setError(_wp('Не удалось выбрать товар.'));
            return;
        }

        $product_model = new shopProductModel();
        $product = $product_model->getById($product['id']);
        $product['frontend_url'] = shopHelper::getProductUrl($product);
        $product['image_url'] = shopImage::getUrl($product, '970x0');

        $default_currency = wa('shop')->getConfig()->getCurrency(true);
        $product['price_formatted'] = waCurrency::format('%{h}', $product['price'], $default_currency);

        $this->response = array(
            'id'    => $product['id'],
            'name'  => $product['name'],
            'price' => $product['price_formatted'],
            'url'   => $product['frontend_url'],
            'image' => $product['image_url'],
        );
    }
}

