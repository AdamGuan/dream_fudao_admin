$(document).ready(function(){
    //模块定义
    var privityUserManagerModule = function($){

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

        //批量
        var userStatusChange_mulit = function() {
            //添加
            $("#user_add").click( function() {
                //loading start
                loadingStart($(this));

                location.href = user_add_url;
                return false;
            });
            //激活
            $("#users_active").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);
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
                            msg = eval(msg);
                            if(typeof(msg.error) != "undefined" && msg.error == 0)
                            {
                                location.reload();
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
                    $("#my-alert-message").html("请选择操作的对象");
                    $('#my-alert').modal('open');
                }
                return false;
            });
            //删除
            $("#users_delete").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定删除?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                         //loading start
                        loadingStart($btn);
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
                                    msg = eval(msg);
                                    if(typeof(msg.error) != "undefined" && msg.error == 0)
                                    {
                                        location.reload();
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
                            $("#my-alert-message").html("请选择操作的对象");
                            $('#my-alert').modal('open');
                        }
                    },
                    onCancel: function() {
                    }
                });

                return false;
            });
            //冻结
            $("#users_freeze").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定冻结?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                         //loading start
                        loadingStart($btn);
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
                                    msg = eval(msg);
                                    if(typeof(msg.error) != "undefined" && msg.error == 0)
                                    {
                                        location.reload();
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
                            $("#my-alert-message").html("请选择操作的对象");
                            $('#my-alert').modal('open');
                        }
                    },
                    onCancel: function() {
                    }
                });

                return false;
            });

        };

         //修改用户状态
        var userChange = function(){
            //激活
            $("button[id^='user_active']").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                $.ajax({
                    type: "GET",
                    url: "user_active",
                    data: "F_ids="+$(this).attr("F_id"),
                    success: function(msg){
                        msg = eval(msg);
                        if(typeof(msg.error) != "undefined" && msg.error == 0)
                        {
                            location.reload();
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
                return false;
            });
            //冻结
            $("button[id^='user_freezon']").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定冻结?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        //loading start
                        loadingStart($btn);

                        $.ajax({
                            type: "GET",
                            url: "user_freeze",
                            data: "F_ids="+$btn.attr("F_id"),
                            success: function(msg){
                                msg = eval(msg);
                                if(typeof(msg.error) != "undefined" && msg.error == 0)
                                {
                                    location.reload();
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
                    },
                    onCancel: function() {
                    }
                });

                return false;
            });
            //删除
            $("button[id^='user_delete']").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定删除?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        //loading start
                        loadingStart($btn);

                        $.ajax({
                            type: "GET",
                            url: "user_delete",
                            data: "F_ids="+$btn.attr("F_id"),
                            success: function(msg){
                                msg = eval(msg);
                                if(typeof(msg.error) != "undefined" && msg.error == 0)
                                {
                                    location.reload();
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
                    },
                    onCancel: function() {
                    }
                });

                return false;
            });
            //编辑
            $("button[id^='user_edit']").click( function() {
                loadingStart($(this));

                location.href = $(this).attr("url");
                return false;
            });

        };

        //checkbox selecte
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
                $.AMUI.progress.start();
                var url = $("#user_status_choose option:selected").attr("value");
                top.location.href = url;
            });
        };

        //用户状态选择
        var user_group_choose = function(){
            $("#user_group_choose").change( function() {
                $.AMUI.progress.start();
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