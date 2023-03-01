define([
    'Magento_Ui/js/modal/alert',
    'Magento_Ui/js/modal/modal',
    'jquery'
], function (alert, modal, $) {
    $('#first_button').click(function () {
        alert({
            title: $.mage.__('Hello World!'),
            content: $.mage.__('Hello World! Content'),
            actions: {
                always: function(){}
            }
        });
    })

    $('#second_button').click(function () {
        var options = {
            type: 'popup',
            title: 'Login Modal',
            buttons: [{
                text: $.mage.__('Close'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            }]
        };

        var popup = modal(options, $('#modal-content'));
        $('#modal-content').modal('openModal');
    })

    $('#third_button').click(function () {
        var options = {
            type: 'popup',
            title: 'Login Modal',
            buttons: [{
                text: $.mage.__('Close'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            }]
        };

        var popup = modal(options, $('#modal-login'));
        $('#modal-login').modal('openModal');
    })
});
