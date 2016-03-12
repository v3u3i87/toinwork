define(['ku','alert','api'],function(ku,msg,api)
{
     var data = {
         project_id:ku.getUrlParam('project_id'),
         design_id:ku.getUrlParam('design_id'),
         works_id:ku.getUrlParam('works_id')
     };
     console.log(data);
    var show = api.worksShow(data.project_id,data.design_id,data.works_id);
    console.log(show);

    function init()
    {

    }



    return {init:init}
});