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
                    <div class="card-header">{{ "افزودن نقش" }}</div>

                    <div class="card-body">
                        <form action="{{ route('roles.store') }}" method="post">
                            @csrf
                            <div class="d-flex py-2 justify-content-around">
                                <input type="text" name="name" id="name" class="form-control form-control-sm w-40"
                                       placeholder="نام نقش">
                                <input type="text" name="persian_name" id="persian_name" class="form-control form-control-sm w-40"
                                       placeholder="نام فارسی نقش">
                                <button type="submit" class="btn btn-sm btn-primary ">افزودن</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">{{ "لیست نقش ها" }}</div>

                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام انگلیسی</th>
                                <th scope="col">نام فارسی</th>
                                <th scope="col" class="mw-115-px">مجوز دسترسی برای</th>
                                <th scope="col">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($roles as $key => $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->persian_name }}</td>
                                    <td class="mw-115-px">
                                        <div class="d-flex flex-wrap mx-auto justify-content-around">
                                            @foreach($role->permissions as $key => $permission)
                                                <span
                                                    class="badge bg-transparent border border-primary text-primary my-1">{{ $permission->persian_name }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-warning"
                                           href="{{ route('roles.edit', $role) }}">ویرایش</a>
                                        <a class="btn btn-sm btn-danger" href="{{ route('roles.delete', $role) }}"
                                           onclick="event.preventDefault(); document.getElementById('delete_role').submit();">حذف</a>

                                        <form action="{{ route('roles.delete', $role) }}" method="post"
                                              id="delete_role">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>نقشی در سیستم ثبت نشده است.</tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
