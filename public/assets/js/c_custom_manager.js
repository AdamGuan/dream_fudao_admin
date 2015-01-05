$(document).ready(function(){
    //模块定义
    var customManagerModule = function($){

        //loading start
        var loadingStart = function(obj){
            obj.button('loading');
            $.AMUI.progress.start();
        };

        //客服状态选择
        var customStatusChoose = function(){
            $("#custom_status_choose").change( function() {
                //loading start
                $.AMUI.progress.start();

                var url = $("#custom_status_choose option:selected").attr("value");
                top.location.href = url;
            });
        };

        //修改客服状态
        var customStatusChange = function(){
            //删除
            $("button[id^='custom_delete']").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定删除?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        //loading start
                        loadingStart($btn);

                        $.ajax({
                            type: "GET",
                            url: custom_delete_uri,
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
            $("button[id^='custom_freezon']").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定冻结?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        //loading start
                        loadingStart($btn);

                        $.ajax({
                            type: "GET",
                            url: custom_freeze_uri,
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
            $("button[id^='custom_active']").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定冻结?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        //loading start
                        loadingStart($btn);

                        $.ajax({
                            type: "GET",
                            url: custom_active_uri,
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
            //编辑
            $("button[id^='custom_edit']").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                location.href = $(this).attr("url");
                return false;
            });

        };

        //checkbox选择
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
                    $("input[id^='custom_check']").prop("checked",false);
                    $(this).data("num",0);
                }
            });
        };

        //批量修改客服状态
        var customStatusChange_mulit = function() {
            //添加
            $("#custom_add").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                location.href = $(this).attr("url");
                return false;
            });
            //批量删除
            $("#customs_delete").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定删除?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        //loading start
                        loadingStart($btn);
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
            //批量冻结
            $("#customs_freezon").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定冻结?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        //loading start
                        loadingStart($btn);
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
            //批量激活
            $("#customs_active").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定激活?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        //loading start
                        loadingStart($btn);
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

        };

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