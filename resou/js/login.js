//第一个参数可以为空,如没有需要加载的组件
define(['ku'],function (ku) {

    function init()
    {
        //console.log($(".login_main"));
        console.log('login,顺利加载');
    }

    $(".Toast").click(function(){
        //console.log(typeof(Materialize));
        //Materialize.toast('I am a toast!', 3000, 'rounded');
    });



    //返回初始化
    return {
        init:init
    }

});