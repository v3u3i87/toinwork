define(['alert','ku','api'],function (msg,ku,api)
{

    function run ()
    {
        user_quit();
    }

    /**
     * 用户退出
     */
    function user_quit()
    {
        $('.user-quit').on('click',function()
        {
            var req = api.quit();
            if(req.code == '200') {
                $.cookie("token", null, {path: "/"});
                msg.info('退出成功');
                return ku.jump('/');
            }else{
                return msg.info(req.msg);
            }
        });
    }

    return{
        usrRun:run
    }


});