$(document).ready(function(){
    //模块定义
    var customAddModule = function($){

        var custom_back = function(){
            $("#custom_add_back").click(function(){
                location.href = document.referrer;
                return false;
            });
        };

        var custom_add = function(){
            $("#custom_add_submit").click(function(){
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
                //验证
                var valid = true;
                var msg = "";
                //check custom login name
                var F_teacher_name = $("#custom_login_name").val();
                if(valid === true)
                {
                    if(!(typeof(F_teacher_name) != "undefined" && F_teacher_name.length > 0 && F_teacher_name.length <= 30))
                    {
                        valid = false;
                        msg = "帐号必须填写,并且小于等于30个字符!";
                    }
                }
                //check teacher pwd
                var F_teacher_password = $("#custom_login_pwd").val();
                if(valid === true)
                {
                    if(!(typeof(F_teacher_password) != "undefined" && F_teacher_password.length >= 6 && F_teacher_password.length <= 9))
                    {
                        valid = false;
                        msg = "密码必须填写,并且大于等于6个字符小于等于9个字符!";
                    }
                }
                //check teacher real name
                var F_real_name = $("#custom_realname").val();
                if(valid === true)
                {
                    if(!(typeof(F_real_name) != "undefined" && F_real_name.length > 0 && F_real_name.length <= 12))
                    {
                        valid = false;
                        msg = "名字必须填写,并且小于等于12个字符!";
                    }
                }
                //check teacher gender
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
                    senddata[senddata.length] = "F_teacher_name="+F_teacher_name;
                    senddata[senddata.length] = "F_teacher_password="+F_teacher_password;
                    senddata[senddata.length] = "F_real_name="+F_real_name;
                    senddata[senddata.length] = "F_gender="+F_gender;
                    $.ajax({
                        type: "POST",
                        url: "custom_add_do",
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
            init:function(){custom_add();custom_back();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    customAddModule.init();

});