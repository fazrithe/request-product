<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head');
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><img src="{{ asset('assets/img/logo2.png') }}" alt="User Image" width="50%">
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="card-body">
                    <div class="col mb-4">
                        <div class="text-center text-bold">STOCK OPNAME TOKO</div>
                    </div>
                    <form method="POST" action="{{ route('actionlogin') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="tanggal" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal') }}</label>

                            <div class="col-md-6">
                                <input id="tanggal" type="text" class="date form-control" name="login_date" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tempat" class="col-md-4 col-form-label text-md-right">{{ __('Tempat') }}</label>

                            <div class="col-md-6">
                                <select name="area" class="form-control" required>
                                    <option value="">--Select Tempat--</option>
                                    <option value="toko1">Toko1</option>
                                    <option value="toko2">Toko2</option>
                                    <option value="toko3">Toko3</option>
                                    <option value="tok4">Toko4</option>
                                    <option value="toko5">Toko5</option>
                                    <option value="gudang1">Gudang1</option>
                                    <option value="gudang2">Gudang2</option>
                                    <option value="gudang3">Gudang3</option>
                                    <option value="gudang4">Gudang4</option>
                                    <option value="gudang5">Gudang5</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="col mb-4">
                            <div class="text-center text-bold">LOGIN</div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
<script type="text/javascript">
    $('.date').datepicker({
       format: 'yyyy-mm-dd',
       autoclose: true,
     });
</script>
