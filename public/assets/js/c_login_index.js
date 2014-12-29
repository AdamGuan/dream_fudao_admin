$(document).ready(function(){
    //模块定义
    var loginModule = function($){

        var login = function(){
            $("#loginformbtn").click(function(){
                //检查用户名以及密码
                var name = $("#name").val();
                var pwd = $("#password").val();
                if(typeof(name) != "undefined" && typeof(pwd) != "undefined" && name.length > 0 && pwd.length > 0)
                {
                    //ajax
                }
                return false;
            });
        };

        //return obj
        var obj = {
            init:function(){login();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    loginModule.init();

});