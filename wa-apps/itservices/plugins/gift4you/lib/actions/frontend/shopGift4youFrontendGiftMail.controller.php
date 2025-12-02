<?php

class shopGift4youFrontendGiftMailController extends waJsonController
{
    public function execute()
    {
        $email = trim(waRequest::post('email', '', waRequest::TYPE_EMAIL));
        $product_id = waRequest::post('product_id', 0, waRequest::TYPE_INT);

        if (!$email || !$product_id) {
            $this->setError(_wp('Проверьте корректность email и выбранный товар.'));
            return;
        }

        $product_model = new shopProductModel();
        $product = $product_model->getById($product_id);

        if (!$product) {
            $this->setError(_wp('Товар не найден.'));
            return;
        }

        $product_url = shopHelper::getProductUrl($product, true);
        $currency = wa('shop')->getConfig()->getCurrency(true);
        $price_formatted = waCurrency::format('%{h}', $product['price'], $currency);

        $subject = _wp('Ваш подарок!');
        $body = sprintf(
            "%s\n\n%s “%s”\n%s %s\n%s %s\n\n%s",
            _wp('Здравствуйте!'),
            _wp('Ваш подарок — товар:'),
            $product['name'],
            _wp('Цена:'),
            $price_formatted,
            _wp('Ссылка:'),
            $product_url,
            _wp('Спасибо, что участвуете в акции!')
        );

        $message = new waMailMessage($subject, nl2br($body));
        $message->setTo($email);
        $message->setFrom(waMail::getDefaultFrom());

        try {
            $message->send();
        } catch (Exception $e) {
            $this->setError(_wp('Не удалось отправить письмо. Попробуйте позже.'));
            return;
        }

        $this->response = array('success' => true);
    }
}

