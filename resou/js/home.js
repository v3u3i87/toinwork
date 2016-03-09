define(['ku','alert','api'],function (ku,msg,api) {


    var projectList = api.projectList();

    function init()
    {
        if(projectList && projectList.code == '200')
        {
            viewProjectList(projectList.data);

            $(".item").click(function(){
                var project_id = $(this).data('project_id');
                var designList = api.designList(project_id);
                if(designList && designList.code=='200') {
                    $(".main").empty();
                    var project = designList.data.project;
                    $(".title_info").empty().text('返回');
                    $(".title_name").empty().text(project.name);
                    viewDesignList(designList.data);
                }else{
                    msg.info('该项目没有设计工作区');
                }

            });
        }
    }


    /**
     * 渲染设计列表
     * @param v
     */
    function viewDesignList(tmp)
    {
        console.log(tmp);
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
        console.log(v);
        var h = '';
        for(var i=0;i < v.length;i++)
        {
            h+='<li class="item" data-project_id="'+v[i].project_id+'">'+v[i].name+'</li>';
        }
        $(".projectList").empty().html(h);
    }



    return {
        init:init
    }


});