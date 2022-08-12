@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('partials.alerts')
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ "لیست کاربران" }}</div>

                    <div class="card-body">

                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ "لیست کاربران" }}</div>

                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام</th>
                                <th scope="col">ایمیل</th>
                                <th scope="col">نقش ها</th>
                                <th scope="col">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $key => $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="mw-65-px">
                                        @foreach($user->roles as $key => $role)
                                            <span class="badge bg-transparent border border-primary text-primary w-60-px">{{ $role->persian_name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-warning"
                                           href="{{ route('users.edit', $user) }}">ویرایش</a>
                                        <a class="btn btn-sm btn-danger" href="{{ route('users.delete', $user) }}"
                                           onclick="event.preventDefault(); document.getElementById('delete_user').submit();">حذف</a>

                                        <form action="{{ route('users.delete', $user) }}" method="post"
                                              id="delete_user">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>کاربری در سیستم ثبت نشده است.</tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
