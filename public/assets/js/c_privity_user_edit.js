$(document).ready(function(){
    //模块定义
    var privityUserEditModule = function($){

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
        var user_back = function(){
            $("#user_modify_back").click(function(){
                loadingStart($(this));

                location.href = document.referrer;
                return false;
            });
        };

        //添加
        var user_edit = function(){
            $("#user_modify_submit").click(function(){
                //loading start
                var $btn = $(this);
                loadingStart($btn);
                //验证
                var valid = true;
                var msg = "";
                //check user pwd
                var user_pwd = $("#user_pwd").val();
                if(valid === true)
                {
					if(typeof(user_pwd) != "undefined" && user_pwd.length != 0)
                    {
                        if(!(user_pwd.length >= 6 && user_pwd.length <= 10))
                        {
                            valid = false;
                            msg = "6-10位字母、数字以及下划线!";
                        }
                    }
                }


                if(valid === true)
                {

                    var groupid = $("#group_list option:selected").val();

                    var senddata = new Array();
                    senddata[senddata.length] = "F_privity_group_id="+groupid;
                    senddata[senddata.length] = "F_id="+user_id;
					if(user_pwd.length > 0)
                    {
						senddata[senddata.length] = "F_login_password="+user_pwd;
                    }
                    $.ajax({
                        type: "POST",
                        url: user_modify_do_url,
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
            init:function(){user_back();user_edit();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    privityUserEditModule.init();
});