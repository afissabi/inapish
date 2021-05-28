@extends('template')

@section('title')

@endsection

@section('styles')
@endsection

@section('fonts')
    {{--  --}}
@endsection

@section('head-content')
<br>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
            @if(is_null($see))
            <a href="#" data-toggle="modal" data-target="#ubahfoto"><img style="height: 100px;width: 100px;" class="profile-user-img img-fluid img-circle" src="{{ asset('images/user.png') }}" alt="User profile picture"></a>
            @else
              @if(is_null($see->foto_profil))
                <a href="#" data-toggle="modal" data-target="#ubahfoto"><img style="height: 100px;width: 100px;" class="profile-user-img img-fluid img-circle" src="{{ asset('images/user.png') }}" alt="User profile picture"></a>
              @else
                <a href="#" data-toggle="modal" data-target="#ubahfoto"><img style="height: 100px;width: 100px;" class="profile-user-img img-fluid img-circle" src="{{ asset('images/profil/' . $see->foto_profil) }}" alt="User profile picture"></a>
              @endif
            @endif
            </div>
            <h3 class="profile-username text-center"><a href="{{ url('/home') }}">{{ session('admin')->pengguna }}</a></h3>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Nama Lengkap</b> <a class="float-right">{{ session('admin')->nama_lengkap }}</a>
              </li>
              <li class="list-group-item">
                <b>Tentang</b> <a class="float-right">@if($see != null){{ $see->tentang }}@endif</a>
              </li>
            </ul>
            <a href="#" data-toggle="modal" data-target="#userupdate" class="btn btn-primary btn-block"><b>Edit Profil</b></a>
            <a href="#" data-toggle="modal" data-target="#createpost" class="btn btn-warning btn-block"><i class="fa fa-camera"></i> <b>Tambah Posting</b></a>
          </div>
        </div>
      </div>
      <!-- /.col -->
      @foreach($post as $value)
      <div class="col-md-3">
        <div class="card" style="height: 100%;">
          <div class="card-header">
            <div class="card-tools">
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-align-justify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item" data-toggle="modal" data-target="#updatepost{{ $value->id_posting }}">Edit Foto & Caption</a>
                  <a href="{{ url('destroy-posting/' . $value->id_posting) }}" onclick="return confirm('Anda yakin menghapus postingan ini ?')" class="dropdown-item">Hapus</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <img class="img-fluid pad" src="{{ asset('images/posting/' . $value->foto) }}" alt="Photo">
            <p>{{ $value->caption }}</p>
            <a href="{{ url('like/' . $value->id_posting) }}" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</a>
            <span class="float-right text-muted">{{ $value->like }} Suka - @if($value->ijin_komen == 1) Komentar <br> dinon-aktifkan @else <a href="{{ url('full-page/' . $value->id_admin) }}">{{ $value->jumkom }} Komentar </a> @endif</span>
          </div>
          <div class="card-footer">
            @if($value->ijin_komen == 0)
            <form action="{{ url('/tambah-komen/' . $value->id_posting) }}" method="post" enctype="multipart/form-data" id="loginform" class="form-vertical">
              {{ csrf_field() }}
              <div class="input-group input-group-sm mb-0">
                <input class="form-control form-control-sm" placeholder="Tulis Komentar..." name="komentar">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-danger">Send</button>
                </div>
              </div>
            </form>
            @endif
          </div>
        </div>
      </div>
      @endforeach
      </div>
    </div>
  </div>
  <div class="modal fade" id="userupdate">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ url('/update-profil') }}" method="post" enctype="multipart/form-data" id="loginform" class="form-vertical">
        {{ csrf_field() }}
        <div class="modal-header">
          <center><h4 class="">Edit Profil</h4></center>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Nama Lengkap" value="{{ session('admin')->nama_lengkap }}" name="nama" required/>
            </div>
            <div class="form-group has-feedback">
              <textarea maxlength="200" name="tentang" rows="3" class="form-control" placeholder="maksimal 200 karakter">@if($see != null){{ $see->tentang }}@endif</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success pull-right">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ubahfoto">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ url('/update-foto') }}" method="post" enctype="multipart/form-data" id="loginform" class="form-vertical">
        {{ csrf_field() }}
        <div class="modal-header">
          <center><h4 class="">Ubah Foto Profil</h4></center>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group has-feedback">
              <input type="file" class="form-control" name="foto" required/>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          @if($see != null)
          <a href="{{ url('hapus-foto/' . $see->id_tentang ) }}" onclick="return confirm('Anda yakin menghapus foto profil ?')" class="btn btn-danger btn-block" ><i class="fa fa-trash"></i> Hapus Foto</a>
          @endif
          <button type="submit" class="btn btn-success pull-right">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="createpost">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ url('/create-post') }}" method="post" enctype="multipart/form-data" id="loginform" class="form-vertical">
        {{ csrf_field() }}
        <div class="modal-header">
          <center><h4 class="">Tambahkan Posting Anda...</h4></center>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group has-feedback">
              <input type="file" class="form-control" name="foto" required/>
            </div>
            <div class="form-group has-feedback">
              <textarea rows="3" class="form-control" name="caption" placeholder="Caption Anda..."></textarea>
            </div>
            <div class="form-group has-feedback">
              <label>Ijin Komentar :</label>
              <select class="form-control" name="ijin_komen">
                <option value="0">Aktifkan Komentar</option>
                <option value="1">Matikan Komentar</option>
              </select>
            </div>
            <div class="form-group has-feedback">
              <label>Ijin Publikasi :</label>
              <select class="form-control" name="ijin">
                <option value="0">Public</option>
                <option value="1">Private</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success pull-right">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <?php
    $kom = ['Aktifkan Komentar','Matikan Komentar'];
    $pub = ['Public','Private'];
  ?>
  @foreach($post as $value)
  <div class="modal fade" id="updatepost{{ $value->id_posting }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ url('/update-post/' . $value->id_posting ) }}" method="post" enctype="multipart/form-data" id="loginform" class="form-vertical">
        {{ csrf_field() }}
        <div class="modal-header">
          <center><h4 class="">Update Posting Anda...</h4></center>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group has-feedback">
              <input type="file" class="form-control" name="foto">
            </div>
            <div class="form-group has-feedback">
              <textarea rows="3" class="form-control" name="caption" placeholder="Caption Anda...">{{ $value->caption }}</textarea>
            </div>
            <div class="form-group has-feedback">
              <label>Ijin Komentar :</label>
              <select class="form-control" name="ijin_komen">
                @foreach($kom as $key => $data)
                  <option value="{{ $key }}" {{ $key == $value->ijin_komen ? 'selected' : '' }}>
                      {{ $data }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group has-feedback">
              <label>Ijin Publikasi :</label>
              <select class="form-control" name="ijin">
                @foreach($pub as $key => $data)
                  <option value="{{ $key }}" {{ $key == $value->ijin ? 'selected' : '' }}>
                      {{ $data }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success pull-right">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach
</section>
@endsection

@section('content')

@endsection

@section('scripts')    
@if(session('alert_success'))
<script type="text/javascript">
  Swal.fire(
    'Berhasil!',
    '{{ session('alert_success') }}',
    'success'
  )
</script>
@endif
@if(session('alert_like'))
<script type="text/javascript">
  Swal.fire(
    icon: 'hearth',
    title: 'Terima Kasih',
    text: '{{ session('alert_like') }}!'
  )
</script>
@endif
@endsection