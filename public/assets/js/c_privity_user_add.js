$(document).ready(function(){
    //模块定义
    var privityUserAddModule = function($){

        //
        var user_back = function(){
            $("#user_add_back").click(function(){
                location.href = document.referrer;
                return false;
            });
        };

        var user_add = function(){
            $("#user_add_submit").click(function(){
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
                //验证
                var valid = true;
                var msg = "";
                //check user name
                var user_name = $("#user_name").val();
                if(valid === true)
                {
                    if(!(typeof(user_name) != "undefined" && user_name.length > 0 && user_name.length <= 30))
                    {
                        valid = false;
                        msg = "用户名必须填写,并且小于等于30个字符!";
                    }
                }
                //check user pwd
                var user_pwd = $("#user_pwd").val();
                if(valid === true)
                {
                    if(!(typeof(user_pwd) != "undefined" && user_pwd.length >= 6 && user_pwd.length <= 30))
                    {
                        valid = false;
                        msg = "用户密码必须填写,并且6到9个字符!";
                    }
                }


                if(valid === true)
                {
                    /*
                    var groupid = $("#group_list option:selected").val();

                    var senddata = new Array();
                    if(typeof(groupid) != "undefined"){
                        senddata[senddata.length] = "F_pid="+groupid;
                    }
                    senddata[senddata.length] = "F_name="+group_name;
                    senddata[senddata.length] = "F_privity="+privity;
                    if(typeof(childcould) != "undefined"){
                        senddata[senddata.length] = "F_could_has_child="+childcould;
                    }
                    $.ajax({
                        type: "POST",
                        url: "group_add_do",
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
                    */

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
            init:function(){user_back();user_add();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    privityUserAddModule.init();
});