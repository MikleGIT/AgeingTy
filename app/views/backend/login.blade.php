<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<title>長者服務資訊</title>
	<link rel="stylesheet" href="{{ asset('backend_assets/css/bootstrap.css') }}">
	<script src="{{ asset('backend_assets/js/jquery-1.11.0.min.js') }}"></script>
	<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>

				
<h2 class="text-center" style="margin-top: 120px">長者服務資訊</h2>

<div class="row" style="margin-top: 20px">
	<div class="col-md-6 col-md-offset-3">

		@if( Session::get('login_incorrect') )
		<div class="alert alert-danger text-center"><strong>錯誤</strong> 帳號名稱或密碼錯誤</div>
		@endif

		@if( Session::get('logged_out') )
		<div class="alert alert-success text-center"><strong>你已成功登出!</strong></div>
		@endif
		
		<div class="panel" data-collapsed="0">
			
			<div class="panel-body">
				
				{{ Form::open(array('url' => action('BackendAuthController@postLogin'), 'method' => 'post', 'class' => 'form-horizontal form-groups-bordered', 'role' => 'form')) }}
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label">登入名稱</label>
						
						<div class="col-sm-5">
							<input type="text" class="form-control" placeholder="" name="username">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-4 control-label">密碼</label>
						
						<div class="col-sm-5">
							<input type="password" class="form-control" placeholder="" name="password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-3 col-sm-offset-4">
							<input type="submit" value="登入" class="btn btn-primary btn-block">
						</div>
					</div>
				{{ Form::close() }}
			</div>
		</div>
	
	</div>
</div>


<!-- Footer -->
<footer class="main text-center" style="margin-top: 100px">
	&copy; {{ date('Y') }} <strong>社會工作局網站</strong>
</footer>

	<script src="{{ asset('backend_assets/js/bootstrap.js') }}"></script>

</body>
</html>