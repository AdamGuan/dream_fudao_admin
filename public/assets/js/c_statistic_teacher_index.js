$(document).ready(function(){
    //模块定义
    var statisticTeacherModule = function($){

        //类型选择
        var datetype_choose = function(){
            $("#datetypelist").change( function() {
                var v = $("#datetypelist option:selected").attr("value");
                $("div[id^='datepicker']").hide();
                $('#datepicker'+v).show();
            });
        };

        //
        var  setdatepicker = function(){
            $('#datepicker0').datepicker({format: 'yyyy-mm-dd', viewMode: 'days', minViewMode: 'days'});
            $('#datepicker1').datepicker({format: 'yyyy-mm', viewMode: 'months', minViewMode: 'months'});
            $('#datepicker2').datepicker({format: 'yyyy/', viewMode: 'years', minViewMode: 'years'});
            $('#datepicker'+datetype).show();
        };

        //
        var search = function(){
            $("#search").click(function(){
                 //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();

                var url = location.href;
                var type0 = $("#datetypelist option:selected").attr("value");
                var date = $("#date"+type0).val();
                date = date.replace("/","");
                var list = url.split("?");
                var url_pre = list[0];
                url = url_pre+"?datetype="+type0+"&date="+date;
                console.log(url);
                location.href = url;

                return false;
            });
        };

        //return obj
        var obj = {
            init:function(){setdatepicker();datetype_choose();search();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    statisticTeacherModule.init();
});