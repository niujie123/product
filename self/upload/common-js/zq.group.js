$(function() {
    // 添加
    $("#add_btn").click(function(){
        $('#group_form_add')[0].reset();
        $("#modal-add-event").modal({show:true});
    });

    $('.save_add').click(function () {
        var name = $('#group_name_add').val();
        var status = $('.status_add').val();
        var rules = new  Array();
        $('input[name="rule_add"]:checked').each(function(){
            rules.push($(this).val());
        });
        var describe = $('#describe_add').val();
        $.ajax({
            url: '/power/groupAdd',
            data: {
                name: name,
                status: status,
                rule: rules,
                describe: describe
            },
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.status == 100000) {
                    alert(data.content);
                    window.location.reload();
                }
            }
        });
    });
    // 编辑
    $('.edit_btn').click(function () {
        $('#group_form_edit')[0].reset();
        $('#modal-edit-event').modal({show:true});
        var id = $(this).attr('data-id');
        $.ajax({
            url: '/power/getGroup',
            type: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            success: function (data) {
                if (data.status == 100000) {
                    var group = data.content;
                    $('#group_name_edit').val(group.title);
                    var two = $('input[name="status_edit"][value='+group.status+']').attr('checked', true);
                    $.uniform.update(two);
                    for (var i=0;i<group.rules.length;i++) {
                        var values = group.rules[i];
                        var one = $('input[name="rule_edit"][value='+values+']').attr('checked', true);
                        $.uniform.update(one);
                    }
                    $('#describe_edit').val(data.content.describe);
                } else {
                    alert(data.content);
                }
            }
        });

    });

});