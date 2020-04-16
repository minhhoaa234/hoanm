<div class="modal draggable fade in" id="user-info" role="dialog">
    <div class="modal-dialog modal-lg ui-draggable">

        <div class="modal-content">
            <div class="modal-header ui-draggable-handle" style="cursor: move;">
                <button type="button" class="close" data-dismiss="modal" id="close-user-form">×</button>
                <h4 class="modal-title">Thêm thành viên</h4>
            </div>
            <div class="modal-body">
                <div class="save-errors">
                    
                </div>
                                <form class="form-horizontal" action="" method="POST" id="user-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">

                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="tel">Email:</label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" id="email" name="email" value="{{isset($user->email)?$user->email:null}}">
                                                </div>
                                            </div>
                                            @if(!isset($user->email))
                                            <div class="form-group password" style="">
                                                <label class="control-label col-sm-4" for="pwd">Mật khẩu <sup>*</sup>:</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="pwd" name="password" maxlength="30" value="{{isset($user->password)?$user->password:null}}">
                                                </div>
                                            </div>
                                            <div class="form-group confirm-password" style="">
                                                <label class="control-label col-sm-4" for="cfpwd">Xác nhận mật khẩu <sup>*</sup>:</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="cfpwd" name="password_confirmation" maxlength="30" autocomplete="new-password">
                                                </div>
                                            </div>
                                            @else
                                             <input type="hidden" name="id" value="{{ $user->id }}">
                                            @endif
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="Fullname">Họ và Tên <sup>*</sup>:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="Fullname" name="Fullname" maxlength="50" value="{{isset($user->Fullname)?$user->Fullname:null}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="birthday">Ngày sinh:</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group date" id="birthday">
                                                        <input type="text" class="form-control dtpkTime" name="Birthday" value="{{isset($user->Birthday)?$user->Birthday:null}}">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="gender">Giới tính:</label>
                                                <div class="col-sm-8">
                                                    <label class="radio-inline"><input type="radio" name="Gender" value="1" {{ isset($user->Gender) && ($user->Gender==1) ? "checked" : ""}}>Nam</label>
                                                    <label class="radio-inline"><input type="radio" name="Gender" value="0"{{ isset($user->Gender) && ($user->Gender==0) ? "checked" : ""}}>Nữ</label>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="tel">Điện thoại<sup>*</sup>:</label>
                                                <div class="col-sm-8">
                                                    <input type="tel" class="form-control" id="tel" name="Tel" maxlength="15" value="{{isset($user->Tel)?$user->Tel:null}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="adress">Địa chỉ:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="adress" name="adress" maxlength="100" value="{{isset($user->adress)?$user->adress:null}}">
                                                </div>
                                            </div>
                                          <!--   <div class="form-group ">
                                                <label class="control-label col-sm-4" for="note">Avatar :</label>
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" id="myFile" name="avatar">
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="isAdmin">Admin:</label>
                                                <div class="col-sm-8">
                                                    <label class="radio-inline"><input type="radio" name="isAdmin" value="1"{{ isset($user->isAdmin) && ($user->isAdmin==1) ? "checked" : ""}}>Yes</label>
                                                    <label class="radio-inline"><input type="radio" name="isAdmin" value="0"{{ isset($user->isAdmin) && ($user->isAdmin==0) ? "checked" : ""}}>No</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm" id="save-user-form">Save</button>
                    </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        $('#birthday, .dtpkTime').datetimepicker({
            format: 'YYYY/MM/DD',
        });
        $(".selectpicker").selectpicker();

        $('#save-user-form').click(function(){
            $.ajax({
                url: 'user',
                type: 'post',
                data: $('#user-form').serializeArray(),
                success: function (data) {
                // console.log( $('#user-form').serializeArray());
                if (typeof data.errors !== 'undefined'){
                    console.log(data.errors);
                    $('.user-save-errors').html('');
                    for(key in data.errors){
                        if (data.errors.hasOwnProperty(key)  &&
                            /^0$|^[1-9]\d*$/.test(key) &&
                            key <= 4294967294
                        ) {
                            $('.user-save-errors').show();
                            $('.user-save-errors').append('<div class="error">'+data.errors[key]+'</div>');
                        }
                    }
                    // showErrors(data.errors);
                }else{
                    console.log(data);
                  //  window.location.reload();
                }

                // console.log(data);

            },
            fail: function (error) {
                console.log(error);
            }
            })
        })

    </script>