<?php

class shopGift4youPluginSettingsAction extends waViewAction
{
    public function execute()
    {
        /** @var shopGift4youPlugin $plugin */
        $plugin = wa('shop')->getPlugin('gift4you');

        $settings = $plugin->getSettings();

        $this->view->assign(array(
            'settings' => $settings,
        ));
    }
}




