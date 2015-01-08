$(document).ready(function(){
    //模块定义
    var publishEditModule = function($){

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
        var publish_back = function(){
            $("#publish_edit_back").click(function(){
                //loading start
                 var $btn = $(this);
                loadingStart($btn);

                location.href = document.referrer;
                return false;
            });
        };

        //修改
        var publish_modify = function(){
            $("#publish_edit_submit").click(function(){
                //loading start
                 var $btn = $(this);
                loadingStart($btn);
                //验证
                var valid = true;
                var msg = "";
                //check F_title
                var F_title = $("#publish_title").val();
                if(valid === true)
                {
                    if(!(typeof(F_title) != "undefined" && F_title.length > 0 && F_title.length <= 250))
                    {
                        valid = false;
                        msg = "必须填写";
                    }
                }
                //check F_title
                var F_content = $("#publish_content").val();
                if(valid === true)
                {
                    if(!(typeof(F_content) != "undefined" && F_content.length > 0))
                    {
                        valid = false;
                        msg = "必须填写";
                    }
                }
                //ajax send
                if(valid === true)
                {
                    var senddata = new Array();
                    senddata[senddata.length] = "F_title="+F_title;
                    senddata[senddata.length] = "F_content="+F_content;
                    senddata[senddata.length] = "F_id="+F_id;
                    $.ajax({
                        type: "POST",
                        url: modify_url,
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
            init:function(){publish_modify();publish_back();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    publishEditModule.init();

});