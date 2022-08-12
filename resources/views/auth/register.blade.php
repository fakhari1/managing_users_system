@extends('layouts.app')

@section('title', __('auth.register'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-10 col-md-6">
            @include('partials.alerts')

            <div class="card">
                <div class="card-header">
                    {{ __('auth.register') }}
                </div>

                <div class="card-body">
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="row form-group mb-3">
                            <label for="email" class="col-3 col-sm-2 form-label">{{ __('auth.email') }}</label>
                            <div class="col-9 col-sm-10">
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <label for="name" class="col-3 col-sm-2 form-label">{{ __('auth.name') }}</label>
                            <div class="col-9 col-sm-10">
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <label for="password" class="col-3 col-sm-2 form-label">{{ __('auth.password') }}</label>
                            <div class="col-9 col-sm-10">
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <label for="password_confirmation"
                                   class="col-3 col-sm-2 form-label">{{ __('auth.password_confirmation') }}</label>
                            <div class="col-9 col-sm-10">
                                <input type="text" name="password_confirmation" id="password_confirmation"
                                       class="form-control ">
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <label for="phone" class="col-3 col-sm-2 form-label">{{ __('auth.phone') }}</label>
                            <div class="col-9 col-sm-10">
                                <input type="text" name="phone_number" id="phone" class="form-control">
                            </div>
                        </div>
                        <div style="margin-right: 13%">
                            @include('partials.validation-errors')
                        </div>

                        <div style="margin-right: 17%">
                            <button type="submit" class="btn btn-sm btn-success">{{ __('auth.register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
