@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center" align="center"><h3 style="color: #FA8226;">{{ __('UPDATE PROFILE') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="row mb-3">
                            <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Course') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="category" style="background-color: #FA8226; border-radius: 10px;">
                                    <option value="">Please select</option>
                                    <option value="PTA 1">PTA 1</option>
                                    <option value="PTA 2">PTA 2</option>
                                    <option value="PSM 1">PSM 1</option>
                                    <option value="PSM 2">PSM 2</option>
                                </select>
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 text-center">
                                <button type="submit" class="btn btn-primary btn-block" style="background-color: #145956; border-radius: 10px; border: none; color: white; font-size: 15px">
                                    <b>{{ __('UPDATE') }}</b>
                                </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
