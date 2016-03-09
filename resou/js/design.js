define(['ku','alert','api','Sortable'],function (ku,msg,api,Sortable) {

    var fieldData = api.getFieldList();

    var field_list = document.getElementById("field_list");
    var diy_design_field = document.getElementById("diy_design_field");

    function init()
    {
        if(fieldData)
        {
            //渲染字段
            viewField(fieldData.data);
            //返回跳转
            backJump();
            //拖拉逻辑
            sortableLogin();


            //删除事件
            $(".item").click(function(){
                $(this).find(".setB").empty().append('<span class="close del">×</span>');
            });

            //删除对象
            $(document).on('click','.del',function(){
                $(".on").remove();
            });

            $(document).on('click','#diy_design_field li',function() {
                $(this).addClass('on').siblings().removeClass('on');
            });

        }else{
            msg.info('获取字段失败');
        }
    }

    /**
     * 拖拉逻辑
     * @constructor
     */
    function sortableLogin()
    {

        Sortable.create(field_list, {
            group: {
                name: 'field',
                pull: 'clone',
                put: false
            },
            sort: false,
        });

        // sort: false
        Sortable.create(diy_design_field, {
            group: {
                name: 'field',
                pull: false,
                put: true
            },
            sort: true,
        });
    }

    /**
     * 跳转
     */
    function backJump()
    {
        $(".confirm_jump").click(function(){
            console.log('跳转');
            ku.jump('/main/home');
        });
    }

    /**
     * 渲染字段
     * @param v
     */
    function viewField(v)
    {
        //console.log(v);
        var h = '';
        for(var i=0;i < v.length;i++)
        {
            h+='<li class="item">'+v[i].name+'<span class="setB"></span><div class="li-show"><input type="text"></div></li>';
        }
        //console.log(h);
        $(".field_ul").empty().html(h);
    }

    return {
        init:init
    }


});