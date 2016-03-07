console.log('喜欢看toinwork的代码，还是发现了什么bug？不如和我们一起为toinwork添砖加瓦吧!');
console.log('感兴趣就找v3u3i87@gmail.com');

require.config(
    {
        paths: {
            'jquery': '../lib/jquery-2.2.0.min',
            'bootstrap': '../lib/bootstrap/js/bootstrap.min',
            //加密库 base64
            'CryptoJS' : '../lib/CryptoJS/components/core-min',
            'enc-base64':'../lib/CryptoJS/components/enc-base64',
            'ku': 'ku',
            'alert':'alert',
            //demo test
            'test':'test',
            'login':'login'
        },

        //map: {
        //    '*': {
        //        'jquery': 'materialize'
        //    }
        //},
        shim: {
            bootstrap: {
                deps: ['jquery'],
                exports: 'bootstrap'
            }
        }

    }
);
require(['jquery','bootstrap'],function ($,b) {
    //设置提示框
    $('body').prepend('<div class="objAlert"></div>');
    
    var script = $('script[data-main][data-model]');
    var models = script.attr('data-model').split(',');
    if (models.length > 0)
    {
        for (var i = 0; i < models.length; i++)
        {
            require([models[i]], function (m)
            {
                if (m && m.init)
                {
                    m.init();
                }
            });
        }

    }
});

