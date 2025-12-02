(function ($, window) {
    'use strict';

    var config = window.gift4youConfig || {};

    function toggleAlert(message) {
        var $alert = $('.gift4you-alert');
        if (message) {
            $alert.text(message).removeClass('d-none');
        } else {
            $alert.addClass('d-none').text('');
        }
    }

    function renderProduct(product) {
        var $card = $('.gift4you-card');
        $card.removeClass('d-none');
        $card.data('product-id', product.id);
        $('.gift4you-name').text(product.name);
        $('.gift4you-price').text(product.price);
        $('.gift4you-link').attr('href', product.url);

        if (product.image) {
            $('.gift4you-image').attr('src', product.image).show();
        } else {
            $('.gift4you-image').hide();
        }
    }

    function bindEvents() {
        $('.gift4you-spin-btn').on('click', function () {
            var $btn = $(this);
            $btn.prop('disabled', true).text('Крутим...');
            toggleAlert('');

            $.post(config.spinUrl, {}, function (response) {
                if (response.status === 'ok') {
                    renderProduct(response.data);
                } else {
                    toggleAlert(response.errors ? response.errors.join(', ') : 'Что-то пошло не так.');
                }
            }, 'json').fail(function () {
                toggleAlert('Сервер недоступен. Попробуйте позже.');
            }).always(function () {
                $btn.prop('disabled', false).text('Крутить');
            });
        });

        $('.gift4you-form').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            var $input = $form.find('input[type="email"]');
            var $feedback = $form.find('.invalid-feedback');
            var email = $.trim($input.val());
            var productId = $('.gift4you-card').data('product-id');

            if (!email || !productId) {
                $feedback.text('Сначала выберите подарок и укажите email.').show();
                return;
            }

            $feedback.hide();
            $.post(config.mailUrl, { email: email, product_id: productId }, function (response) {
                if (response.status === 'ok') {
                    $feedback.removeClass('text-danger').addClass('text-success').text('Письмо отправлено!').show();
                } else {
                    $feedback.removeClass('text-success').addClass('text-danger').text(response.errors ? response.errors.join(', ') : 'Ошибка отправки.').show();
                }
            }, 'json').fail(function () {
                $feedback.removeClass('text-success').addClass('text-danger').text('Сервер недоступен.').show();
            });
        });
    }

    $(function () {
        bindEvents();
    });
})(jQuery, window);

