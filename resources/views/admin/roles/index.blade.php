@extends('layouts.master')
@section('title')
    Roles
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Roles List  @endslot
@endcomponent

    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card p-3 mt-1">
                    <div class="card-header">
                        <h4>Roles</h4>
                        <a href="{{ route('roles.create') }}" class="btn btn-primary float-end">Add New Role</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table mt-3">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        <a href="{{ route('roles.show', $row) }}" class="btn btn-info btn-sm"><i class="ri-eye-fill"></i></a>
                                        <a href="{{ route('roles.edit', $row) }}" class="btn btn-warning btn-sm"><i class="ri-edit-fill"></i></a>
                                        @can('delete_permission')
                                        <form action="{{ route('roles.destroy', $row) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="ri-trash-fill"></button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
