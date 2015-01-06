$(document).ready(function(){
    //模块定义
    var statisticTimesectionIndexModule = function($){

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

        //设置图表
        var setchars = function(){

            $('#chars').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: categories
                },
                yAxis: {
                    title: {
                        text: charDesc
                    }
                },
                series: [{
                    name: '数量',
                    data: data
                }]
            });

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
            $('#datepicker0').datepicker({format: 'yyyy-mm-dd', viewMode: 'days', minViewMode: 'days'});
            $('#datepicker1').datepicker({format: 'yyyy-mm', viewMode: 'months', minViewMode: 'months'});
            $('#datepicker2').datepicker({format: 'yyyy/', viewMode: 'years', minViewMode: 'years'});
            $('#datepicker'+datetype).show();
        };

        //search
        var search = function(){
            $("#search").click(function(){
                 //loading start
                var $btn = $(this);
                loadingStart($btn);

                var url = location.href;
                var type0 = $("#datetypelist option:selected").attr("value");
                var type1 = $("#typelist option:selected").attr("value");
                var date = $("#date"+type0).val();
                date = date.replace("/","");
                var list = url.split("?");
                var url_pre = list[0];
                url = url_pre+"?type="+type1+"&datetype="+type0+"&date="+date;
                location.href = url;

                return false;
            });
        };

        //return obj
        var obj = {
            init:function(){setdatepicker();setchars();datetype_choose();search();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    statisticTimesectionIndexModule.init();
});