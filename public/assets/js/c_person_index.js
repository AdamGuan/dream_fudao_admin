$(document).ready(function(){
    //模块定义
    var personModule = function($){

        //loading start
        var loadingStart = function(obj){
            obj.button('loading');
            $.AMUI.progress.start();
        };

        //loading end
        var loadingEnd = function(obj){
            obj.button('reset');
            $.AMUI.progress.done();
        };

        //back btn
        var back = function(){
            $("#edit_back").click(function(){
                //loading start
                 var $btn = $(this);
                loadingStart($btn);

                location.href = document.referrer;
                return false;
            });
        };

        //修改
        var modify = function(){
            $("#edit_submit").click(function(){
                //loading start
                 var $btn = $(this);
                loadingStart($btn);
                //验证
                var valid = true;
                var msg = "";
                //check pwd
                var F_login_password = $("#login_pwd").val();
                if(valid === true)
                {
                    if(typeof(F_login_password) != "undefined" && F_login_password.length != 0)
                    {
                        if(!(F_login_password.length >= 6 && F_login_password.length <= 9))
                        {
                            valid = false;
                            msg = "6-10位字母、数字以及下划线!";
                        }
                    }
                }
                //ajax send
                if(valid === true)
                {
                    var senddata = new Array();
                    if(F_login_password.length > 0)
                    {
                        senddata[senddata.length] = "F_login_password="+F_login_password;
                    }
                    $.ajax({
                        type: "POST",
                        url: do_modify_info_url,
                        data: senddata.join("&"),
                        success: function(msg){
                            //success
                            if(typeof(msg.error) != "undefined" && msg.error == 0)
                            {
                                location.href = document.referrer;
                            }
                            else{
                                 //loading end
                                loadingEnd($btn);
                                //show error
                                $("#my-alert-message").html(msg.msg);
                                $('#my-alert').modal('open');
                            }
                        }
                    });
                }
                else{
                    //loading end
                    loadingEnd($btn);
                    //show error
                    $("#my-alert-message").html(msg);
                    $('#my-alert').modal('open');
                }

                return false;
            });
        };

        //return obj
        var obj = {
            init:function(){modify();back();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    personModule.init();

});