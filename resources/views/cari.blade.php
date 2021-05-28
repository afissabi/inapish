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
      <div class="col-md-1"></div>
      <div class="col-md-3">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
            @if(is_null($see))
            <a href="#" data-toggle="modal" data-target="#ubahfoto"><img style="height: 100px;width: 100px;" class="profile-user-img img-fluid img-circle" src="{{ asset('images/user.png') }}" alt="User profile picture">ada</a>
            @else
              @if(is_null($see->foto_profil))
                <a href="#" data-toggle="modal" data-target="#ubahfoto"><img class="profile-user-img img-fluid img-circle" src="{{ asset('images/user.png') }}" style="height: 100px;width: 100px;" alt="User profile picture"></a>
              @else
                <a href="#" data-toggle="modal" data-target="#ubahfoto"><img style="height: 100px;width: 100px;" class="profile-user-img img-fluid img-circle" src="{{ asset('images/profil/' . $see->foto_profil) }}" alt="User profile picture"></a>
              @endif
            @endif
            </div>
            <h3 class="profile-username text-center"><a href="{{ url('/home') }}">{{ $see->mimin->pengguna }}</a></h3>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Nama Lengkap</b> <a class="float-right">{{ $see->mimin->nama_lengkap }}</a>
              </li>
              <li class="list-group-item">
                <b>Tentang</b> <a class="float-right">@if($see != null){{ $see->tentang }}@endif</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /.col -->
      
      <div class="col-md-6">
        <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-search"></i>
            HASIL PENCARIAN...
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @foreach($tolek as $value)
            <div class="callout callout-danger">
              <div class="row">
                <div class="col-sm-3">
                @if(is_null($value->tentang))
                <a href="#" data-toggle="modal" data-target="#ubahfoto"><img style="height: 100px;width: 100px;" class="profile-user-img img-fluid img-circle" src="{{ asset('images/user.png') }}" alt="User profile picture"></a>
                @else
                  @if(is_null($value->tentang->foto_profil))
                    <a href="#" data-toggle="modal" data-target="#ubahfoto"><img style="height: 100px;width: 100px;" class="profile-user-img img-fluid img-circle" src="{{ asset('images/user.png') }}" alt="User profile picture"></a>
                  @else
                    <a href="#" data-toggle="modal" data-target="#ubahfoto"><img style="height: 100px;width: 100px;" class="profile-user-img img-fluid img-circle" src="{{ asset('images/profil/' . $value->tentang->foto_profil) }}" alt="User profile picture"></a>
                  @endif
                @endif
                </div>
                <div class="col-sm-9">
                  <h5>{{ $value->nama_lengkap }}</h5>
                  <a href="{{ url('profile/' . $value->id_admin) }}">Kunjungi Profil...</a>
                </div>
              </div>
            </div>
          @endforeach
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      </div>
    </div>
  </div>
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