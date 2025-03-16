@extends('layouts.master')
@section('title')
    Permissions
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Permissions List  @endslot
@endcomponent
    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card p-3 mt-1 overflow-hidden" style="100vh; ">
                    <div class="card-header">
                        <h4>Permission</h4>
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary float-end"><i class="ti ti-plus"></i>Add New Permission</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table mt-3 display" id="myTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $index => $row )
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>
                                            <a href="{{ route('permissions.show', $row) }}" class="btn btn-info btn-sm"><i class="ri-eye-fill"></i></a>
                                            <a href="{{ route('permissions.edit', $row) }}" class="btn btn-warning btn-sm"><i class="ri-edit-fill"></i></a>
                                            @can('delete_permission')
                                            <form action="{{ route('permissions.destroy', $row) }}" method="POST" style="display:inline-block;">
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

     <script>

         $(document).ready(function(){
            let table = $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print', 'pdf'
                ],
            });

         });

     </script>

@endsection
