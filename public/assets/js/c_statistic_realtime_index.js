$(document).ready(function(){
    //模块定义
    var statisticIndexModule = function($){

        var test = function(){

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
        var type_choose = function(){
            $("#typelist").change( function() {
                var url = $("#typelist option:selected").attr("value");
                top.location.href = url;
            });
        };

        //return obj
        var obj = {
            init:function(){test();type_choose();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    statisticIndexModule.init();
});