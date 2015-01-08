$(document).ready(function(){
    //模块定义
    var teacherEditModule = function($){

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

        //teacher header upload
        var uploadHeader = function(){
            $("#teacher_upload_header_submit").click(function(){
                //loading start
                 var $btn = $(this);
                loadingStart($btn);
                //set cache data
                $("#teacher_upload_header").data("uploadname","");
                $.ajaxFileUpload
                (
                    {
                        url:upload_url,
                        secureuri:false,
                        fileElementId:'user-pic',
                        dataType: 'json',
                        //data:{name:'logan', id:'id'},
                        success: function (data, status)
                        {
                            //loading end
                            loadingEnd($btn);

                            if(typeof(data.error) != 'undefined' && data.error == "0")
                            {
                                $("#teacher_upload_header").data("uploadname",data.name);
                                $("#headerImg").attr("src",data.url);
                            }
                            else{
                                //show error
                                $("#my-alert-message").html("未知错误！请重试!");
                                if(typeof(data.msg) != 'undefined' && data.msg.length > 0)
                                {
                                    $("#my-alert-message").html(data.msg);
                                }
                                $('#my-alert').modal('open');
                            }
                        },
                        error: function (data, status, e)
                        {
                            //loading end
                           loadingEnd($btn);
                            //show error
                            $("#my-alert-message").html("未知错误！请重试!");
                            $('#my-alert').modal('open');
                        }
                    }
                )

                return false;
            });
        };

        //back btn
        var teacher_back = function(){
            $("#teacher_edit_back").click(function(){
                //loading start
                 var $btn = $(this);
                loadingStart($btn);

                location.href = document.referrer;
                return false;
            });
        };

        //修改老师
        var teacher_modify = function(){
            $("#teacher_edit_submit").click(function(){
                //loading start
                 var $btn = $(this);
                loadingStart($btn);
                //验证
                var valid = true;
                var msg = "";
                //check teacher header
                var teacher_header = $("#teacher_upload_header").data("uploadname");
                if(typeof(teacher_header) != "undefined" && teacher_header.length <= 0)
                {
                    valid = false;
                    msg = "请上传头像!";
                }
                //check teacher pwd
                var F_teacher_password = $("#teacher_login_pwd").val();
                if(valid === true)
                {
                    if(typeof(F_teacher_password) != "undefined" && F_teacher_password.length != 0)
                    {
                        if(!(F_teacher_password.length >= 6 && F_teacher_password.length <= 10))
                        {
                            valid = false;
                            msg = "6-10位字母、数字以及下划线!";
                        }
                    }
                }
                //check teacher real name
                var F_real_name = $("#teacher_realname").val();
                if(valid === true)
                {
                    if(!(typeof(F_real_name) != "undefined" && F_real_name.length > 0 && F_real_name.length <= 12))
                    {
                        valid = false;
                        msg = "名字必须填写,并且小于等于12个字符!";
                    }
                }
                //check teacher gender
                var F_gender = $("#teacher_gender option:selected").val();
                if(valid === true)
                {
                    if(!(typeof(F_gender) != "undefined"))
                    {
                        valid = false;
                        msg = "请选择性别!";
                    }
                }
                //check teacher grade
                var F_grade = $("#teacher_grade option:selected").val();
                if(valid === true)
                {
                    if(!(typeof(F_grade) != "undefined"))
                    {
                        valid = false;
                        msg = "请选择年级!";
                    }
                }
                //check teacher experience
                var F_teaching_experience = $("#teacher_experience option:selected").val();
                if(valid === true)
                {
                    if(!(typeof(F_teaching_experience) != "undefined"))
                    {
                        valid = false;
                        msg = "请选择经验!";
                    }
                }
                //check teacher subject id
                var F_subject_id = $("#teacher_subject option:selected").val();
                if(valid === true)
                {
                    if(!(typeof(F_subject_id) != "undefined"))
                    {
                        valid = false;
                        msg = "请选择擅长科目!";
                    }
                }
                //check teacher subject ids
                var list = $(".teacher_subjects option:selected");
                var subjects = new Array();
                var j = 0;
                for(var i=0;i<list.length;++i)
                {
                    if($(list[i]).val() > 0)
                    {
                        subjects[j] = $(list[i]).val();
                        ++j;
                    }
                }
                var F_subject_ids = subjects.join(",");
                if(valid === true)
                {
                    if(!(typeof(F_subject_ids) != "undefined" && F_subject_ids.length > 0))
                    {
                        valid = false;
                        msg = "请选择可辅导科目!";
                    }
                }
                //check teacher type
                var F_status = $("#teacher_type option:selected").val();

                //check teacher description
                var F_description = $("#teacher_description").val();
                if(valid === true)
                {
                    if(!(typeof(F_description) != "undefined" && F_description.length > 0))
                    {
                        valid = false;
                        msg = "请填写简介!";
                    }
                }
                //ajax send
                if(valid === true)
                {
                    var senddata = new Array();
                    if(F_teacher_password.length > 0)
                    {
                        senddata[senddata.length] = "F_teacher_password="+F_teacher_password;
                    }
                    senddata[senddata.length] = "F_real_name="+F_real_name;
                    senddata[senddata.length] = "F_gender="+F_gender;
                    senddata[senddata.length] = "F_grade="+F_grade;
                    senddata[senddata.length] = "F_teaching_experience="+F_teaching_experience;
                    senddata[senddata.length] = "F_subject_id="+F_subject_id;
                    senddata[senddata.length] = "F_subject_ids="+F_subject_ids;
                    if(typeof(F_status) != "undefined")
                    {
                        senddata[senddata.length] = "F_status="+F_status;
                    }
                    senddata[senddata.length] = "F_description="+F_description;
                    if(typeof(teacher_header) != "undefined")
                    {
                        senddata[senddata.length] = "teacher_header="+teacher_header;
                    }
                    senddata[senddata.length] = "F_teacher_id="+F_teacher_id;
                    $.ajax({
                        type: "POST",
                        url: teacher_modify_url,
                        data: senddata.join("&"),
                        success: function(msg){
                            //success
                            if(typeof(msg.error) != "undefined" && msg.error == 0)
                            {
                                location.href = document.referrer;
                            }
                            else{
                                 //loading end
                                loadingEnd($btn);
                                //show error
                                $("#my-alert-message").html(msg.msg);
                                $('#my-alert').modal('open');
                            }
                        }
                    });
                }
                else{
                    //loading end
                    loadingEnd($btn);
                    //show error
                    $("#my-alert-message").html(msg);
                    $('#my-alert').modal('open');
                }

                return false;
            });
        };

        //return obj
        var obj = {
            init:function(){uploadHeader();teacher_modify();teacher_back();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    teacherEditModule.init();

});