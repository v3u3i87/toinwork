define(function () {

    var objAlert = $(".objAlert");

    /**
     * 内部使用
     * @param text
     * @returns {*}
     */
    function internal(text)
    {
        return objAlert.empty().html(warning(text));;
    }

    //成功
    function success(text)
    {
        return msg('alert-success','',text);
    }

    //信息
    function info(text)
    {
        return msg('alert-info','',text);
    }

    //警告
    function warning(text)
    {
        return msg('alert-warning','',text);
    }

    //危险
    function danger(text)
    {
        return msg('alert-danger','',text);
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
        return '<div class="alert '+className+'"><p>'+text+'</p><a href="#" class="close" data-dismiss="alert">×</a></div>';
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