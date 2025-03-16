@extends('layouts.master')
@section('title')
Students
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Student List  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <select name="guardian_id" id="guardian_id" class="form-select">
                        <option value="">Select Guardian</option>
                        @foreach ($guardians as $row)
                        <option value="{{ $row->id }}"> {{ $row->name }} - {{ $row->email }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <select name="class_id" id="class_id" class="form-select">
                        <option value="">Select Class</option>
                        @foreach ($classes as $row)
                        <option value="{{ $row->id }}"> {{ $row->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <select name="wing" id="wing" class="form-select">
                        <option value="">Select Class</option>
                        @foreach ($wings as $row)
                        <option value="{{ $row->name }}"> {{ $row->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-4">
        @can('add-student')
        <div class="card-header">
            <a class="btn btn-primary float-end" href="{{ route('student.create') }}" > <i class="ri-add-circle-line"></i> Add Students</a>
            <div class="flex-shrink-0" bis_skin_checked="1">
                <a href="{{ route('upload.student') }}" class="btn btn-danger"><i class="ri-upload-2-fill me-1 align-bottom"></i> Upload Student List</a>
            </div>
        </div>
        @endcan
        <div class="card-body">
            {{-- <div class="card-title fw-bold">Students</div> --}}
           <div class="row justify-content-center">
            <div class="col-12">
                <div class="table table-responsive">
                    <table class="display table dataTable" id="buttons-datatables">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Other Name</th>
                                <th>Class</th>
                                <th>Wing</th>
                                <th>Guardian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
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
                        ],
                            ajax: {
                                url: '/api/students',
                                type: 'GET',
                                data: function(d) {
                                    d.class_id = $('#class_id').val();
                                    d.wing = $('#wing').val();
                                    d.guardian_id = $('#guardian_id').val();
                                }
                            },
                            processing: true,
                            serverSide: true,
                            searching : true,
                            columns: [
                                { data: 'id', name: 'id' },
                                { data: 'first_name', name: 'first_name', searching: true  },
                                { data: 'last_name', name: 'last_name', searching: true },
                                { data: 'other_name', name: 'other_name', searching: true  },
                                { data: 'class', name: 'class.name', searching: true  },
                                { data: 'wing', name: 'wing', searching: true },
                                { data: 'guardian', name: 'guardian', searching: true },
                                { data: 'status', name: 'status', orderable: false, searching: false },
                            ],
                            rowCallback: function(row, data) {
                                $(row).attr('onclick', `window.location='/student/${data.id}'`);
                                $(row).css('cursor', 'pointer');
                            }
                    });

                    $('#class_id, #wing, #guardian_id').on('change', function() {
                        table.ajax.reload();
                    });

        });


    </script>
@endsection
