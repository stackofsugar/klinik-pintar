@extends('layouts.admin')
@section('home-active', 'active')

@section('content')
    <div>
        <h2>Dashboard Admin</h2>
        <hr>
        <div class="mb-3">
            <h2 class="mb-0">Halo, <strong>{{ Auth::user()->fullname }}</strong></h2>
            <h5 class="text-muted">&commat;{{ Auth::user()->username }}</h5>
        </div>
        <h4 class="text-muted">Detail Admin</h4>
        <h5>
            Level Admin:
            @can('admin.cashier')
                Kasir
            @endcan
            @can('admin.global')
                Default
            @endcan
            @can('admin.poli')
                Poli
            @endcan
            @can('admin.god')
                <span>Pemilik</span>
            @endcan
        </h5>
    </div>
@endsection
