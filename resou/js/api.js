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
        return ku.post('/api/v1/tag/sys/field',{},'POST');
    }

    /**
     * 获取项目列表
     * @returns {boolean}
     */
    function projectList()
    {
        return ku.post('/api/v1/project/list?token='+token,{},'POST');
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
        return ku.post('/api/v1/works/list',{token:token,project_id:project_id,design_id:design_id},'POST');
    }


    /**
     * 工作详情
     * @param project_id
     * @param design_id
     * @param works_id
     * @returns {boolean}
     */
    function worksShow(project_id,design_id,works_id)
    {
        return ku.post('/api/v1/works/show',{token:token,project_id:project_id,design_id:design_id,works_id:works_id},'POST');
    }


    /**
     * 退出
     * @returns {boolean}
     */
    function quit()
    {
        return ku.post('/api/v1/user/quit',{client:'web',token:token},'POST');
    }

    /**
     * 返回函数
     */
    return {
        getFieldList:getFieldList,
        projectList:projectList,
        designList:designList,
        worksList:worksList,
        worksShow:worksShow,
        quit:quit
    }


});