$(document).ready(function(){
    //模块定义
    var publishManagerModule = function($){

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
        var publishAction = function(){
            //添加
            $("#publish_add").click( function() {
                location.href = $(this).attr("url");
                return false;
            });

            //删除
            $("button[id^='publish_delete']").click( function() {
                var $btn = $(this);
                $("#my-confirm-msg").html("确定删除?");
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                         //loading start
                        loadingStart($btn);

                        $.ajax({
                            type: "GET",
                            url: delete_url,
                            data: "F_ids="+$btn.attr("F_id"),
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
            $("button[id^='publish_edit']").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                location.href = $btn.attr("url");
                return false;
            });
        };

        //return obj
        var obj = {
            init:function(){publishAction();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    publishManagerModule.init();
});