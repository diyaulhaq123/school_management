@extends('layouts.master')
@section('title')
Mark Attendance
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Mark Attendance for day - "{{ now()->toDateString() }}" @endslot
@endcomponent

<div class="card p-3 m-3">
    <div class="card-body p-5">
        <form method="POST" action="{{ route('attendance.update') }}">
            @csrf

            <input type="hidden" name="class_id" value="{{ $allocation->class_id }}">
            <input type="hidden" name="session_id" value="{{ $allocation->session_id }}">
            <input type="hidden" name="term_id" value="{{ $allocation->term_id }}">

            <table class="table">
                <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Student Name</th>
                        <th>Admission No</th>
                        <th>Status</th>
                        <th>Mark</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $index => $record)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $record->student->last_name.' '.$record->student->first_name.' '.$record->student->other_name }}</td>
                            <td>{{ $record->admission_no }}</td>
                            <td>
                                @if ($record->active_status == 'absent')
                                <span class="badge bg-danger" id="stat">Absent</span>
                                @else
                                <span class="badge bg-success" id="stat">Present</span>
                                @endif
                            </td>
                            <td>
                                <input type="checkbox" name="attendance[{{ $record->student_id }}]"
                                       value="present"
                                       {{ $record->active_status == 'present' ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-success btn-sm float-end mt-2" type="submit">Update Attendance</button>
        </form>
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
