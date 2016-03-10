define(['ku','alert'],function (ku,msg) {

    var token = ku.getVal('token');

    if(!token)
    {
        msg.danger('抱歉,您非法登陆');
    }

    /**
     * 获取字段列表
     * @returns {boolean}
     */
    function getFieldList()
    {
        return ku.post('/api/v1/tag/sys/field',{},'GET');
    }

    /**
     * 获取项目列表
     * @returns {boolean}
     */
    function projectList()
    {
        return ku.post('/api/v1/project/list?token='+token,{},'GET');
    }


    /**
     * 设计列表
     * @returns {boolean}
     */
    function designList(project_id)
    {
        return ku.post('/api/v1/design/list',{token:token,project_id:project_id},'POST');
    }


    /**
     * 获取工作列表
     * @param project_id
     * @param design_id
     * @returns {boolean}
     */
    function worksList(project_id,design_id)
    {
        return ku.post('/api/v1/works/list',{token:token,project_id:project_id,design_id:design_id},'GET');
    }


    /**
     * 返回函数
     */
    return {
        getFieldList:getFieldList,
        projectList:projectList,
        designList:designList,
        worksList:worksList
    }


});