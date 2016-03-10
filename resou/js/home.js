define(['ku','alert','api'],function (ku,msg,api) {


    var projectList = api.projectList();

    function init()
    {
        if(projectList && projectList.code == '200')
        {
            //渲染项目列表
            viewProjectList(projectList.data);
            //切换区域渲染
            $(document).on('click','.item',function() {
                var project_id = $(this).data('project_id');
                var designList = api.designList(project_id);
                designListLogic(designList,projectList.data);
            });

            //切换区域渲染
            $(document).on('click','.designItem',function() {
                var project_id = $(this).data('project_id');
                var design_id = $(this).data('design_id');
                ku.jump('/main/works?project_id='+project_id+'&design_id='+design_id);
            });

        }else{
            msg.info('hi,您并没有加入任何项目哦..');
        }
    }


    /**
     * 设计列表逻辑
     * @param designList
     */
    function designListLogic(designList,projectList)
    {
        if(designList && designList.code=='200') {
            $(".main").empty();
            var project = designList.data.project;
            $(".title_info").empty().text('返回').css({"cursor":"pointer"});
            $(".title_name").empty().text(project.name);
            viewDesignList(designList.data);
            clickTitleInfo(projectList);
        }else{
            msg.info('该项目没有设计工作区');
        }
    }


    /**
     * 点击标题信息事件
     * 删除当前项目设计工作区
     */
    function clickTitleInfo(projectList)
    {
        $(".title_info").click(function(){
            console.log('info_click');
            $(".title_info").empty().text('项目公共');
            $(".title_name").empty().text('操作区域');
            $(".main").empty();
            viewProjectList(projectList);
        });
    }

    /**
     * 渲染设计列表
     * @param v
     */
    function viewDesignList(tmp)
    {
        //console.log(tmp);
        var v = tmp.list
        var h = '<ul class="designList">';
        for(var i=0;i < v.length;i++)
        {
            h+='<li class="designItem" data-project_id="'+v[i].project_id+'" data-design_id="'+v[i].design_id+'">'+v[i].name+'</li>';
        }
        h+='</ul>';
        $(".main").empty().html(h);
    }


    /**
     * 渲染项目列表
     * @param v
     */
    function viewProjectList(v)
    {
        //console.log(v);
        var h = '<ul class="projectList">';
        for(var i=0;i < v.length;i++)
        {
            h+='<li class="item" data-project_id="'+v[i].project_id+'">'+v[i].name+'</li>';
        }
        h+='</ul>';
        $(".main").empty().html(h);
    }

    return {
        init:init
    }


});