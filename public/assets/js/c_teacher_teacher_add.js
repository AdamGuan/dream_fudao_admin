$(document).ready(function(){
    //模块定义
    var teacherAddModule = function($){

        //teacher header upload
        var uploadHeader = function(){
            $("#teacher_upload_header_submit").click(function(){
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
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
                            $btn.button('reset');
                            $.AMUI.progress.done();

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
                            $btn.button('reset');
                            $.AMUI.progress.done();
                            //show error
                            $("#my-alert-message").html("未知错误！请重试!");
                            $('#my-alert').modal('open');
                        }
                    }
                )

                return false;
            });
        };

        var teacher_back = function(){
            $("#teacher_add_back").click(function(){
                top.location.href  = refrence;
            });
        };

        var teacher_add = function(){
            $("#teacher_add_submit").click(function(){
                //loading start
                var $btn = $(this);
                $btn.button('loading');
                $.AMUI.progress.start();
                //验证
                var valid = true;
                var msg = "";
                //check teacher header
                var teacher_header = $("#teacher_upload_header").data("uploadname");
                if(typeof(teacher_header) == "undefined" || teacher_header.length <= 0)
                {
                    valid = false;
                    msg = "请上传头像!";
                }
                //check teacher login name
                var F_teacher_name = $("#teacher_login_name").val();
                if(valid === true)
                {
                    if(!(typeof(F_teacher_name) != "undefined" && F_teacher_name.length > 0 && F_teacher_name.length <= 30))
                    {
                        valid = false;
                        msg = "帐号必须填写,并且小于等于30个字符!";
                    }
                }
                //check teacher pwd
                var F_teacher_password = $("#teacher_login_pwd").val();
                if(valid === true)
                {
                    if(!(typeof(F_teacher_password) != "undefined" && F_teacher_password.length >= 6 && F_teacher_password.length <= 9))
                    {
                        valid = false;
                        msg = "密码必须填写,并且大于等于6个字符小于等于9个字符!";
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
                    senddata[senddata.length] = "F_teacher_name="+F_teacher_name;
                    senddata[senddata.length] = "F_teacher_password="+F_teacher_password;
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
                    senddata[senddata.length] = "teacher_header="+teacher_header;
                    $.ajax({
                        type: "POST",
                        url: "teacher_add_do",
                        data: senddata.join("&"),
                        success: function(msg){
                            //loading end
                            $btn.button('reset');
                            $.AMUI.progress.done();
                            //success
                            if(typeof(msg.error) != "undefined" && msg.error == 0)
                            {
                                if(F_status == 4)
                                {
                                    top.location.href  = manager_test_url;
                                }
                                else{
                                    top.location.href  = manager_url;
                                }
                            }
                            else{
                                //show error
                                $("#my-alert-message").html(msg.msg);
                                $('#my-alert').modal('open');
                            }
                        }
                    });
                }
                else{
                    //loading end
                    $btn.button('reset');
                    $.AMUI.progress.done();
                    //show error
                    $("#my-alert-message").html(msg);
                    $('#my-alert').modal('open');
                }

                return false;
            });
        };

        //return obj
        var obj = {
            init:function(){uploadHeader();teacher_add();teacher_back();}
        };

        //return
        return obj;

    }(jQuery);

    //模块调用
    teacherAddModule.init();

});