/**
 * Copyright © 2020 Magenest. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Magenest_LiveStreaming extension
 * NOTICE OF LICENSE
 *
 * @category Magenest
 * @package Magenest_LiveStreaming
 */
define([
    'jquery',
    'moment'
], function ($, moment) {
    'use strict';

    return function (validator) {
        validator.addRule(
            'vn-validate-phone',
            function (value) {
                return /(84|0[3|5|7|8|9])+([0-9]{8})\b/.test(value);
            },
            $.mage.__('Incorrect VN number phone format.')
        );
        return validator;
    };
});
