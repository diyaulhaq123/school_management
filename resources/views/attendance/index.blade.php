@extends('layouts.master')
@section('title')
Attendance
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Attendance  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            {{-- @can('add-class-allocation') --}}
            <a class="btn btn-primary float-end" href="{{ route('attendance.create') }}" > <i class="ri-add-circle-line"></i> Mark Class</a>
            {{-- @endcan --}}
        </div>
        <div class="card-body">
            <div class="card-title fw-bold">Attendance List</div>
           <div class="row justify-content-center">
            <div class="col-10">
                <div class="table table-responsive">
                    <table class="table display" id="myTable">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Student</th>
                                <th>Attendances</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $index => $row)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $row->admission_no }}</td>
                                <td>
                                    @foreach ($row->attendances as $attendance)
                                    <span class="badge {{ $attendance->active_status == 'present' ? 'bg-success' : 'bg-danger' }}">{{ $attendance->active_status == 'present' ? 'P' : 'A' }}</span>
                                    @endforeach
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
