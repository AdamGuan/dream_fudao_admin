$(document).ready(function(){
    //模块定义
    var privityGroupManagerModule = function($){

        //批量
        var groupStatusChange_mulit = function() {

            //添加权限组
            $("#group_add").click( function() {
                location.href = group_add_url+"?refrence="+encodeURI(location.href);
                return false;
            });

        }

        //return obj
        var obj = {
            init:function(){groupStatusChange_mulit();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    privityGroupManagerModule.init();
});