define(['ku','alert','simditor'],function (ku,msg) {

    var editor = new Simditor({
        textarea: $('#editor')
    });


    $(".simditor-boxs").prepend('<div class="docs_name"><input type="text" placeholder="无标题"></div>');

});