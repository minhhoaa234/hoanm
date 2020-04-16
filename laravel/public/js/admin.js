function checkAllMenu(id) {
    if($('.menu-'+id).is(":checked")){
        $('.child-menu-'+id).prop('checked', true);
        $('.grandchild-menu-'+id).prop('checked', true);
    }else{
        $('.child-menu-'+id).prop('checked', false);
        $('.grandchild-menu-'+id).prop('checked', false);
    }
}
function checkAllChildMenu(id) {
    if($('.father-menu-'+id).is(":checked")){
        $('.child-menu-item-'+id).prop('checked', true);
    }else{
        $('.child-menu-item-'+id).prop('checked', false);
    }
}
$('#save-group').click(function (e) {
    e.preventDefault();
    $.ajax({
        url: 'user-groups/'+$('input[name="id"]').val(),
        type: 'post',
        data: $('#form-user-group').serializeArray(),
        success: function (data) {
            // console.log(data);
            $('#new-user-group').modal('hide');
            window.location.reload();
        },

        error: function(xhr,status,error){
            console.log(error);
        }
    });
});
$('.update-user-group').click(function () {
    var groupId = $(this).attr('group-id');
    $('.modal-title').html('Edit Record');
    $('input[name="id"]').val(groupId);
    $('#new-user-group input[type="checkbox"]').prop('checked', false);

    $.ajax({
        url: '/admin/user-groups/'+groupId,
        success: function (data) {
            // console.log(data);
            $('input[name="Name"]').val(data[0]);
            $('input[name="Manager"]').prop('checked', data[2]);
            data = data[1];
            for (key in data) {
                if (data.hasOwnProperty(key)  &&
                    /^0$|^[1-9]\d*$/.test(key) &&
                    key <= 4294967294
                ) {
                    for(key2 in data[key]){
                        if (data[key].hasOwnProperty(key2)  &&
                            /^0$|^[1-9]\d*$/.test(key2) &&
                            key2 <= 4294967294
                        ){
                            // console.log('input[name="menu['+key+']['+key2+']"');
                            if ($('input[name="menu['+key+']['+key2+']"').length){
                                $('input[name="menu['+key+']['+key2+']"').prop('checked', true);
                            }
                        }
                    }
                }
            }
        },
        fail: function(xhr,status,error){
            console.log(error);
        }
    })
});
$('#add-new-group-btn').click(function () {
    $('input[name="Name"]').val('');
    $('#new-user-group input[type="checkbox"]').prop('checked', false);
    $('.modal-title').html('Add Record');
    $('input[name="id"]').val('');
});
$('.delete-user-group').click(function () {
    var groupId = $(this).attr('group-id');
    t = confirm('Delete entry?');
    if(t){
        $.ajax({
            url: 'user-groups/'+groupId+'/del',
            // type: 'post',
            success: function (data) {
                // console.log(data);
                window.location.reload();
            },
            fail: function(xhr,status,error){
                console.log(error);
            }
        })
    }else{

    }

});

$(".update-user").click(function () {
    // $('#user-form')[0].reset();
    $('.loadajax').show();
    var userId = $(this).attr('user-id');
    // $('#user-info').modal('show');
    $.ajax({
        url: ajaxUrl+'/'+userId,
        success: function (data) {
            // $('#user-form')[0].reset();
            $('#popupModal').empty().html(data);
            $('.modal-title').html('Chi tiết thành viên');
            // $('#user-form')[0].reset();
            $('#user-info').modal('show');
            $('.loadajax').hide();
        }
    });
});

// $("#add-new-user-btn").click(function () {
//     // $('#user-form')[0].reset();
//     $.ajax({
//         url: ajaxUrl+'/',
//         success: function (data) {

//             $('#popupModal').empty().html(data);
//             $('.modal-title').html('Thêm thành viên');
//             // $('#user-form')[0].reset();
//             $('#user-info').modal('show');

//         }
//     });
// });
$(".btn-detail").click(function () {
    // $('#user-form')[0].reset();
    $('.loadajax').show();
    $.ajax({
        url: ajaxUrl,
        success: function (data) {
            $('#popupModal').empty().html(data);
            $('.modal-title').html(newTitle);
            // $('#user-form')[0].reset();
            $('.detail-modal').modal('show');
            $('.loadajax').hide();
        }
    });
});
$('.update-one').click(function () {
    var itemId = $(this).attr('item-id');
    // $('#user-info').modal('show');
    $('.loadajax').show();
    $.ajax({
        url: ajaxUrl+'/'+itemId,
        success: function (data) {
            // $('#user-form')[0].reset();
            $('#popupModal').empty().html(data);
            $('.modal-title').html(updateTitle);
            // $('#user-form')[0].reset();
            $('.detail-modal').modal('show');
            $('.loadajax').hide();
        }
    });
});
$('.copy-one').click(function () {
    var itemId = $(this).attr('item-id');
    // $('#user-info').modal('show');
    $('.loadajax').show();
    $.ajax({
        url: ajaxUrl+'/'+itemId,
        data: {copy: itemId},
        success: function (data) {
            // $('#user-form')[0].reset();
            $('#popupModal').empty().html(data);
            $('.modal-title').html(copyTitle);
            // $('#user-form')[0].reset();
            $('.detail-modal').modal('show');
            $('.loadajax').hide();
        }
    });
});
$('.delete-one').click(function () {
    t= confirm(confirmMsg);
    if(!t)
        return;
    var itemId = $(this).attr('item-id');
    $.ajax({
        url: ajaxUrl+'/'+itemId+'/del',
        success: function (data) {
            if(data == 1)
            window.location.reload();

        }
    });
});

$("#searchAll").click(function () {
    $("#searchmmbers").toggle( "drop in" );
});

function showErrors(data) {
    $('.show-errors').html('<span class="hide-errors">x</span>');
    for (key in data) {
        if (data.hasOwnProperty(key) &&
            /^0$|^[1-9]\d*$/.test(key) &&
            key <= 4294967294
        ) {
            $('.show-errors').fadeIn();
            $('.show-errors').append('<div class="error-msg">' + data[key] + '</div>');
            // setTimeout(function () {
            //     $('.show-errors').fadeOut();
            // }, 5000);
            $('.hide-errors').click(function () {
                $('.show-errors').fadeOut();
            });
            break;

        }
    }
    setTimeout(function () {
        $('.show-errors').fadeOut();
    }, 3000);

}

function  iff(condition, a, b){
    if(condition) return a;
    else return b;
}
function isEmpty(str) {
    return (!str || 0 === str.length);
}
function convertToDateString(timestamp) {
    timestamp = timestamp.substring(0, 10);
    return timestamp;
}
function getHourMinute(timestamp) {
    timestamp = timestamp.substring(11, 16);
    return timestamp;
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.btnRQ-save').click(function () {
    t = confirm(confirmTxt);
    if(!t) return;
    var itemId = $(this).attr('data-id');
    var data = {'action': 1, 'item': itemId, 'Note': null};
    $.ajax({
        url: ajaxUrl,
        type: 'post',
        data: data,
        success: function (data) {
            // console.log(data);
            window.location.reload();

        }
    });
});
$('.btnRQ-del').click(function () {
    $("#reject-modal").modal("show");
    $("#overtime-id").val($(this).attr('data-id'));
});
$('.draggable').draggable();
$('.save-reject-form').click(function () {
    t = confirm(confirmTxt);
    if(!t) return;
    var itemId = $("#overtime-id").val();
    var note = $("[name='Note']").val();
    $.ajax({
        url: ajaxUrl,
        type: 'post',
        data: {'action': 2, 'item': itemId, 'Note': note},
        success: function (data) {
            // console.log(data);
            window.location.reload();

        }
    });
});
$("#saveProfile").click(function () {
    $('.loadajax').show();
    //Update capicity profile
    // console.log($("#capicity-profile").serializeArray());
    var capicityProfile = $("#capicity-profile").serializeArray();


    $.ajax({
        url: profileUrl,
        type: 'post',
        data: capicityProfile,
        success: function (data) {
            if (typeof data.errors !== 'undefined'){
                $('.loadajax').hide();
                showErrors(data.errors);

            }else{
                // console.log(data);
                $('.loadajax').hide();
                window.location.reload();
            }
        }
    });

});
$("#add-training").click(function () {
    html = $('#temp-training').html();
    $('.historyTraning').append(html);

    $('.frm-icon-remove').click(function () {
        $(this).parent().remove();
    });
    $(".sDate-input, .eDate-input").datetimepicker({
        format: 'YYYY/MM/DD',
    });

});
$('.frm-icon-remove').click(function () {
    $(this).parent().remove();
});
$('.open-vote').click(function () {
    var qid = $(this).attr('data-qid');
    // console.log(qid);
    $('.loadajax').show();
    $.ajax({
        url: voteUrl+'/'+qid,
        success: function (data) {
            // console.log(data);
            $('#popupModal').empty().html(data);
            // $('.modal-title').html(newTitle);
            // $('#user-form')[0].reset();
            $('.detail-modal').modal('show');
            $('.loadajax').hide();
        },
        fail: function(xhr,status,error){
            console.log(error);
        }
    });
});

//inArray javascript function
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}
//luan chuyen thiet bi
function getEquipmentList(eqType, eqOwner) {
    $.ajax({
        url: eqListAjaxUrl,
        type: 'post',
        data: {'eqType':eqType, 'eqOwner':eqOwner},
        success: function (data) {
            // console.log(data);
            $('.device_list').html('');

            for(key in data){
                if (data.hasOwnProperty(key) &&
                    /^0$|^[1-9]\d*$/.test(key) &&
                    key <= 4294967294
                ) {
                    eq = [];
                    $("input[name='eq1[]']").each(function(){
                        data_value = $(this).val();
                        // data_name = $(this).attr('data-name');
                        eq.push(data_value);
                    });
                    // console.log(eq);
                    if(!inArray(data[key].code, eq)){
                        html = `<div class="checkbox"><label><input class="checkboxDevice" type="checkbox" value="`+data[key].code+`" name="eq[]" data-name="`+data[key].name+` - <i>(`+data[key].code+`)</i>">`+data[key].name+` - <i>(`+data[key].code+`)</i></label></div>`;
                        $('.device_list').append(html);
                    }

                }
            }
        },
        fail: function(xhr,status,error){
            console.log(error);
        }
    });
}

function getShortName(str){
    var arr = str.split(" ");
    if(arr.length >1){
        return (arr[0].charAt(0)+arr[arr.length-1].charAt(0)).toUpperCase();
    }else{
        return arr[0].toUpperCase();
    }
}
//diff in times

function diff(start, end) {
    start = start.split(":");
    end = end.split(":");
    var startDate = new Date(0, 0, 0, start[0], start[1], 0);
    var endDate = new Date(0, 0, 0, end[0], end[1], 0);
    var diff = endDate.getTime() - startDate.getTime();
    var hours = Math.floor(diff / 1000 / 60 / 60);
    diff -= hours * 1000 * 60 * 60;
    var minutes = Math.floor(diff / 1000 / 60);

    return (hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes;
}
function coolAlert(str){
    alert(str);
}
