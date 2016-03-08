define(['ku','alert','api','Sortable'],function (ku,msg,api,Sortable) {

    var fieldData = api.getFieldList();

    function init()
    {
        if(fieldData)
        {
            //渲染字段
            viewField(fieldData.data);

            var field_list = document.getElementById("field_list");
            var diy_design_field = document.getElementById("diy_design_field");

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

            $(".item").click(function(){
                $(this).find(".setB").empty().append('<span class="close del">×</span>');
                console.log(1);
            });
            //删除
            $(".del").click();
            $('#diy_design_field li').click(function(){$(this).addClass('on').siblings().removeClass('on');})
        }else{
            msg.info('获取字段失败');
        }
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
            h+='<li class="item">'+v[i].name+'<span class="setB"></span></li>';
        }
        //console.log(h);
        $(".field_ul").empty().html(h);
    }

    return {
        init:init
    }


});