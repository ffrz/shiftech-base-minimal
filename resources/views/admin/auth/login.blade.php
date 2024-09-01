<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk {{ env('APP_NAME') }}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center text-muted">
        <div>
          <span>Masuk <b>{{ env('APP_NAME') }}</b><sup><small> v{{ env('APP_VERSION_STR') }}</sup></small></span>
        </div>
        <div class="h6"><b>{{ App\Models\Setting::value('school.name', '') }}</b></div>
      </div>
      <div class="card-body">
        @if (Session::has('error'))
          <p class="login-box-msg text-danger">{{ Session::get('error') }}</p>
        @else
          <p class="login-box-msg">Masuk untuk memulai sesi anda.</p>
        @endif
        <form action="?" method="post">
          @csrf
          <div class="my-3">
            <div class="input-group">
              <input type="text" name="username" autofocus value="{{ old('username') }}" class="form-control"
                placeholder="ID Pengguna">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            @error('username')
              <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
          </div>
          <div class="my-3">
            <div class="input-group">
              <input type="password" name="password" value="" class="form-control" placeholder="Kata Sandi">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            @error('password')
              <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-right-to-bracket mr-2"></i>
                Masuk</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="mt-4 text-muted">&copy; Shift IT Solution 2024    </div>
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
