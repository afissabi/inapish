<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" style="height:10px;" href="{{ asset('images/logo.png') }}"/>
  <title>Inapish</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
@if(session('status'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-close"></i> Alert!</h4>
        {{ session('status') }}
    </div>
@endif
<div class="row">
  <div class="col-sm-6">
    <img style="width: 100%;" class="" src="{{ asset('images/inapish.png') }}" alt="User profile picture">
  </div>
  <div class="col-sm-6">
    <div class="login-box">
      <div class="card">
        <div class="card-body login-card-body">
          <center>
            <p style="font-family: cursive;font-size: 37px;">INAPISH</p>
            <p>Buat akun untuk melihat foto dan video dari teman Anda.</p>
          </center>
          <form action="{{ url('daftar') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="user" placeholder="Nomor Ponsel atau Email">
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="pengguna" placeholder="Nama Pengguna">
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="sandi" placeholder="Kata Sandi">
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
              </div>
            </div>
          </form>
          <div class="social-auth-links text-center mb-3">
            <p>Sudah punya akun ? <a href="#" data-toggle="modal" data-target="#mlebu">Klik disini</a></p> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="mlebu">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ url('/mlebu') }}" method="post" enctype="multipart/form-data" id="loginform" class="form-vertical">
      {{ csrf_field() }}
      <div class="modal-header">
        <center><h4 class="">Login</h4></center>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nomor Ponsel atau Email" name="user" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Kata Sandi" name="sandi" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success pull-right">Login</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if(session('alert_success'))
<script type="text/javascript">
  Swal.fire(
    'Berhasil!',
    '{{ session('alert_success') }}',
    'success'
  )
</script>
@endif
@if(session('alert_fail'))
<script type="text/javascript">
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: '{{ session('alert_fail') }}!'
  })
</script>
@endif
</body>
</html>