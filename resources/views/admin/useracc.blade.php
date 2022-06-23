@extends('layouts.admin')
@section('useracc-active', 'active')

@section('content')
    <div>
        <h2>Manajemen Akun Pengguna</h2>
        <hr>
        <div class="dropdown mb-2">
            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown">
                {{ $users->perPage() }} item per halaman
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/admin/dashboard/account/user?perpage=3">3</a></li>
                <li><a class="dropdown-item" href="/admin/dashboard/account/user?perpage=5">5</a></li>
                <li><a class="dropdown-item" href="/admin/dashboard/account/user?perpage=25">25</a></li>
                <li><a class="dropdown-item" href="/admin/dashboard/account/user?perpage=50">50</a></li>
                <li><a class="dropdown-item" href="/admin/dashboard/account/user?perpage=100">100</a></li>
                <li><a class="dropdown-item" href="/admin/dashboard/account/user?perpage=500">500</a></li>
            </ul>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
@endsection
