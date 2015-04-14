$(document).ready(function(){
    //模块定义
    var statisticTeachingModule = function($){

        //日期选择
        var  dateClick = function(){
			$('#date').datepicker().on('changeDate.datepicker.amui', function(event) {
				var date = event.date.getFullYear()+"-"+eval(event.date.getMonth()+1)+"-"+event.date.getDate();
				console.log(date);
				$(this).datepicker('close');
				//跳转
				url = currentPageUrl+"&date="+date;
				location.href= url;
                return false;
			});

        };

        //return obj
        var obj = {
            init:function(){dateClick();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    statisticTeachingModule.init();
});