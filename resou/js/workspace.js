define(['ku','alert','api'],function (ku,msg,api) {

    //获取项目ID
    var project_id = ku.getUrlParam('project_id');

    if(ku.is_null(project_id) === null)
    {
        return msg.info('抱歉,没有数据');
    }

    var designList = api.designList(project_id);

    function init()
    {

        if(designList && designList.code=='200')
        {
            $(".main").empty();
            var project = designList.data.project;
            $(".title_info").empty().text('返回').css({"cursor":"pointer"});
            $(".title_name").empty().text(project.name);

            $(".title_info").click(function(){
                return ku.jump('/main/home');
            });

            viewDesignList(designList.data);

            //切换区域渲染
            $(document).on('click','.designItem',function() {
                var project_id = $(this).data('project_id');
                var design_id = $(this).data('design_id');
                ku.jump('/main/works?project_id='+project_id+'&design_id='+design_id);
            });

        }else{
           return msg.info('该项目没有设计工作区');
        }

    }

    /**
     * 渲染设计列表
     * @param v
     */
    function viewDesignList(tmp)
    {
        var v = tmp.list
        var h = '<ul class="designList">';
        for(var i=0;i < v.length;i++)
        {
            h+='<li class="designItem" data-project_id="'+v[i].project_id+'" data-design_id="'+v[i].design_id+'">'+v[i].name+'</li>';
        }
        h+='</ul>';
        $(".main").empty().html(h);
    }



    return {
        init:init,
    }
});