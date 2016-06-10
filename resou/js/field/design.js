define(['ku','alert'],function (ku,msg)
{
    function init(key,v)
    {

        switch (key)
        {
            //文本类型
            case 'text':
                return text(v);
                break;
            //多行文本
            case 'textarea':
                return textarea(v);
                break;
            //富文本
            case 'editor':
                return editor(v);
                break;
            //数值
            case 'numerical':
                return numerical(v);
                break;
            //百分比
            case 'percentage':
                return percentage(v);
                break;
            //货币
            case 'money':
                return money(v);
                break;
            //单选
            case 'radio':
                return radio(v);
                break;
            //多选
            case 'radio':
                return radio(v);
                break;
            //下拉单选
            case 'select':
                return select(v);
                break;
            //下拉 多选
            case 'multiple':
                return multiple(v);
                break;
            //唯一用户
            case 'user_sole':
                return user_sole(v);
                break;
            //多选用户
            case 'user_multiple':
                return user_multiple(v);
                break;
            //上传图片
            case 'load_image':
                return load_image(v);
                break;
            //上传附件
            case 'load_annex':
                return load_annex(v);
                break;

            //关联数据
            case 'associate':
                return associate(v);
                break;
            //分隔区
            case 'separated':
                return separated(v);
                break;
        }

    }

    function text(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function textarea(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦."></textarea></dd>';
        h+='</dl>';
        return h;
    }


    function editor(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function numerical(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function percentage(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function money(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function radio(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function radio(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function select(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function multiple(v)
    {
        var h = '';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function user_sole(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function user_multiple(v)
    {
        var h = '';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function load_image(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function load_annex(v)
    {
        var h = '';
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function associate(v)
    {
        var h = ''
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>默认值</dt>';
        h+='<dd><input type="text" name="defaults" placeholder="请输入默认值"></dd>';
        h+='<dt>是否必填</dt>';
        h+='<dd><label><input type="radio" name="not_null" value="1"><span>否</span></label><label><input type="radio" name="not_null" value="2"><span>是</span></label></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }

    function separated(v)
    {
        var h = ''
        h+='<p>'+v.info+'</p>';
        h+='<dl>';
        h+='<dt>字段名称</dt>';
        h+='<dd><input type="text" name="name" class="in_name" placeholder="请输入字段名称"></dd>';
        h+='<dt>说明</dt>';
        h+='<dd><textarea name="explain" placeholder="请输入说明哦"></textarea></dd>';
        h+='</dl>';
        return h;
    }


    return {
        init:init
    }


});