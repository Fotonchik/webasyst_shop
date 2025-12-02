<?php

return array(
    'name'        => 'Подарок для вас',
    'description' => 'Позволяет посетителям получить случайный подарок из списка товаров.',
    'img'         => 'img/gift.svg',
    'vendor'      => 'custom',
    'version'     => '1.0.0',
    'shop_settings' => true,
    'custom_settings' => true,
    'frontend'    => true,
    'handlers'    => array(
        'frontend_nav' => 'frontendNav',
    ),
);

