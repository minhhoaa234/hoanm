@extends('layouts.app')
@section('content')
<div id="container">
        <div class="group-top">
            <div class="col-lg-12">
                <h1 class="page-header">Thông tin khách hàng</h1>

            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-8 col-sm-12 col-xs-12">

                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="add-dReport">
                        <button type="button" class="btn btn-primary" id="add-new-user-btn">Thêm thành viên</button> 
                         <a href ="{{ route('export') }}" class="btn btn-info export" id="export-button"> Export file </a>                   
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
                    <th>ID</th>
                    <th><a href="#">Họ và Tên</a></th>
                    <th><a href="#">Email</a></th>
                    <th><a href="#">Địa chỉ</a></th>
                    <th><a href="#">Ngày sinh</a></th>
                    <th><a href="#">Số điện thoại</a></th>
                    <th><a href="#">Giới tính</a></th>
                    <th>Ảnh đại diện</th>
                    <th>Admin</th>
                    <th>Hành động</th>

                </tr>
                </thead>
                <tbody>
                	@foreach($user as $value)
                 	<tr class="even gradeC" data-id="" id='a'>
                 	<td>{{$value->id}}</td>
					<td>{{$value->Fullname}}</td>
					<td>{{$value->email}}</td>
					<td>{{$value->adress}}</td>
					<td>{{$value->Birthday}}</td>
					<td>{{$value->Tel}}</td>
					<td>{{($value->Gender=="1")?'Nam':'Nữ'}}</td>
					<td>{{$value->avatar}}</td>
					<td>{!!$value->isAdmin==1 ? '<i class="fa fa-check" style="font-size:20px;color:green"></i>' : '<i class="fa fa-close" style="font-size:20px;color:darkred"></i>' !!}</td>	
					<td>
						 <button class="btn btn-success btn-xs update edit update-user" item-id="{{ $value->id }}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
						 <button class="btn btn-danger btn-xs update delete delete-user" item-id="{{ $value->id }}">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
					</td>
                    </tr>
                    @endforeach
                 </tbody>
            </table>
                      {{ $user->links() }}

        </div class="banks">
        	<div class="banks-table">
        		
        	</div>
        <div >
        	
        </div>

        <div id="popupModal">

        </div>

    </div>
    <script>src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"</script>
   <script type="text/javascript">
        	$("#add-new-user-btn").click(function () {
    			$.ajax({
	        		url: 'showUsers',
	        		success: function (data) {
			            $('#popupModal').empty().html(data);
			            $('.modal-title').html('Thêm thành viên');
			            $('#user-info').modal('show');
					      //      		console.log(data);
        			}
    			});
			});
			$(".update-user").click(function () {
				    var itemId = $(this).attr('item-id');
    			$.ajax({
	        		url: 'showUsers'+'/'+itemId,
	        		success: function (data) {
			            $('#popupModal').empty().html(data);
			            $('.modal-title').html('Thay đổi thông tin');
			            $('#user-info').modal('show');
					      //      		console.log(data);
        			}
    			});
			});
			$('.delete-user').click(function () {
			    var t=confirm('Bạn có chắc muốn xóa');
				    if(!t)
				        return;
			    var itemId = $(this).attr('item-id');
			    $.ajax({
			        url: 'showUsers'+'/'+itemId+'/del',
			        success: function (data) {
			            if(data == 1)
			            window.location.reload();

			        }
			    });
			});

			$('.table-user-groups #a').click(function(){
				var name= $(this).closest('tr').find('td:nth-child(1)').text()
				// console.log(name);
				 $.ajax({
	        		url: 'banks',
	        		data : {
                         name : name,
                    },
	        		success: function (data) {
			            $('.banks-table').empty().html(data);
					      //      		console.log(data);
        			}
        		})
			});
        </script>
@endsection