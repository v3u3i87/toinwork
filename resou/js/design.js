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
                group: "sorting",
                sort: false,
                //handle: ".my-handle"
            });

            // sort: false
            Sortable.create(diy_design_field, {
                group: "sorting",
                sort: true
            });


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
            h+='<li>'+v[i].name+'</li>';
        }
        //console.log(h);
        $(".field_ul").empty().html(h);
    }

    return {
        init:init
    }


});