@extends('layouts.master')
@section('title')
Children
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title')
    {{ $user->hasRole('guardian') || $user->type == 'guardian' ? 'Children' : 'Students' }}
@endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
        </div>
        <div class="card-body">
            {{-- <div class="card-title fw-bold">Students</div> --}}
            <div class="row justify-content-center">
                @foreach ($user->children as $row)
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-body p-3" bis_skin_checked="1">
                        <div class="d-flex mb-4 align-items-center" bis_skin_checked="1">
                            <div class="flex-shrink-0" bis_skin_checked="1">
                                <img src="{{ asset('build/images/avatar.jpeg') }}" alt="" class="avatar-sm rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-2" bis_skin_checked="1">
                                <h5 class="card-title mb-1">{{ $row->last_name.' '.$row->first_name.' '.$row->other_name }}</h5>
                                <p class="text-muted mb-0">{{ $row->class->name }}</p>
                            </div>
                        </div>
                        <h6 class="mb-1">Sessions - {{ $row->studentSessions($row->id) }}</h6>
                        <p class="card-text text-muted">Expense Account - ₦ {{ number_format($row->totalPayments($row->id), 2) }}</p>
                        <a href="{{ route('student.show', $row->id) }}" class="btn btn-primary btn-sm mb-2">View Student History <i class="ri-eye-fill"></i> </a>
                    </div>
                </div>
                @endforeach


                {{-- {{ $user->children }} --}}

            {{-- <div class="col-12"> --}}
                {{-- <div class="table table-responsive">
                    <table class="display table dataTable" id="buttons-datatables">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $index => $row)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }} </td>
                                <td>
                                    @foreach ($row->roles as $role)
                                    {!! '<span class="badge bg-info">'.$role->name.'</span>' ?? 'No role assigned' !!}
                                    @endforeach
                                </td>
                                <td>{{ $row->phone_number }}</td>
                                <td>{!! $row->status == '1' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">In-active</span>' !!}</td>
                                <td>
                                    <div class="btn-group">
                                        @if ($row->hasRole('guardian') || $row->type == 'guardian' )
                                            <a href="{{ route('accounts.show', [$type,$row]) }}" class="btn btn-info btn-sm">View Chid <i class="ri-eye-fill"></i></a>
                                        @endif
                                        <a href="{{ route('accounts.edit', [$type,$row]) }}" class="btn btn-warning btn-sm"><i class="ri-edit-fill"></i></a>
                                        @can('delete_account')
                                        <form action="{{ route('accounts.destroy', [$type,$row]) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="ri-trash-fill"></button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
            {{-- </div> --}}
            </div>
        </div>
    </div>

</div>

@endsection



@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
