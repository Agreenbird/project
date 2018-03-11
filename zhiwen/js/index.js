;
$(function () {
    $('#search_button').button({
        icons: {
            primary: 'ui-icon-search',
        },
        label: '查询'
    });
    $('#question_button').button({
        icons: {
            primary: 'ui-icon-lightbulb',
        },
        label: '提问'
    }).click(function(){
        $('#question').dialog('open');
    });
    $('#error').dialog({
        autoOpen:false,
        modal:true,
        closeOnEscape:false,
        resizable:false,
        draggable:false,
        width:180,
        height:80,
    }).parent().find('.ui-widget-header').hide();

    //接受数据
    $.ajax({
        url:'show_content.php',
        type:'POST',
        success:function(response,status,xhr){
            var json = $.parseJSON(response);
            var html = '';

            $.each(json,function(index,value){
                html += '<h4>' + value.user + '发表于' + value.date + '<h4><h3>' + json[i].title + '<h3><div class="editor">' + json[i].content + '<div><div class="bottom"><span class="commit">0条评论</span><span class="down">显示全部</span><span class="up">收起</span><div><hr noshade="noshade" size="1"/><div class="comment_list><dl class="comment_content"><dt></dt><dd></dd></dl></div>';
        

            });
            $('.content').append(html);

            $.each($('.editor'),function(index,value){
                arr[index] = $(value).height();
                if($(value).height()>200){
                    $(value).next('.bottom').find('.up').hide();
                }
                $(value).height(155);
            });
            $.each($('.bottom.down'),function(index,value){
                $(this).click(function(){
                    $(this).parent().prev().height(arr[index]);
                    $(this).hide();
                    $(this).parent().find('.up').show();
                });
            });
            $.each($('.bottom.up'),function(index,value){
                $(this).click(function(){
                    $(this).parent().prev().height(155);
                    $(this).hide();
                    $(this).parent().find('.down').show();
                })
            })

        },
    });

    $('#question').dialog({
        buttons: {
            '发布': function () {
                $(this).ajaxSubmit({
                    url:'add_content.php',
                    type:POST,
                    data:{
                        user:$.cookie('user'),
                        content:$('.uEditorIframe').contents().find('#iframeBody').html(),
                    },
                    beforeSubmit: function () {
                        $('#loading').dialog('open');
                        $('#question').dialog('widget').find('button').eq(1).button('disable');
                    },
                    success: function (responseText, statusText) {
                        if (responseText) {
                            $('#question').dialog('widget').find('button').eq(1).button('enable');
                            setTimeout(function () {
                                $('#loading').dialog('close');
                                $('#question').dialog('close');
                                $('#questin').resetForm();
                                $('#question span stat').html('*').removeClass('successs');
                            }, 1000);
                        }
                    }
                });
            },
            '取消': function () {
                $(this).dialog('close');
            }
        },
        width: 500,
        height: 360,
        show: 'puff',
        hide: 'puff',
        draggable: false,
        resizable: false,
        modal: true,
        autoOpen: false,
    }).parent().find('.ui-widget-header').hide();

    // 注册面板
    $('#reg_a').click(function () {
        $('#reg').dialog('open');
    });

    $('#reg').dialog({
        buttons: {
            '提交': function () {
                $(this).submit();
            },
            '取消': function () {
                $(this).dialog('close');
            }
        },
        width: 400,
        height: 400,
        show: 'puff',
        hide: 'puff',
        draggable: false,
        resizable: false,
        modal: true,
        autoOpen: false,
    }).buttonset().validate({
        errorLabelContainer: 'ol.reg_error',
        wrapper: 'li',
        submitHandler: function (form) {
            $(form).ajaxSubmit({
                url: 'add.php',
                type: 'POST',
                beforeSubmit: function () {
                    // $('#loading').dialog('open');
                    $('#reg').dialog('widget').find('button').eq(1).button('disable');
                },
                success: function (responseText, statusText) {
                    if (responseText) {
                        $('#reg').dialog('widget').find('button').eq(1).button('enable');
                        setTimeout(function () {
                            $('#loading').dialog('close');
                            $('#reg').dialog('close');
                            $('#reg').resetForm();
                            $('#reg span stat').html('*').removeClass('successs');
                        }, 1000);
                    }
                }
            })
        },
        rules: {
            user: {
                required: true,
                minlength: 6,
            },
            pass: {
                required: true,
                minlength: 6,
            },
            email: {
                required: true,
                minlength: 6,
            }


        },
        messages: {
            user: {
                required: '账号不得为空',
                minlength: '账号不得小于6位',
            },
            pass: {
                required: '密码不得为空',
                minlength: '密码不得小于6位',
            },
            email: {
                required: '邮箱不得为空',
                minlength: '请输入正确的邮箱',
            }
        }
    });
    $('#date').datepicker();
    $('#reg input[title]').tooltip({
        position: {
            my: 'left bottom',
            at: 'right+5 center',
        }
    });
    // $('#email').autocomplete({
    //     source: function(request,response){
    //         var hosts = ['qq.com','163.com','gmail.com','hotmail.com'],
    //         term = requset.term,
    //         ix = term.indexOf('@a'),
    //         name = term,
    //         host = '',
    //         result = [],    
    //         // 当有@时，重新分配用户名
    //         if (ix > -1) {
    //             name = term.slice(0, ix);
    //             host =term.slice(ix + 1);
    //         }
    //         if (name) {
    //             var findeHosts = [];
    //             if(host){
    //                 $.grep(hosts,function(value,index){
    //                     return value.indexOf(host) > -1;
    //                 });
    //             }else{
    //                 findeHosts = hosts;
    //             }
    //             var findeResult = $.map(findeHosts, function(value,index){
    //                  name + '@' + value;
    //             });
    //             result = findeHosts;
    //         }
    //         response(result);
    //     },
    //     autoFocus:true,
    //     minLength:2,
    // });

    /*登录表单*/
    
    $('#loading').dialog({
        modal: false,
        autoOpen: false,
        closeOnEscape: false,
        resizable: false,
        draggable: false,
        widht: 180,
        height: 50,

    }).parent().find('.ui-widget-header').hide();

    // 选项卡
    $('#tabs').tabs();
    $('#accordion').accordion();
    //编辑器
    var editor = new Simditor({textarea: $('#question_content') });
});