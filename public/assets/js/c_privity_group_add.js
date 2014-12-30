$(document).ready(function(){
    //模块定义
    var privityGroupAddModule = function($){

        //
        var privity_checked = function(){
            $("input[id^='privity_check_']").click(function(){
                var num = $(this).data("num");
                if(typeof(num) == 'undefined' || num == 0)
                {
                    $("input[id^='"+$(this).attr("id")+"_']").prop("checked",true);
                    $(this).data("num",1);
                    $("input[id^='"+$(this).attr("id")+"_']").data("num",1);
                }
                else
                {
                    $("input[id^='"+$(this).attr("id")+"_']").prop("checked",false);
                    $(this).data("num",0);
                    $("input[id^='"+$(this).attr("id")+"_']").data("num",0);
                }
            });
            $("#check_all").click(function(){
                var num = $(this).data("num");
                if(typeof(num) == 'undefined' || num == 0)
                {
                    $("input[id^='privity_check_']").prop("checked",true);
                    $(this).data("num",1);
                    $("input[id^='privity_check_']").data("num",1);
                }
                else
                {
                    $("input[id^='privity_check_']").prop("checked",false);
                    $(this).data("num",0);
                    $("input[id^='privity_check_']").data("num",0);
                }
            });
        };

        //
        var group_select = function(){

            $("#group_list").change( function () {
                var group_id = $("#group_list option:selected").attr("value");
                 //loading start
                $.AMUI.progress.start();
                $("#privity_html").html("loading...");
                //ajax
                $.ajax({
                    type: "GET",
                    url: "get_privity_htmlstr",
                    data: "group_id="+group_id,
                    success: function(msg){
                        //loading end
                        $.AMUI.progress.done();
                        $("#privity_html").html(msg.htmlstr);
                        privity_checked();
                    }
                });

            } );
        };

        //
        var group_back = function(){
            $("#group_add_back").click(function(){
                if(typeof(refrence) != "undefined")
                {
                    top.location.href  = refrence;
                }
            });
        };

        var group_add = function(){
            $("#teacher_add_submit").click(function(){
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
                //验证
                var valid = true;
                var msg = "";
                //check group name
                var group_name = $("#group_name").val();
                if(valid === true)
                {
                    if(!(typeof(group_name) != "undefined" && group_name.length > 0 && group_name.length <= 30))
                    {
                        valid = false;
                        msg = "组名必须填写,并且小于等于30个字符!";
                    }
                }

                //ajax send
                /*
                if(valid === true)
                {
                    var senddata = new Array();
                    senddata[senddata.length] = "group_name="+group_name;
                    $.ajax({
                        type: "POST",
                        url: "teacher_add_do",
                        data: senddata.join("&"),
                        success: function(msg){
                            //loading end
                            $btn.button('reset');
                            $.AMUI.progress.done();
                            //success
                            if(typeof(msg.error) != "undefined" && msg.error == 0)
                            {
                                if(F_status == 4)
                                {
                                    top.location.href  = manager_test_url;
                                }
                                else{
                                    top.location.href  = manager_url;
                                }
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
                */

                return false;
            });
        };

        //return obj
        var obj = {
            init:function(){privity_checked();group_select();group_back();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    privityGroupAddModule.init();
});