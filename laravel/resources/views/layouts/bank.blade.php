<div id="container">
        <div class="group-top">
            <div class="col-lg-12">
                <h1 class="page-header">Thông tin ngân hàng</h1>

            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-8 col-sm-12 col-xs-12">

                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="add-dReport">
                            <button type="button" class="btn btn-primary" id="add-new-banks-btn">Thêm ngân hàng</button>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-left">
                    <div class="dataTables_length" id="dataTables-user_length">
                    </div>
                </div>
                <div class="pull-right">
                    <div id="dataTables-user_filter" class="dataTables_filter">
                        <label>
                            <form>
                                <input type="search" class="form-control input-sm" placeholder="Tìm kiếm..." name="search" value="">
                                <input type="submit" value="Search" style="display: none">
                            </form>
                        </label>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <!-- Table daily report detail -->
        <div class="table-responsive tbl-dReport">
            <table width="100%" class="table table-striped table-bordered table-hover table-user-groups">
                <thead class="thead-default">
                <tr>
                    <th>Stt</th>
                    <th><a href="#">Họ và Tên</a></th>
                    <th><a href="#">Ngân Hàng</a></th>
                    <th><a href="#">Chi nhánh</a></th>
                    <th><a href="#">Số tài khoản</a></th>
                    <th><a href="#">Tên tài khoản</a></th>
                    <th>Hành động</th>

                </tr>
                </thead>
                @foreach($bank as $k=> $value)
                <tr>
                	<td>{{$k+1}}</td>
                	<td>{{$value->Fullname}}</td>
                	<td>{{$value->banksName}}</td>
                	<td>{{$value->branchName}}</td>
                	<td>{{$value->accNumber}}</td>
                	<td>{{$value->accName}}</td>
					<td>
						 <button class="btn btn-success btn-xs update edit update-bAcc" item-id="{{ $value->banksaccid }}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
						 <button class="btn btn-danger btn-xs update delete delete-bAcc" item-id="{{ $value->banksaccid }}">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
					</td>
                </tr>
                @endforeach
                <tbody>
                	
                 </tbody>
            </table>
              <!-- {{-- $bank->links() --}} -->
        
        	
        </div>

        <div id="popupModal-banks">

        </div>
</div>
<script type="text/javascript">
	$("#add-new-banks-btn").click(function () {
    			$.ajax({
	        		url: 'show',
	        		success: function (data) {
			            $('#popupModal').empty().html(data);
			            $('.modal-title').html('Thêm ngân hàng');
			            $('#user-info').modal('show');
					      //      		console.log(data);
        			}
    			});
			});
	$(".update-bAcc").click(function () {
				    var itemId = $(this).attr('item-id');
    			$.ajax({
	        		url: 'show'+'/'+itemId,
	        		success: function (data) {
			            $('#popupModal').empty().html(data);
			            $('.modal-title').html('Sửa thông tin ngân hàng');
			            $('#user-info').modal('show');
					      //      		console.log(data);
        			}
    			});
			});
	$('.delete-bAcc').click(function () {
			    var t=confirm('Bạn có chắc muốn xóa');
				    if(!t)
				        return;
			    var itemId = $(this).attr('item-id');
			    $.ajax({
			        url: 'show'+'/'+itemId+'/del',
			        success: function (data) {
			            if(data == 1)
			            window.location.reload();

			        }
			    });
			});
</script>