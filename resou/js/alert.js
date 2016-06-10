define(function () {

    var objAlert = $(".objAlert");
    var number = 700;

    /**
     * 内部使用
     * @param text
     * @returns {*}
     */
    function internal(text)
    {
        return warning(text);
    }

    //成功
    function success(text)
    {
        objAlert.empty().html(msg('alert-success','',text));
        return setTimeout(function () {
            return objAlert.empty();
        }, number);
    }

    //信息
    function info(text)
    {
        objAlert.empty().html(msg('alert-info','',text));
        return setTimeout(function () {
            return objAlert.empty();
        }, number);
    }

    //警告
    function warning(text)
    {
         objAlert.empty().html(msg('alert-warning','',text));
        return setTimeout(function () {
            return objAlert.empty();
        }, number);
    }

    //危险
    function danger(text)
    {
        objAlert.empty().html(msg('alert-danger','',text));
        return setTimeout(function () {
            return objAlert.empty();
        }, number);
    }

    /**
     * 返回消息类型
     * @param className
     * @param type
     * @param text
     * @returns {string}
     */
    function msg(className,type,text)
    {
        return '<div class="alert '+className+'"><span>'+text+'</span><a href="#" class="close" data-dismiss="alert">×</a></div>';
    }

    //返回对象
    return {
        internal:internal,
        success:success,
        info:info,
        warning:warning,
        danger:danger
    }

});