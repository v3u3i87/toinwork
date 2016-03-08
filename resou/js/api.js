define(['ku','alert'],function (ku,msg) {

    /**
     * 获取字段列表
     * @returns {boolean}
     */
    function getFieldList()
    {
        return ku.post('/api/v1/tag/sys/field',{},'GET');
    }

    return {
        getFieldList:getFieldList
    }


});