@extends('layouts.master')
@section('title')
Students
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Student @endslot
@slot('title') Upload Student List @endslot
@endcomponent

<div class="card p-4">
    <div class="card-header">
        <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#flipModal">View Upload Format</button>
    </div>
    <div class="card-body">
        <div class="row">
            <form action="{{ route('create.student.upload') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row my-4">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="">Session </label>
                        <select name="session_id" id="session_id" class="form-select">
                            <option value="">Select Session</option>
                            @foreach ($sessions as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('session_id')
                            <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="">Class </label>
                        <select name="class_id" id="class_id" class="form-select">
                            <option value="">Select Class</option>
                            @foreach ($classes as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="">Class Wing </label>
                        <select name="wing" id="wing" class="form-select">
                            <option value="">Select Wing</option>
                            @foreach ($wings as $row)
                            <option value="{{ $row->name }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('wing')
                            <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

               <div class="row align-items-end">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <label for="">Upload Student List</label>
                        <input class="form-control" type="file" id="student_list" name="student_list">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <button for="formFile" class="btn btn-danger "><i class="ri-upload-2-fill me-1 align-bottom"></i> Upload List</button>
                    </div>
                    <div class="col-12">
                        @error('student_list')
                            <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
               </div>
                </input>
            </form>
        </div>
    </div>
</div>


<!-- Modal flip -->
<div id="flipModal" class="modal  modal-lg fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flipModalLabel">Student Upload Format</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="fs-16">
                    Excel format
                </h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Other name</th>
                            <th>Guardian Phone Number</th>
                            <th>Class name</th>
                            <th>Session</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>Lga</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
@section('script')
    <script src="{{ asset('build/js/app.js') }}"></script>
@endsection
