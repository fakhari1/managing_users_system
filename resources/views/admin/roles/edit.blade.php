@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('partials.alerts')
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ "لیست نقش ها" }}</div>

                    <div class="card-body">

                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        {{ "ویرایش نقش" }}
                        {{ $role->persian_name }}
                    </div>

                    <div class="card-body">
                        <form action="{{ route('roles.update', $role) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="row my-2 justify-content-around">
                                <input type="text" name="name" id="name" class="form-control form-control-sm w-40"
                                       placeholder="نام نقش" value="{{ $role->name }}">
                                <input type="text" name="persian_name" id="persian_name"
                                       class="form-control form-control-sm w-40"
                                       placeholder="نام فارسی نقش" value="{{ $role->persian_name }}">
                            </div>

                            <div class="row my-2">
                                <label for="" class="form-label border-bottom py-2">
                                    {{ "مجوز دسترسی به نقش" }}
                                    {{ $role->persian_name }}
                                </label>
                                <div class="d-flex flex-wrap justify-content-around">
                                    @foreach($permissions as $key => $permission)
                                        <div class="form-check">
                                            <input type="checkbox"
                                                   name="permissions[]"
                                                   value="{{ $permission->name }}"
                                                   {{ $role->hasPermission($permission) ? "checked" : "" }}
                                                   id="permission-{{ $permission->id }}"
                                                   class="form-check-input float-end ms-2">

                                            <label for="" class="form-check-label">
                                                {{ $permission->persian_name }}
                                            </label>

                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row my-2 justify-content-start">
                                <div>
                                    <button type="submit" class="btn btn-sm btn-warning">ویرایش</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
