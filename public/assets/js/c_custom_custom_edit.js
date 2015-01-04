$(document).ready(function(){
    //模块定义
    var customEditModule = function($){

        var custom_back = function(){
            $("#custom_edit_back").click(function(){
                location.href = document.referrer;
                return false;
            });
        };

        var custom_modify = function(){
            $("#custom_edit_submit").click(function(){
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
                //验证
                var valid = true;
                var msg = "";
                //check custom pwd
                var F_custom_password = $("#custom_login_pwd").val();
                if(valid === true)
                {
                    if(typeof(F_custom_password) != "undefined" && F_custom_password.length != 0)
                    {
                        if(!(F_custom_password.length >= 6 && F_custom_password.length <= 9))
                        {
                            valid = false;
                            msg = "密码必须填写,并且大于等于6个字符小于等于9个字符!";
                        }
                    }
                    F_custom_password = "";
                }
                //check custom real name
                var F_real_name = $("#custom_realname").val();
                if(valid === true)
                {
                    if(!(typeof(F_real_name) != "undefined" && F_real_name.length > 0 && F_real_name.length <= 12))
                    {
                        valid = false;
                        msg = "名字必须填写,并且小于等于12个字符!";
                    }
                }
                //check custom gender
                var F_gender = $("#custom_gender option:selected").val();
                if(valid === true)
                {
                    if(!(typeof(F_gender) != "undefined"))
                    {
                        valid = false;
                        msg = "请选择性别!";
                    }
                }
                //ajax send
                if(valid === true)
                {
                    var senddata = new Array();
                    if(F_custom_password.length > 0)
                    {
                        senddata[senddata.length] = "F_teacher_password="+F_custom_password;
                    }
                    senddata[senddata.length] = "F_real_name="+F_real_name;
                    senddata[senddata.length] = "F_gender="+F_gender;
                    senddata[senddata.length] = "F_teacher_id="+F_teacher_id;
                    $.ajax({
                        type: "POST",
                        url: "custom_modify",
                        data: senddata.join("&"),
                        success: function(msg){
                            //loading end
                            $btn.button('reset');
                            $.AMUI.progress.done();
                            //success
                            if(typeof(msg.error) != "undefined" && msg.error == 0)
                            {
                                location.href = document.referrer;
                            }
                            else{
                                //show error
                                $("#my-alert-message").html(msg.msg);
                                $('#my-alert').modal('open');
                            }
                        }
                    });
                }
                else{
                    //loading end
                    $btn.button('reset');
                    $.AMUI.progress.done();
                    //show error
                    $("#my-alert-message").html(msg);
                    $('#my-alert').modal('open');
                }

                return false;
            });
        };

        //return obj
        var obj = {
            init:function(){custom_modify();custom_back();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    customEditModule.init();

});