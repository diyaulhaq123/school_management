@extends('layouts.master')
@section('title')
    Roles
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Create Role  @endslot
@endcomponent
    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card p-3 mt-1">
                    <div class="card-header">
                        <h4>Create Role</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Role</label>
                                        <input type="text" name="name" class="form-control" placeholder="Role Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
