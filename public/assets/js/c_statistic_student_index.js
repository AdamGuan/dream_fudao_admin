$(document).ready(function(){
    //模块定义
    var statisticStudentModule = function($){

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

        //类型选择
        var datetype_choose = function(){
            $("#datetypelist").change( function() {
                var v = $("#datetypelist option:selected").attr("value");
                $("div[id^='datepicker']").hide();
                $('#datepicker'+v).show();
            });
        };

        //设置日期控件
        var  setdatepicker = function(){
            $('#datepicker1').datepicker({format: 'yyyy-mm', viewMode: 'months', minViewMode: 'months'});
            $('#datepicker2').datepicker({format: 'yyyy/', viewMode: 'years', minViewMode: 'years'});
            $('#datepicker'+datetype).show();
            $('#datepicker'+datetype).datepicker('setValue', $('#date'+datetype).val());
            $('div[id^="datepicker"]').datepicker().
                on('changeDate.datepicker.amui', function(event) {
                    $(this).datepicker('close');
                }
            );
        };

        //search
        var search = function(){
            $("#search").click(function(){
                 //loading start
                var $btn = $(this);
                loadingStart($btn);

                //var url = location.href;
                var type0 = $("#datetypelist option:selected").attr("value");
                var date = $("#date"+type0).val();
                date = date.replace("/","");
                //var list = url.split("?");
                //var url_pre = list[0];
                url = currentPageBaseUrl+"&datetype="+type0+"&date="+date;
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
    statisticStudentModule.init();
});