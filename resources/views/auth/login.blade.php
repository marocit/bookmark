@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Login</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">E-Mail Address</label>

                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <small class="form-text text-muted">
                                            {{ $errors->first('email') }}
                                        </small>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Password</label>

                                    <input type="password" class="form-control" id="password" name="password">

                                    @if ($errors->has('password'))
                                        <small class="form-text text-muted">
                                            {{ $errors->first('password') }}
                                        </small>
                                    @endif

                            </div>

                            <div class="form-group">
                                <div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i> Login
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your
                                        Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
