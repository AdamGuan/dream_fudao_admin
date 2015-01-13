$(document).ready(function(){
    //模块定义
    var exceptionManagerModule = function($){

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
                            if(tlist[0] != "F_user_real_name" && tlist[0] != "F_teacher_real_name")
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
                    url += "F_user_real_name="+$("#search_text").val()+"&";
                    url += "F_teacher_real_name="+$("#search_text").val();
                }

                location.href= url;
                return false;
            });
        };

        //return obj
        var obj = {
            init:function(){playback_search();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    exceptionManagerModule.init();
});