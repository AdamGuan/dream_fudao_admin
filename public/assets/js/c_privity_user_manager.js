$(document).ready(function(){
    //模块定义
    var privityUserManagerModule = function($){

        //批量
        var userStatusChange_mulit = function() {

            //添加权限组
            $("#group_add").click( function() {
                location.href = group_add_url;
                return false;
            });

            $("#users_active").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
                //get ids
                var id_list = new Array();
                var obj = $("input[id^='user_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                    id_list[i] = $(obj[i]).attr("F_id");
                }
                if(id_list.length > 0)
                {
                    var F_ids = id_list.join(",");

                    $.ajax({
                        type: "GET",
                        url: "user_active",
                        data: "F_ids="+F_ids,
                        success: function(msg){
                            //loading end
                            $.AMUI.progress.done();

                            msg = eval(msg);
                            if(typeof(msg.error) != "undefined" && msg.error == 0)
                            {
                                location.reload();
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
                     //show error
                    $("#my-alert-message").html("请选择操作的对象");
                    $('#my-alert').modal('open');
                }
                return false;
            });

            $("#users_delete").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
                //get ids
                var id_list = new Array();
                var obj = $("input[id^='user_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                    id_list[i] = $(obj[i]).attr("F_id");
                }
                if(id_list.length > 0)
                {
                    var F_ids = id_list.join(",");

                    $.ajax({
                        type: "GET",
                        url: "user_delete",
                        data: "F_ids="+F_ids,
                        success: function(msg){
                            //loading end
                            $.AMUI.progress.done();

                            msg = eval(msg);
                            if(typeof(msg.error) != "undefined" && msg.error == 0)
                            {
                                location.reload();
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
                     //show error
                    $("#my-alert-message").html("请选择操作的对象");
                    $('#my-alert').modal('open');
                }
                return false;
            });

            $("#users_freeze").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
                //get ids
                var id_list = new Array();
                var obj = $("input[id^='user_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                    id_list[i] = $(obj[i]).attr("F_id");
                }
                if(id_list.length > 0)
                {
                    var F_ids = id_list.join(",");

                    $.ajax({
                        type: "GET",
                        url: "user_freeze",
                        data: "F_ids="+F_ids,
                        success: function(msg){
                            //loading end
                            $.AMUI.progress.done();

                            msg = eval(msg);
                            if(typeof(msg.error) != "undefined" && msg.error == 0)
                            {
                                location.reload();
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
                     //show error
                    $("#my-alert-message").html("请选择操作的对象");
                    $('#my-alert').modal('open');
                }
                return false;
            });

        };

         //修改用户状态
        var userChange = function(){

            $("button[id^='user_active']").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();

                $.ajax({
                    type: "GET",
                    url: "user_active",
                    data: "F_ids="+$(this).attr("F_id"),
                    success: function(msg){
                        //loading end
                        $.AMUI.progress.done();

                        msg = eval(msg);
                        if(typeof(msg.error) != "undefined" && msg.error == 0)
                        {
                            location.reload();
                        }
                        else{
                             //show error
                            $("#my-alert-message").html(msg.msg);
                            $('#my-alert').modal('open');
                        }
                    }
                });
                return false;
            });

            $("button[id^='user_freezon']").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();

                $.ajax({
                    type: "GET",
                    url: "user_freeze",
                    data: "F_ids="+$(this).attr("F_id"),
                    success: function(msg){
                        //loading end
                        $.AMUI.progress.done();

                        msg = eval(msg);
                        if(typeof(msg.error) != "undefined" && msg.error == 0)
                        {
                            location.reload();
                        }
                        else{
                             //show error
                            $("#my-alert-message").html(msg.msg);
                            $('#my-alert').modal('open');
                        }
                    }
                });
                return false;
            });

            $("button[id^='user_delete']").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();

                $.ajax({
                    type: "GET",
                    url: "user_delete",
                    data: "F_ids="+$(this).attr("F_id"),
                    success: function(msg){
                        //loading end
                        $.AMUI.progress.done();

                        msg = eval(msg);
                        if(typeof(msg.error) != "undefined" && msg.error == 0)
                        {
                            location.reload();
                        }
                        else{
                             //show error
                            $("#my-alert-message").html(msg.msg);
                            $('#my-alert').modal('open');
                        }
                    }
                });
                return false;
            });

            $("button[id^='group_edit']").click( function() {
                location.href = $(this).attr("url");
                return false;
            });

        };

        //
        var user_check_all = function(){
            $("#user_check_all").click( function () {
                var num = $(this).data("num");
                if(typeof(num) == 'undefined' || num == 0)
                {
                    $("input[id^='user_check']").prop("checked",true);
                    $(this).data("num",1);
                }
                else
                {
                    $("input[id^='user_check']").prop("checked",false);
                    $(this).data("num",0);
                }
            });
        };

        //用户状态选择
        var user_status_choose = function(){
            $("#user_status_choose").change( function() {
                var url = $("#user_status_choose option:selected").attr("value");
                top.location.href = url;
            });
        };

        //用户状态选择
        var user_group_choose = function(){
            $("#user_group_choose").change( function() {
                var url = $("#user_group_choose option:selected").attr("value");
                top.location.href = url;
            });
        };

        //return obj
        var obj = {
            init:function(){userStatusChange_mulit();userChange();user_check_all();user_status_choose();user_group_choose();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    privityUserManagerModule.init();
});