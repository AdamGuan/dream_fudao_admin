$(document).ready(function(){
    //模块定义
    var playbackManagerModule = function($){

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

        //回放状态选择
        var playbackStatusChoose = function(){
            $("#playback_status_choose").change( function() {
                $.AMUI.progress.start();

                var url = $("#playback_status_choose option:selected").attr("value");
                top.location.href = url;
            });
        };

        //修改回放状态
        var playbackStatusChange = function(){
            //设为精彩
            $("button[id^='playback_active']").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                $.ajax({
                    type: "GET",
                    url: set_playback_active_uri,
                    data: "F_order_ids="+$(this).attr("F_order_id"),
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
            //非精彩
             $("button[id^='playback_deactive']").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);

                $.ajax({
                    type: "GET",
                    url: set_playback_deactive_uri,
                    data: "F_order_ids="+$(this).attr("F_order_id"),
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

        //checkbox
        var playback_select = function(){
            $("#playback_select").click( function () {
                var num = $(this).data("num");
                if(typeof(num) == 'undefined' || num == 0)
                {
                    $("input[id^='playback_check']").prop("checked",true);
                    $(this).data("num",1);
                }
                else
                {
                    $("input[id^='playback_check']").prop("checked",false);
                    $(this).data("num",0);
                }
            });
        };

        //批量修改老师状态
        var playbackStatusChange_mulit = function() {
            //设为精彩
            $("#playbacks_active").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);
                //get teacher ids
                var playback_id_list = new Array();
                var obj = $("input[id^='playback_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                    playback_id_list[i] = $(obj[i]).attr("F_order_id");
                }
                var playback_ids = playback_id_list.join(",");

                $.ajax({
                    type: "GET",
                    url: set_playback_active_uri,
                    data: "F_order_ids="+playback_ids,
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
            //设为非精彩
            $("#playbacks_deactive").click( function() {
                //loading start
                var $btn = $(this);
                loadingStart($btn);
                //get teacher ids
                var playback_id_list = new Array();
                var obj = $("input[id^='playback_check']:checked");
                for(var i=0;i<obj.length;++i)
                {
                    playback_id_list[i] = $(obj[i]).attr("F_order_id");
                }
                var playback_ids = playback_id_list.join(",");

                $.ajax({
                    type: "GET",
                    url: set_playback_deactive_uri,
                    data: "F_order_ids="+playback_ids,
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
        var playback_search = function(){
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
                            if(tlist[0] != "F_user_real_name" && tlist[0] != "F_teacher_real_name" && tlist[0] != "date")
                            {
                                url_parames[j] = tlist[0]+"="+tlist[1];
                                ++j;
                            }
                        }
                    }
                }

                if(url_parames.length > 0)
                {
                    if($("#search_text").val().length > 0 || $("#mydate").val().length > 0)
                    {
                        url = url_pref+"?"+url_parames.join("&")+"&";
                    }
                    else{
                        url = url_pref+"?"+url_parames.join("&");
                    }
                }
                else{
                    if($("#search_text").val().length > 0 || $("#mydate").val().length > 0)
                    {
                        url = url_pref+"?";
                    }else{
                        url = url_pref;
                    }
                }
                if($("#search_text").val().length > 0)
                {
                    url += "F_user_real_name="+$("#search_text").val()+"&";
                    url += "F_teacher_real_name="+$("#search_text").val();
                }
				if($("#mydate").val().length > 0)
                {
                    url += "date="+$("#mydate").val();
                }
                /*
                if(url_parames.length > 0)
                {
                    url = url_pref+"?"+url_parames.join("&")+"&";
                }
                else{
                    url = url_pref+"?";
                }
                if(search_type == 1)
                {
                    url += "F_user_real_name="+$("#search_text").val();
                }
                else{
                    url += "F_teacher_real_name="+$("#search_text").val();
                }
                */
                location.href= url;
                return false;
            });
        };

		var dateclick = function(){
			$('#mydate').datepicker().
			on('changeDate.datepicker.amui', function(event) {
//				var vdate = event.date.getFullYear()+"-"+eval(event.date.getMonth()+1)+"-"+event.date.getDate();
//				$("#myDate").html(vdate);
				$(this).datepicker('close');
			});
		};

        //return obj
        var obj = {
            init:function(){playbackStatusChoose();playbackStatusChange();playback_select();playbackStatusChange_mulit();playback_search();dateclick();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    playbackManagerModule.init();
});