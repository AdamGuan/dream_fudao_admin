$(document).ready(function(){
    //模块定义
    var studentManagerModule = function($){

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

        //学生状态选择
        var studentStatusChoose = function(){
            $("#student_status_choose").change( function() {
                $.AMUI.progress.start();

                var url = $("#student_status_choose option:selected").attr("value");
                top.location.href = url;
            });
        };

		//学生年级选择
        var studentGradeChoose = function(){
            $("#student_grade_choose").change( function() {
                $.AMUI.progress.start();

                var url = $("#student_grade_choose option:selected").attr("value");
                top.location.href = url;
            });
        };

		//学生是否在线选择
        var studentLoginChoose = function(){
            $("#student_login_choose").change( function() {
                $.AMUI.progress.start();

                var url = $("#student_login_choose option:selected").attr("value");
                top.location.href = url;
            });
        };

        //checkbox选择
        var student_select = function(){
            $("#student_select").click( function () {
                var num = $(this).data("num");
                if(typeof(num) == 'undefined' || num == 0)
                {
                    $("input[id^='student_check']").prop("checked",true);
                    $(this).data("num",1);
                }
                else
                {
                    $("input[id^='student_check']").prop("checked",false);
                    $(this).data("num",0);
                }
            });
        };

        //修改学生状态
        var studentStatusChange = function(){
            //删除
            $("button[id^='student_delete']").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定删除?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                         //loading start
                        loadingStart($btn);

                        $.ajax({
                            type: "GET",
                            url: student_delete_uri,
                            data: "F_user_ids="+$btn.attr("F_user_id"),
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
            $("button[id^='student_freezon']").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定冻结?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                         //loading start
                        loadingStart($btn);

                        $.ajax({
                            type: "GET",
                            url: student_freeze_uri,
                            data: "F_user_ids="+$btn.attr("F_user_id"),
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
            $("button[id^='student_active']").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                $.ajax({
                    type: "GET",
                    url: student_active_uri,
                    data: "F_user_ids="+$btn.attr("F_user_id"),
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
            $("button[id^='student_test']").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                $.ajax({
                    type: "GET",
                    url: student_set_test_uri,
                    data: "F_user_ids="+$btn.attr("F_user_id"),
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

        //批量修改学生状态
        var studentStatusChange_mulit = function() {
            //删除
            $("#students_delete").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定删除?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                         //loading start
                        loadingStart($btn);
                        //get student ids
                        var student_id_list = new Array();
                        var obj = $("input[id^='student_check']:checked");
                        for(var i=0;i<obj.length;++i)
                        {
                            student_id_list[i] = $(obj[i]).attr("F_user_id");
                        }
                        var F_user_ids = student_id_list.join(",");

                        $.ajax({
                            type: "GET",
                            url: student_delete_uri,
                            data: "F_user_ids="+F_user_ids,
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
            $("#students_freezon").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定删除?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                         //loading start
                        loadingStart($btn);
                        //get student ids
                        var student_id_list = new Array();
                        var obj = $("input[id^='student_check']:checked");
                        for(var i=0;i<obj.length;++i)
                        {
                            student_id_list[i] = $(obj[i]).attr("F_user_id");
                        }
                        var F_user_ids = student_id_list.join(",");

                        $.ajax({
                            type: "GET",
                            url: student_freeze_uri,
                            data: "F_user_ids="+F_user_ids,
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
            $("#students_active").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);
                //get student ids
                var student_id_list = new Array();
                var obj = $("input[id^='student_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                    student_id_list[i] = $(obj[i]).attr("F_user_id");
                }
                var F_user_ids = student_id_list.join(",");

                $.ajax({
                    type: "GET",
                    url: student_active_uri,
                    data: "F_user_ids="+F_user_ids,
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
            $("#students_test").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);
                //get student ids
                var student_id_list = new Array();
                var obj = $("input[id^='student_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                   student_id_list[i] = $(obj[i]).attr("F_user_id");
                }
                var F_user_ids = student_id_list.join(",");

                $.ajax({
                    type: "GET",
                    url: student_set_test_uri,
                    data: "F_user_ids="+F_user_ids,
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


        };


        //search
        var search = function(){
            $("#search_btn_search").click(function(){
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                //var search_type = $("#search_type_choose option:selected").attr("value");
                var url = location.href;
                var list = url.split("?");
                var url_pref = list[0];
                var url_parames = new Array();
                if(list.length == 1)
                {
                }
                else if(list.length == 2)
                {

                    if(list[1].length > 0)
                    {
                        var tmp_list = list[1].split("&");
                        var j = 0;
                        for(var i=0;i<tmp_list.length;++i)
                        {
                            var tlist = tmp_list[i].split("=");
                            if(tlist[0] != "F_real_name" && tlist[0] != "F_user_name")
                            {
                                url_parames[j] = tlist[0]+"="+tlist[1];
                                ++j;
                            }
                        }
                    }
                }

                if(url_parames.length > 0)
                {
                    if($("#search_text").val().length > 0)
                    {
                        url = url_pref+"?"+url_parames.join("&")+"&";
                    }
                    else{
                        url = url_pref+"?"+url_parames.join("&");
                    }
                }
                else{
                    if($("#search_text").val().length > 0)
                    {
                        url = url_pref+"?";
                    }else{
                        url = url_pref;
                    }
                }
                if($("#search_text").val().length > 0)
                {
                    url += "F_real_name="+$("#search_text").val()+"&";
                    url += "F_user_name="+$("#search_text").val();
                }
                /*
                if(search_type == 1)
                {
                    url += "F_real_name="+$("#search_text").val();
                }
                else{
                    url += "F_user_name="+$("#search_text").val();
                }
                */
                location.href= url;
                return false;
            });
        };

        //return obj
        var obj = {
            init:function(){studentStatusChoose();studentGradeChoose();studentLoginChoose();student_select();studentStatusChange();studentStatusChange_mulit();search();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    studentManagerModule.init();

});