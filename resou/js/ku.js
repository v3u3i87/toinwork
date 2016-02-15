define(function () {

    //异步ajax
     var post = function (_url, postData, _type) {
        var info = $.ajax({
            type: _type,
            url: _url,
            dataType: 'json',
            data: postData,
            async: 0
        }).responseText;
         //console.log(info);
        if (info) return JSON.parse(info);
    };

    //验证邮箱
    var emailCheck = function (_this, _val)
    {
        var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
        if (_this && _val)
        {
            if (!this.test(_val))
            {
                alert('请输入正确的邮箱地址');
                _this.focus();
                return false;
            }
            return true;
        }
    };

    //判断是否为空
    var is_null = function (value)
    {
        if (value !== null || value !== undefined || value !== '')
        {
            return true;
        }
        return false;
    };

    //判断是否有值
    var is_focus =  function (_this, _val, _info)
    {
        if (_val == null || _val == undefined || _val == '')
        {
            alert(_info);
            _this.focus();
            return false;
        }
        return true;
    };

    //执行转义
    var json = function (jsonVal)
     {
         if (this.is_null(jsonVal)) {
             switch (typeof(jsonVal)) {
                 case 'string':
                     return JSON.parse(jsonVal);
                     break;

                 case 'object':
                     return JSON.stringify(jsonVal);
                     break;
                 default:
                     console.log('json转换失败,未知的类型.');
                     break;
             }
         }else{
             return false;
         }
    };

    //设置临时值
     var setVal = function (name, json)
     {

        if (!this.is_null(name))
        {
            alert('没有名称值');
            return;
        }

        if (!this.is_null(json))
        {
            alert('没有名称值');
            return;
        }
        $.cookie(name, json, {expires: 1});
    };

    //获取值
     var getVal = function (key)
    {
        return $.cookie(key);
    };

    //返回对象
    return {
        emailCheck: emailCheck,
        is_focus: is_focus,
        is_null: is_null,
        json: json,
        post: post,
        setVal: setVal,
        getVal: getVal
    }


});