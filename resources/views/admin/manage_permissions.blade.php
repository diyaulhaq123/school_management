@extends('layouts.master')
@section('title')
    Manage Permissions
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Manage Permissions  @endslot
@endcomponent
    <div class="container">
       <div class="row justify-content-center p-3">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card p-3 mt-1">
                <div class="card-header"><h5>Assign/Manage Permissions</h5></div>
                <div class="card-body">
                    <div class="card-title">
                        @if (session('success'))
                            <div class="alert alert-success p-2">{{ session('success') }}</div>
                        @endif
                    </div>


                    <div class="table-responsive">
                        <form action="{{ route('assign.permissions') }}" method="post">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Permission</th>
                                        @foreach ($roles as $role)
                                            <th class="text-center">{{ $role->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                            @foreach ($roles as $role)
                                                <td class="text-center">
                                                    <div class="form-switch">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               name="permissions[{{ $role->id }}][]"
                                                               value="{{ $permission->name }}"
                                                               {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button class="btn btn-success" type="submit">Save</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
       </div>
    </div>
@endsection


@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
