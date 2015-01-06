$(document).ready(function(){
    //模块定义
    var privityGroupModifyModule = function($){

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

        //back btn
        var group_back = function(){
            $("#group_modify_back").click(function(){
                loadingStart($(this));

                location.href= document.referrer;
                return false;
            });
        };

        //修改
        var group_modify = function(){
            $("#group_modify_submit").click(function(){
                //loading start
                var $btn = $(this);
                loadingStart($btn);
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

                if(valid === true)
                {
                    //获取选择的权限值
                    var checked_value_list = new Array();
                    var checkedlist = $("input:checked[id^='privity_check_']");
                    if(checkedlist.length > 0)
                    {
                        var j = 0;
                        for(var i=0;i<checkedlist.length;++i)
                        {
                            if($(checkedlist[i]).val().length > 0)
                            {
                                checked_value_list[j] = $(checkedlist[i]).val();
                                ++j;
                            }
                        }
                    }
                    var privity = checked_value_list.join(",");
                    //获取
                    var childcould = $("#child option:selected").val();

                    var senddata = new Array();
                    senddata[senddata.length] = "F_name="+group_name;
                    senddata[senddata.length] = "F_privity="+privity;
                    if(typeof(childcould) != "undefined"){
                        senddata[senddata.length] = "F_could_has_child="+childcould;
                    }
                    senddata[senddata.length] = "F_id="+group_id;
                    $.ajax({
                        type: "POST",
                        url: "group_modify_do",
                        data: senddata.join("&"),
                        success: function(msg){
                            //success
                            if(typeof(msg.error) != "undefined" && msg.error == 0)
                            {
                                location.href= document.referrer;
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
            init:function(){privity_checked();group_back();group_modify();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    privityGroupModifyModule.init();
});