console.log('喜欢看toinwork的代码，还是发现了什么bug？不如和我们一起为toinwork添砖加瓦吧!');
console.log('感兴趣就找v3u3i87@gmail.com');

require.config(
    {
        paths: {
            'jquery': '../lib/jquery-2.2.0.min',
            'materialize': '../lib/materialize/js/materialize.min',
            //加密库 base64
            'CryptoJS' : '../lib/CryptoJS/components/core-min',
            'enc-base64':'../lib/CryptoJS/components/enc-base64',
            'ku': 'ku',
            //demo test
            'test':'test',
            'login':'login'
        },

        //map: {
        //    '*': {
        //        'jquery': 'materialize'
        //    }
        //},
        //shim: {
        //    materialize: {
        //        deps: ['jquery'],
        //        exports: 'materialize'
        //    }
        //}

    }
);

require(['jquery'],function ($) {
    var script = $('script[data-main][data-model]');
    var models = script.attr('data-model').split(',');

    if (models.length > 0)
    {
        console.log(models);
        //require('materialize');
        for (var i = 0; i < models.length; i++)
        {
            console.log(models[i]);
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