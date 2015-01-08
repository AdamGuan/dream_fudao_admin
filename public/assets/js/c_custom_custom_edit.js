$(document).ready(function(){
    //模块定义
    var customEditModule = function($){

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

        //返回
        var custom_back = function(){
            $("#custom_edit_back").click(function(){
                loadingStart($(this));
                location.href = document.referrer;
                return false;
            });
        };

        //修改客服
        var custom_modify = function(){
            $("#custom_edit_submit").click(function(){
                var $btn = $(this);
                $("#my-confirm-msg").html("确定修改?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        //loading start
                        loadingStart($btn);
                        //验证
                        var valid = true;
                        var msg = "";
                        //check custom pwd
                        var F_custom_password = $("#custom_login_pwd").val();
                        if(valid === true)
                        {
                            if(typeof(F_custom_password) != "undefined" && F_custom_password.length != 0)
                            {
                                if(!(F_custom_password.length >= 6 && F_custom_password.length <= 10))
                                {
                                    valid = false;
                                    msg = "6-10位字母、数字以及下划线!";
                                }
                            }
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
                                url: custom_modify_url,
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
                    },
                    onCancel: function() {
                    }
                });



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