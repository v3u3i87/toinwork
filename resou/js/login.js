//第一个参数可以为空,如没有需要加载的组件
define(['ku','alert'],function (ku,alert) {

    var objAlert = $(".objAlert");

    function init()
    {
        var obj = {email:$(".email"),passwd:$(".passwd")};
        $(".login_submit").click(function()
        {
            var emailVal = obj.email.val();
            if(ku.emailCheck(obj.email,emailVal) && ku.is_focus(obj.email,emailVal,'抱歉,邮箱不能为空'))
            {
                var passwdVal = obj.passwd.val();
                ku.is_focus(obj.passwd,passwdVal,'抱歉,密码不能为空');
                var req = ku.post('/api/v1/user/login', {email: emailVal, passwd: passwdVal}, 'POST');
                if (req && req.code == '200')
                {
                    console.log(req);
                    objAlert.empty().html(alert.success('正在登陆,请稍后'));
                } else {
                    objAlert.empty().html(alert.warning(req.msg));
                }
            }
        });
    }

    //返回初始化
    return {
        init:init
    }

});