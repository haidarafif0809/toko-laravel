@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
                <li><a href="{{ url('/home') }}">Home</a></li>
                <li class="active">Ubah Password</li>
            </ul>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Ubah Password</h2>
            </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/ubah-password/password') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password Lama</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autofocus>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                           <label for="new_password" class="col-md-4 control-label">Password Baru</label>
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" required>
                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error': '' }}">
                            <label for="new_password_confirmation" class="col-md-4 control-label">Konfirmasi Password anyar</label>
                            <div class="col-md-6">
                                 <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                                @if ($errors->has('new_password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                        Simpan
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
