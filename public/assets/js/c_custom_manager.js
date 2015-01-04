$(document).ready(function(){
    //模块定义
    var customManagerModule = function($){

        //客服状态选择
        var customStatusChoose = function(){
            $("#custom_status_choose").change( function() {
                var url = $("#custom_status_choose option:selected").attr("value");
                top.location.href = url;
            });
        };

        //修改客服状态
        var customStatusChange = function(){
            $("button[id^='custom_delete']").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();

                $.ajax({
                    type: "GET",
                    url: custom_delete_uri,
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

            $("button[id^='custom_freezon']").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();

                $.ajax({
                    type: "GET",
                    url: custom_freeze_uri,
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

            $("button[id^='custom_active']").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();

                $.ajax({
                    type: "GET",
                    url: custom_active_uri,
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

            $("button[id^='custom_edit']").click( function() {
                location.href = $(this).attr("url");
                return false;
            });

        };

        //
        var custom_select = function(){
            $("#custom_select").click( function () {
                var num = $(this).data("num");
                if(typeof(num) == 'undefined' || num == 0)
                {
                    $("input[id^='custom_check']").prop("checked",true);
                    $(this).data("num",1);
                }
                else
                {
                    $("input[id^='teacher_check']").prop("checked",false);
                    $(this).data("num",0);
                }
            });
        };

        //批量修改客服状态
        var customStatusChange_mulit = function() {

            $("#custom_add").click( function() {
                location.href = $(this).attr("url");
                return false;
            });

            $("#customs_delete").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
                //get custom ids
                var custom_id_list = new Array();
                var obj = $("input[id^='custom_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                    custom_id_list[i] = $(obj[i]).attr("F_teacher_id");
                }
                var custom_ids = custom_id_list.join(",");

                $.ajax({
                    type: "GET",
                    url: custom_delete_uri,
                    data: "F_teacher_ids="+custom_ids,
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

            $("#customs_freezon").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
                //get custom ids
                var custom_id_list = new Array();
                var obj = $("input[id^='teacher_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                    custom_id_list[i] = $(obj[i]).attr("F_teacher_id");
                }
                var custom_ids = custom_id_list.join(",");

                $.ajax({
                    type: "GET",
                    url: custom_freeze_uri,
                    data: "F_teacher_ids="+custom_ids,
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

            $("#customs_active").click( function() {
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
                //get teacher ids
                var custom_id_list = new Array();
                var obj = $("input[id^='teacher_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                    custom_id_list[i] = $(obj[i]).attr("F_teacher_id");
                }
                var custom_ids = custom_id_list.join(",");

                $.ajax({
                    type: "GET",
                    url: custom_active_uri,
                    data: "F_teacher_ids="+custom_ids,
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
            init:function(){customStatusChoose();customStatusChange();custom_select();customStatusChange_mulit();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    customManagerModule.init();
});