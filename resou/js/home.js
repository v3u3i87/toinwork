define(['ku','fakeLoader'],function (ku) {


    function init()
    {
        $(".objAlert").append('<div id="fakeLoader"></div>');
        $("#fakeloader").fakeLoader({
            timeToHide:12000, //Time in milliseconds for fakeLoader disappear
            zIndex:"999",//Default zIndex
            spinner:"spinner6",//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
            bgColor:"#000", //Hex, RGB or RGBA colors
            //imagePath:"yourPath/customizedImage.gif" //If you want can you insert your custom image
        });
    }
    
    return {
        init:init
    }


});