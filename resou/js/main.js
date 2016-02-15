
require.config(
    {
        paths: {
            'jquery': '../lib/jquery-2.2.0.min',
            'bootstrap': '../lib/bootstrap/js/bootstrap',
            //加密库 base64
            'CryptoJS' : '../lib/CryptoJS/components/core-min',
            'enc-base64':'../lib/CryptoJS/components/enc-base64',
            'ku': 'ku',
            //demo test
            'test':'test',
        },
        map: {
            '*': {
                'css': '../lib/css'
            }
        },
        shim: {
            bootstrap: {
                deps: ['jquery'],
                exports: 'bootstrap'
            }
        }
    }
);

require(['jquery', 'bootstrap'], function ($, b)
{
    var script = $('script[data-main][data-model]'),
        models = script.attr('data-model').split(',');
    if (models.length > 0) {
        for (var i = 0; i < models.length; i++) {
            require([models[i]], function (m) {
                if (m && m.init) {
                    m.init();
                }
            });
        }
    }
});