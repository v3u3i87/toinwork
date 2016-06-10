define(['alert','jqcookie'],function (msg) {

    /**
     * 异步ajax
     * @param u
     * @param d
     * @param t
     * @returns {boolean}
     */
     var post = function (u, d, t)
     {
         var q = {type: t,url:u,dataType: 'json',data: d,async:0};
         var i = $.ajax(q).responseText;
         return i && typeof(i) == 'string' ?  JSON.parse(i) : false;
    };

    /**
     * 验证邮箱
     * @param t dom对象
     * @param v 值
     * @returns {boolean}
     */
    var emailCheck = function (t, v)
    {
        var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
        if (t && v)
        {
            if (!pattern.test(v))
            {
                msg.internal('请输入正确的邮箱地址');
                t.focus();
                return false;
            }
            return true;
        }
    };

    /**
     * 判断是否为空
     * @param value
     * @returns {boolean}
     */
    var is_null = function (value)
    {
        if (value !== null || value !== undefined || value !== '')
        {
            return true;
        }
        return false;
    };

    /**
     * 判断是否有值
     * @param t
     * @param v
     * @param i
     * @returns {boolean}
     */
    var is_focus =  function (t, v, i)
    {
        if (!is_null(v))
        {
            msg.internal(i);
            t.focus();
            return false;
        }
        return true;
    };

    /**
     * 执行转义
     * @param v
     * @returns {boolean}
     */
    var json = function (v)
     {
         if (!is_null(v))
         {
            return false;
         }

         switch (typeof(v))
         {
             case 'string':
                 return JSON.parse(v);
                 break;

             case 'object':
                 return JSON.stringify(v);
                 break;
             default:
                 console.log('json转换失败,未知的类型.');
                 break;
         }
    };

    //设置临时值
     var setVal = function (name, val)
     {

        if (!this.is_null(name))
        {
            msg.internal('没有名称值');
            return;
        }

        if (!this.is_null(val))
        {
            msg.internal('没有名称值');
            return;
        }
        $.cookie(name, val, {expires: 1});
    };

    //获取值
     var getVal = function (key)
    {
        return $.cookie(key);
    };

    /**
     * 跳转
     * @param u
     * @returns {*}
     */
    var jump = function(u){
        if(is_null(u))
        {
            return window.location.href = u;
        }
        console.log('没有正确的URL地址');
    };


    var getUrlParam  = function (name)
    {
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if(r!=null)
        {
            return  unescape(r[2]);
        }else{
            return null;
        }
    };

    //返回对象
    return {
        emailCheck: emailCheck,
        is_focus: is_focus,
        is_null: is_null,
        json: json,
        post: post,
        setVal: setVal,
        getVal: getVal,
        jump:jump,
        getUrlParam:getUrlParam,
    }


});