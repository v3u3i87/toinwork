define(['ku','alert','api','dataTables'],function (ku,msg,api) {

    var project_id = ku.getUrlParam('project_id');
    var design_id = ku.getUrlParam('design_id');

    var worksList = api.worksList(project_id,design_id);

    function init()
    {
        if(worksList && worksList.code == '200')
        {
            var data = worksList.data;
            $(".title_info").empty().text('返回项目-'+data.project.name).css({"cursor":"pointer"});
            $(".title_name").empty().text(data.design.name);

            //返回工作区
            $(document).on('click','.title_info',function()
            {
                return ku.jump('/main/workspace?project_id='+project_id);
            });

            if(data.table) {
                //渲染列表
                $(".info_tr").empty().html(th(data.table.th));
                $(".info_table").empty().html(td(data.table.list));
            }else{
                return msg.info('没有数据');
            }

        }else{
            return msg.info('抱歉,该工作区没有数据');
        }


    }


    function th(v)
    {
        var h = '';
        for(var i=0;i < v.length;i++)
        {
            h+='<th>'+v[i].name+'</th>';
        }
        return h;
    }

    function td(v)
    {
        //console.log(v);
        var h = '';
        for(var i=0;i < v.length;i++)
        {
            var info = v[i].td;
            h += '<tr>';
            for (var ii = 0; ii < info.length; ii++)
            {
                h += '<td>' + info[ii] + '</td>';
            }
            h += '</tr>';
        }
        return h;
    }


    return {
        init:init
    }


});