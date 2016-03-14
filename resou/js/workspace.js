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
        $(".title_name").empty().text('无工作区');

        $(".logo").click(function(){
            return ku.jump('/main/home');
        });

        if(designList && designList.code=='200')
        {
            var project = designList.data.project;
            $(".title_name").empty().text(project.name);


            viewDesignList(designList.data);

            //切换区域渲染
            $(document).on('click','.designItem',function() {
                var project_id = $(this).data('project_id');
                var design_id = $(this).data('design_id');
                return ku.jump('/main/works?project_id='+project_id+'&design_id='+design_id);
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