@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nama_toko') ? ' has-error' : '' }}">
                            <label for="nama_toko" class="col-md-4 control-label">Nama Toko</label>

                            <div class="col-md-6">
                                <input id="nama_toko" type="text" class="form-control" name="nama_toko" value="{{ old('nama_toko') }}" required autofocus>

                                @if ($errors->has('nama_toko'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nama_toko') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nama_pemilik') ? ' has-error' : '' }}">
                            <label for="nama_pemilik" class="col-md-4 control-label">Nama Pemilik</label>

                            <div class="col-md-6">
                                <input id="nama_pemilik" type="text" class="form-control" name="nama_pemilik" value="{{ old('nama_pemilik') }}" required autofocus>

                                @if ($errors->has('nama_pemilik'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nama_pemilik') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
                            <label for="no_telp" class="col-md-4 control-label">No Telepon/Hp</label>

                            <div class="col-md-6">
                                <input id="no_telp" type="tel" class="form-control" name="no_telp" value="{{ old('no_telp') }}" required>

                                @if ($errors->has('no_telp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('no_telp') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Konfirmasi Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" onclick="sweetAlert();" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
