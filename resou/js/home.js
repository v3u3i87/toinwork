define(['ku','alert','api'],function (ku,msg,api) {


    //获取项目列表
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
                return ku.jump('/main/workspace?project_id='+project_id);
            });

        }else{
            return msg.info('hi,您并没有加入任何项目哦..');
        }
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