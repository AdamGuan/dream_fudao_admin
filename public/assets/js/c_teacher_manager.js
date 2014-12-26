$(document).ready(function(){
    //模块定义
    var teacherManagerModule = function($){

        //老师状态选择
        var teacherStatusChoose = function(){
            $("#teacher_status_choose").change( function() {
                var url = $("#teacher_status_choose option:selected").attr("value");
                console.log("location");
                top.location.href = url;
            });
        };

        //修改老师状态
        var teacherStatusChange = function(){
            $("button[id^='teacher_delete']").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();

                $.ajax({
                    type: "GET",
                    url: teacher_delete_uri,
                    data: "F_teacher_ids="+$(this).attr("F_teacher_id"),
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

            $("button[id^='teacher_freezon']").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();

                $.ajax({
                    type: "GET",
                    url: teacher_freeze_uri,
                    data: "F_teacher_ids="+$(this).attr("F_teacher_id"),
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

            $("button[id^='teacher_active']").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();

                $.ajax({
                    type: "GET",
                    url: teacher_active_uri,
                    data: "F_teacher_ids="+$(this).attr("F_teacher_id"),
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

            $("button[id^='teacher_test']").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();

                $.ajax({
                    type: "GET",
                    url: teacher_set_test_uri,
                    data: "F_teacher_ids="+$(this).attr("F_teacher_id"),
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
        };

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

            $("#teachers_delete").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
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

            $("#teachers_freezon").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
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

            $("#teachers_active").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
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

            $("#teachers_test").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
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