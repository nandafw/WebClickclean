@extends('layouts.backend.master')

@section('title')
    Tambah Pengguna
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>@yield('title')</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <button class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>
</div>
@endsection