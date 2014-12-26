//模块定义
var teacherManagerModule = function($){

    //老师状态选择
    var teacherStatusChoose = function(){
        $("#teacher_status_choose").change( function() {
            var url = $("#teacher_status_choose option:selected").attr("value");
            top.location.href = url;
        });
    };

    //
    var teacherStatusChange = function(){
        $("button[id^='teacher_delete']").click( function() {
            //loading start
            $.ajax({
                type: "GET",
                url: change_teacher_status_uri,
                data: "F_teacher_ids="+$(this).attr("F_teacher_id")+"&F_status=2",
                success: function(msg){
                    //loading end
                    msg = eval("("+msg+")");
                    if(typeof(msg.result) != "undefined" && msg.result)
                    {
                        alert("success!");
                    }
                    else{
                        alert("fail!");
                    }
                }
            });

            //alert($(this).attr("F_teacher_id"));
        });
    };

    //return obj
    var obj = {
        init:function(){teacherStatusChoose();teacherStatusChange();}
    };

    //return
    return obj;

}(jQuery);

//模块调用
teacherManagerModule.init();