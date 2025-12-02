<?php

class shopGift4youFrontendGiftAction extends waViewAction
{
    public function execute()
    {
        /** @var shopGift4youPlugin $plugin */
        $plugin = wa('shop')->getPlugin('gift4you');

        $this->view->assign(array(
            'list_id'  => $plugin->getProductListId(),
            'spin_url' => '?plugin=gift4you&module=frontend&action=giftSpin',
            'mail_url' => '?plugin=gift4you&module=frontend&action=giftMail',
        ));

        $this->setLayout(new shopFrontendLayout());
        $this->getResponse()->setTitle(_wp('Подарок для вас!'));
    }
}

