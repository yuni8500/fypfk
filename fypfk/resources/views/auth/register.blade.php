@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" align="center"><h3 style="color: #145956;">{{ __('SIGN UP') }}</h3></div>

                <div class="card-body">
                    <!--<form method="POST" action="{{ route('register') }}"> -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-9">
                                <input id="name" type="text" style="background-color: #86B5B3; border-radius: 10px;" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-9">
                                <input id="email" type="email" style="background-color: #86B5B3; border-radius: 10px;" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="numPhone" class="col-md-3 col-form-label text-md-end">{{ __('Number Phone') }}</label>

                            <div class="col-md-9">
                                <input id="numPhone" type="text" style="background-color: #86B5B3; border-radius: 10px;" class="form-control @error('numPhone') is-invalid @enderror" name="numPhone" value="{{ old('numPhone') }}" required autocomplete="numPhone">

                                @error('numPhone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="matric" class="col-md-3 col-form-label text-md-end">{{ __('Student/Staff ID') }}</label>

                            <div class="col-md-9">
                                <input id="matric" type="text" style="background-color: #86B5B3; border-radius: 10px;" class="form-control @error('matric') is-invalid @enderror" name="matric" value="{{ old('matric') }}" required autocomplete="matric">

                                @error('matric')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category" class="col-md-3 col-form-label text-md-end">{{ __('Category') }}</label>

                            <div class="col-md-9">
                                <select class="form-control" name="category" style="background-color: #86B5B3; border-radius: 10px;">
                                    <option value="">Please select</option>
                                    <option value="Student">Student</option>
                                    <option value="Staff">Staff</option>
                                </select>
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-3 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-9">
                                <input id="password" type="password" style="background-color: #86B5B3; border-radius: 10px;" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-9">
                                <input id="password-confirm" type="password" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 offset-md-5">
                                <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px; margin-top: 20px;">
                                    {{ __('SIGN UP') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row mb-0">
                            <div class="col-md-9 offset-md-4">
                                <a class="btn btn-link" href="{{ route('login') }}" style="color: black; padding-top: 20px;">
                                    <center><b>{{ __('Have an account? Login Now') }}</b></center>
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
