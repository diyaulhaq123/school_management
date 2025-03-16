@extends('layouts.master')
@section('title')
Subject Allocations
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Subject Allocations  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <a class="btn btn-primary float-end" href="{{ route('subject-allocations.create') }}" > <i class="ri-add-circle-line"></i> Allocate Subjects</a>
        </div>
        <div class="card-body">
            <div class="card-title fw-bold">Subject Allocations</div>
           <div class="row justify-content-center">
            <div class="col-10">
                <div class="table table-responsive">
                    <table class="table display" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Staff</th>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Wing</th>
                                <th>Session</th>
                                <th>Term</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subject_allocations as $row)
                            <tr>
                                <input type="hidden" value="{{ $row->id }}" name="id" id="id">
                                <td>#</td>
                                <td > {{ $row->user->name ?? '' }} </td>
                                <td > {{ $row->subject->name ?? '' }} </td>
                                <td > {{ $row->class->name ?? '' }} </td>
                                <td > {{ $row->wing ?? '' }} </td>
                                <td > {{ $row->session->name ?? '' }} </td>
                                <td > {{ $row->term->name ?? '' }} </td>
                                <td>
                                    <div class="form-check form-switch mb-2" bis_skin_checked="1">
                                        @can('add-grades')
                                        <a href="{{ route('add_grade.index', $row->id ) }}" class="btn btn-primary btn-sm">Add grades</a>
                                        @endcan
                                        @can('edit-subject-allocation')
                                        <a class="btn btn-info btn-sm" href="{{ route('subject-allocations.edit', $row->id) }}" ><i class="ri ri-edit-fill"></i></a>
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
