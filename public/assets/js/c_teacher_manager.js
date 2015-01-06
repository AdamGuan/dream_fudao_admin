$(document).ready(function(){
    //模块定义
    var teacherManagerModule = function($){

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

        //老师状态选择
        var teacherStatusChoose = function(){
            $("#teacher_status_choose").change( function() {
                $.AMUI.progress.start();

                var url = $("#teacher_status_choose option:selected").attr("value");
                top.location.href = url;
            });
        };

        //修改老师状态
        var teacherStatusChange = function(){
            //删除
            $("button[id^='teacher_delete']").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定删除?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                         //loading start
                        loadingStart($btn);

                        $.ajax({
                            type: "GET",
                            url: teacher_delete_uri,
                            data: "F_teacher_ids="+$btn.attr("F_teacher_id"),
                            success: function(msg){
                                msg = eval(msg);
                                if(typeof(msg.result) != "undefined" && msg.result)
                                {
                                    location.reload();
                                }
                                else{
                                    location.reload();
                                }
                            }
                        });
                    },
                    onCancel: function() {
                    }
                });

                return false;
            });

            //冻结
            $("button[id^='teacher_freezon']").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定冻结?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                         //loading start
                        loadingStart($btn);

                        $.ajax({
                            type: "GET",
                            url: teacher_freeze_uri,
                            data: "F_teacher_ids="+$btn.attr("F_teacher_id"),
                            success: function(msg){
                                msg = eval(msg);
                                if(typeof(msg.result) != "undefined" && msg.result)
                                {
                                    location.reload();
                                }
                                else{
                                    location.reload();
                                }
                            }
                        });
                    },
                    onCancel: function() {
                    }
                });
                return false;
            });

            //激活
            $("button[id^='teacher_active']").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                $.ajax({
                    type: "GET",
                    url: teacher_active_uri,
                    data: "F_teacher_ids="+$btn.attr("F_teacher_id"),
                    success: function(msg){
                        //loading end
                        $.AMUI.progress.done();

                        msg = eval(msg);
                        if(typeof(msg.result) != "undefined" && msg.result)
                        {
                            location.reload();
                        }
                        else{
                            location.reload();
                        }
                    }
                });
                return false;
            });

            //设为测试帐号
            $("button[id^='teacher_test']").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                $.ajax({
                    type: "GET",
                    url: teacher_set_test_uri,
                    data: "F_teacher_ids="+$btn.attr("F_teacher_id"),
                    success: function(msg){
                        //loading end
                        $.AMUI.progress.done();

                        msg = eval(msg);
                        if(typeof(msg.result) != "undefined" && msg.result)
                        {
                            location.reload();
                        }
                        else{
                            location.reload();
                        }
                    }
                });
                return false;
            });

            //编辑
            $("button[id^='teacher_edit']").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                location.href = $btn.attr("url");
                return false;
            });

        };

        //checkbox选择
        var teacher_select = function(){
            $("#teacher_select").click( function () {
                var num = $(this).data("num");
                if(typeof(num) == 'undefined' || num == 0)
                {
                    $("input[id^='teacher_check']").prop("checked",true);
                    $(this).data("num",1);
                }
                else
                {
                    $("input[id^='teacher_check']").prop("checked",false);
                    $(this).data("num",0);
                }
            });
        };

        //批量修改老师状态
        var teacherStatusChange_mulit = function() {
            //添加
            $("#teacher_add").click( function() {
                location.href = $(this).attr("url");
                return false;
            });
            //删除
            $("#teachers_delete").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定删除?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                         //loading start
                        loadingStart($btn);
                        //get teacher ids
                        var teacher_id_list = new Array();
                        var obj = $("input[id^='teacher_check']:checked");
                        for(var i=0;i<obj.length;++i)
                        {
                            teacher_id_list[i] = $(obj[i]).attr("F_teacher_id");
                        }
                        var teacher_ids = teacher_id_list.join(",");

                        $.ajax({
                            type: "GET",
                            url: teacher_delete_uri,
                            data: "F_teacher_ids="+teacher_ids,
                            success: function(msg){
                                msg = eval(msg);
                                if(typeof(msg.result) != "undefined" && msg.result)
                                {
                                    location.reload();
                                }
                                else{
                                    location.reload();
                                }
                            }
                        });
                    },
                    onCancel: function() {
                    }
                });
                return false;
            });
            //冻结
            $("#teachers_freezon").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定删除?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                         //loading start
                        loadingStart($btn);
                        //get teacher ids
                        var teacher_id_list = new Array();
                        var obj = $("input[id^='teacher_check']:checked");
                        for(var i=0;i<obj.length;++i)
                        {
                            teacher_id_list[i] = $(obj[i]).attr("F_teacher_id");
                        }
                        var teacher_ids = teacher_id_list.join(",");

                        $.ajax({
                            type: "GET",
                            url: teacher_freeze_uri,
                            data: "F_teacher_ids="+teacher_ids,
                            success: function(msg){
                                msg = eval(msg);
                                if(typeof(msg.result) != "undefined" && msg.result)
                                {
                                    location.reload();
                                }
                                else{
                                    location.reload();
                                }
                            }
                        });
                    },
                    onCancel: function() {
                    }
                });
                return false;
            });
            //激活
            $("#teachers_active").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);
                //get teacher ids
                var teacher_id_list = new Array();
                var obj = $("input[id^='teacher_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                    teacher_id_list[i] = $(obj[i]).attr("F_teacher_id");
                }
                var teacher_ids = teacher_id_list.join(",");

                $.ajax({
                    type: "GET",
                    url: teacher_active_uri,
                    data: "F_teacher_ids="+teacher_ids,
                    success: function(msg){
                        msg = eval(msg);
                        if(typeof(msg.result) != "undefined" && msg.result)
                        {
                            location.reload();
                        }
                        else{
                            location.reload();
                        }
                    }
                });

                return false;
            });
            //设为测试帐号
            $("#teachers_test").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);
                //get teacher ids
                var teacher_id_list = new Array();
                var obj = $("input[id^='teacher_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                    teacher_id_list[i] = $(obj[i]).attr("F_teacher_id");
                }
                var teacher_ids = teacher_id_list.join(",");

                $.ajax({
                    type: "GET",
                    url: teacher_set_test_uri,
                    data: "F_teacher_ids="+teacher_ids,
                    success: function(msg){
                        msg = eval(msg);
                        if(typeof(msg.result) != "undefined" && msg.result)
                        {
                            location.reload();
                        }
                        else{
                            location.reload();
                        }
                    }
                });

                return false;
            });


        }

        //return obj
        var obj = {
            init:function(){teacherStatusChoose();teacherStatusChange();teacher_select();teacherStatusChange_mulit();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    teacherManagerModule.init();
});