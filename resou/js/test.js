//第一个参数可以为空,如没有需要加载的组件
define(['ku','CryptoJS','enc-base64'], function (ku) {

    function init()
    {
        console.log('顺利加载');
        Encryption_decrypt_Demo();
    }

    //加密解密
    function Encryption_decrypt_Demo()
    {


        //console.log(base64);
        $(".setEnc").click(function(){
            //设置数据
            var setData = $(".setData").val();
            console.log(setData);
            //加密
            var str = CryptoJS.enc.Utf8.parse(setData);
            var base64 = CryptoJS.enc.Base64.stringify(str);

            $(".getData").empty().text(base64);

        });


        ////解密
        //var words = CryptoJS.enc.Base64.parse(base64);
        //try {
        //    var dn = words.toString(CryptoJS.enc.Utf8);
        //    //console.log(dn);
        //    //console.log(ku.json(dn));
        //} catch (e) {
        //    alert('格式有误');
        //}
        //
        //var req = ku.post('/test',{'in':base64},'post');
        //console.log(req);
    }



    //返回初始化
    return {
        init: init
    }


});