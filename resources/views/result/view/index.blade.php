@extends('layouts.master')
@section('title')
View Student Result
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') View Student Result  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <form action="{{ route('view.result.students', ['','']) }}" method="get">
                <div class="row align-items-end">
                    <div class="col-lg-5 col-md-4 col-sm-12">
                        <label for="">Classes</label>
                        <select name="class_id" id="class_id" class="form-select">
                            <option value="">Select Class</option>
                            @foreach ($classes as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-5 col-md-4 col-sm-12">
                        <label for="">Wing</label>
                        <select name="wing" id="wing" class="form-select">
                        <option value="">Select Wing</option>
                            @foreach ($wings as $row)
                            <option value="{{ $row->name }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-12">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                    {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="">Classes</label>
                        <select name="class_id" id="class_id">
                            @foreach ($classes as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                </div>
            </form>
        </div>
        @if ($students)
        <div class="card-body">
            <div class="card-title fw-bold">Students</div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Student Name</th>
                            <th>Admission Number</th>
                            <th>Session</th>
                            <th>Term</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $index => $row)
                        <form action="{{ route('result.slip', ['','','']) }}" method="get">
                        <tr>
                            <input type="hidden" name="student_id" id="student_id" value="{{ $row->id }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $row->last_name.' '.$row->first_name.' '.$row->other_name }}</td>
                            <td>{{ $row->admission_no }}</td>
                            <td>
                                {{ $row->session->name }}
                                <input type="hidden" name="session_id" value="{{ $row->session_id }}">
                            </td>
                            <td>
                                <select name="term_id" id="term_id" class="form-select form-select-sm">
                                @foreach ($terms as $term)
                                <option value="{{ $term->id }}">{{ $term->name }}</option>
                                @endforeach
                                </select>
                            </td>
                            <td>
                               <button class="btn btn-primary btn-sm"> <i class="ri-eye-fill"></i></button>
                            </td>
                        </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

</div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
