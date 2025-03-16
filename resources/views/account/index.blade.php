@extends('layouts.master')
@section('title')
Accounts
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') {{ ucfirst($type) ?? '' }}  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <a class="btn btn-primary float-end" href="{{ route('accounts.create', $type ?? '' ) }}" > <i class="ri-add-circle-line"></i> Add {{ ucfirst($type) ?? '' }}</a>
        </div>
        <div class="card-body">
            {{-- <div class="card-title fw-bold">Students</div> --}}
           <div class="row justify-content-center">
            <div class="col-12">
                <div class="table table-responsive">
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
                                            <a href="{{ route('children.index', $row->id) }}" class="btn btn-info btn-sm">View Chid <i class="ri-eye-fill"></i></a>
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
                </div>
            </div>
           </div>
        </div>
    </div>

</div>

@endsection


@section('css')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

@endsection

@section('script')

    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    {{-- <script src="{{ asset('build/js/pages/datatables.init.js') }}"></script> --}}
    <script>
        // document.addEventListener('DOMContentLoaded', function () {
        //     let table = new DataTable('#myTable',);
        // });

        $(document).ready(function(){
            let table = $('#buttons-datatables').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print', 'pdf'
                ]
            });
        });


    </script>
@endsection
