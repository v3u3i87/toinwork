define(['ku','alert','api','Sortable','field-design'],function (ku,msg,api,Sortable,design) {

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
            setSortableLogin();
            //删除事件
            $(".item").click(function(){
                $(this).find(".setB").empty().append('<span class="close del">×</span>');
                //$(".setB").mouseleave().remove();
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
    function setSortableLogin()
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
        $(".confirm_jump").click(function()
        {
            console.log('跳转');
            return ku.jump('/main/home');
        });
    }

    /**
     * 渲染字段
     * @param v
     */
    function viewField(v)
    {
        var h = '';
        for(var i=0;i < v.length;i++)
        {
            h+='<h5>'+v[i].name+'</h5>';
            if(ku.is_null(v[i]['list']))
            {
                var list = v[i]['list'];
                for(var ii=0;ii<list.length;ii++)
                {
                    var lv = list[ii];
                    var key = lv.field;
                    h+='<li class="item">';
                    h+= '<span class="set_name">'+lv.name+'</span>';
                    h+='<span class="setB"></span>';
                    h+='<div class="li-show">';
                        h+= design.init(key,lv);
                    h+='</div>';
                    h+='</li>';
                }
            }

        }
        $(".field_ul").empty().html(h);
    }


    return {
        init:init
    }


});