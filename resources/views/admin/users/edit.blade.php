@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('partials.validation-errors')
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ "ویرایش کاربران" }}</div>

                    <div class="card-body">

                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ "ویرایش کاربر" }}
                        {{ $user->name }}
                    </div>

                    <div class="card-body">
                        <form action="{{ route('users.update', $user) }}" method="post" class="px-4">
                            @csrf
                            @method('patch')
                            <div class="row my-2">
                                <label for="name"
                                       class="form-label text-end">
                                    نام کاربر:
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control form-control-sm"
                                       value="{{ $user->name }}">
                            </div>
                            <div class="row my-2">
                                <label for="" class="form-label text-end">
                                    ایمیل:
                                </label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       class="form-control form-control-sm text-start"
                                       value="{{ $user->email }}">
                            </div>
                            <div class="row my-2">
                                <label for="password" class="form-label text-end">
                                    گذرواژه:
                                </label>
                                <input type="text"
                                       name="password"
                                       id="password"
                                       class="form-control form-control-sm text-start"
                                       value="">
                            </div>
                            <div class="row py-2">
                                <label for="phone_number" class="form-label text-end">
                                    شماره همراه:
                                </label>
                                <input type="text"
                                       name="phone_number"
                                       id="phone_number"
                                       class="form-control form-control-sm text-start"
                                       value="{{ $user->phone_number }}">
                            </div>
                            <div class="row py-2">
                                <label for="roles" class="form-label border-bottom py-2">افزودن نقش به کاربر:</label>
                                <div class="d-flex flex-wrap justify-content-around">
                                    @foreach($roles as $key => $role)
                                        <div class="form-check">

                                            <input class="form-check-input float-end ms-2"
                                                   name="roles[]"
                                                   value="{{ $role->name }}"
                                                   id="role-{{ $role->id }}"
                                                   @if($user->hasRole($role)) checked="checked" @endif
                                                   type="checkbox">


                                            <label class="form-check-label">
                                                {{ $role->persian_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row py-2">
                                <label for="permissions" class="form-label border-bottom py-2">افزودن دسترسی به کاربران
                                    برای:</label>
                                <div class="d-flex flex-wrap justify-content-around">
                                    @foreach($permissions as $key => $permission)
                                        <div class="form-check">

                                            <input type="checkbox"
                                                   name="permissions[]"
                                                   value="{{ $permission->name }}"
                                                   @if($user->hasPermission($permission)) checked="checked" @endif
                                                   id="permission-{{ $permission->id }}"
                                                   class="form-check-input float-end ms-2">

                                            <label for="" class="form-check-label">
                                                {{ $permission->persian_name }}
                                            </label>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="text-start ps-0">
                                    <button class="btn btn-sm btn-success">ویرایش</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
