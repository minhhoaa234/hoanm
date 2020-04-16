 <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/absence.js') }}"></script>
<div class="modal draggable fade in" id="user-info" role="dialog">
    <div class="modal-dialog modal-lg ui-draggable">
        <div class="modal-content">
            <div class="modal-body">
                <div class="save-errors"></div>
                                <form class="form-horizontal" action="" method="POST" id="banks-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            @if(!isset($bAcc->id))
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="">Họ và Tên:<sup>*</sup>:</label>
                                                <div class="col-sm-8">
                                                    <select class="selectpicker  show-tick show-menu-arrow sl-department" id="select-user" data-width="100%" name="userid" data-size="5" >
                                                        <option value="">Họ và Tên</option>
                                                        @foreach($user as $user)                                                   
                                                            <option value="{{$user->id}}" > {{$user->Fullname}}</option>
                                                        @endforeach
                                                     
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="">Tên Ngân Hàng <sup>*</sup>:</label>
                                                <div class="col-sm-8">
                                                    <select class="selectpicker  show-tick show-menu-arrow sl-department" id="select-banks" data-width="100%" name="BankID" data-size="5" >
                                                        <option value="">Chọn Ngân Hàng</option>
                                                        @foreach($banks as $banks)                                                   
                                                            <option value="{{$banks->id}}"> {{$banks->banksName}}</option>
                                                        @endforeach
                                                     
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="">Chi nhánh <sup>*</sup>:</label>
                                                <div class="col-sm-8">
                                                    <select class="selectpicker  show-tick show-menu-arrow sl-department" id="select-branch" data-width="100%" name="branchsid" data-size="5" >
                                                        <option value="">Chọn Chi Nhánh</option>
                                                        @foreach($branch as $branch)                                                   
                                                            <option value="{{$branch->id}}" >{{$branch->branchName}}</option>
                                                        @endforeach
                                                     
                                                    </select>
                                                </div>
                                            </div>
                                            @else
                                            <input type="hidden" name="userid" value="{{ $bAcc->userid }}">
                                            <input type="hidden" name="branchsid" value="{{ $bAcc->branchsid }}">
                                            <input type="hidden" name="id" value="{{ $bAcc->id }}">

                                            @endif
                                            
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="accNumber">Số tài khoản<sup>*</sup>:</label>
                                                <div class="col-sm-8">
                                                    <input type="tel" class="form-control" id="accNumber" name="accNumber" maxlength="15" value="{{isset($bAcc->accNumber)?$bAcc->accNumber:null}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="accName">Tên tài khoản</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="accName" name="accName" maxlength="100" value="{{isset($bAcc->accName)?$bAcc->accName:null}}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm" id="save-banks-form">Save</button>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("select[name='BankID']").on('change', function() {
            // console.log($(this).val());
            $.ajax({
                url: "getBranch/"+$(this).val(),
                success: function (data) {
                    console.log(data);
                   
                    html = ``;
                    for(key in data){
                        // console.log(data[key].id);
                        html += `<option value="`+data[key].id+`">`+data[key].branchName+`</option>`;
                    }
                    // console.log(html);
                    $("select[name='branchsid']").html(html);
                    $("select[name='branchsid']").selectpicker('refresh');
                },
                fail: function (error) {
                    console.log(error);
                }
            });
    });
    $('#save-banks-form').click(function(){
            $.ajax({
                url: 'storeBanks',
                type: 'post',
                data: $('#banks-form').serializeArray(),
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