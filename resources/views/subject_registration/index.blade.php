@extends('layouts.master')
@section('title')
Subject Registration for results
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Subject Registrations  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <a class="btn btn-primary float-end" href="{{ route('subject-registration.create') }}" > <i class="ri-add-circle-line"></i> Register Subjects </a>
        </div>
        <div class="card-body">
            <div class="card-title fw-bold">Subject Registrations</div>
           <div class="row justify-content-center">
            <div class="col-10">
                <div class="table table-responsive">
                    <table class="table display" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Session</th>
                                <th>Term</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $row)
                            <tr>
                                <input type="hidden" value="{{ $row->id }}" name="id" id="id">
                                <td>#</td>
                                <td > {{ $row->subject->name ?? '' }} </td>
                                <td > {{ $row->class->name ?? '' }} </td>
                                <td > {{ $row->session->name ?? '' }} </td>
                                <td > {{ $row->term->name ?? '' }} </td>
                                <td >
                                    <div class="btn-group">
                                        <div class="form-check form-switch mb-2" bis_skin_checked="1">
                                            <input class="form-check-input" type="checkbox" {{ $row->status == 'active' ? 'checked' : '' }} role="switch" id="status-switch">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                        </div>
                                        <form action="{{ route('subject-registration.destroy', $row->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" id="id">
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="ri-delete-bin-line"></i></button>
                                        </form>
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

    <script>
        document.getElementById('status-switch').addEventListener('change', function () {
            const statusInput = document.getElementById('status');
            statusInput.value = this.checked ? 'active' : 'inactive';
        });

        $(document).ready(function(){
            $('.form-check-input').change(function () {
                // Get the status of the checkbox that was toggled
                const isChecked = $(this).is(':checked');

                // Find the closest row and extract the ID
                const row = $(this).closest('tr');
                const id = row.find('input[name="id"]').val();
                const token = '{{ csrf_token() }}';
                const status = isChecked ? 'active' : 'inactive';

                // Send the AJAX request
                const url = `/toogle-subject-registration/${id}`;
                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: {
                        _token: token,
                        id: id,
                        status: status,
                    },
                    success: function (response) {
                        // Handle success
                        if (response.message === 'success') {
                            toastr.success('Updated!', 'Success');
                        }
                    },
                    error: function (xhr) {
                        // Handle error
                        toastr.error('An error occurred!', 'Error');
                    }
                });
            });

        });

    </script>

@endsection
