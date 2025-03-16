@extends('layouts.master')
@section('title')
View Scores
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') View Scores @endslot
@slot('title') Scores  @endslot
@endcomponent

@if (auth()->user()->hasRole(['admin','eo']))

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card p-2">
            <form action="{{ route('uploaded.scores.get') }}" method="get">
                    <div class="col-12 my-3">
                        <div class="form-group">
                            <select name="class_id" id="" class="form-select select2">
                                <option value="">Select Class</option>
                                @foreach ($classes as $row)
                                    <option value="{{ $row->id }}" {{ request('class_id') == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 my-3">
                        <div class="form-group">
                            <select name="subject_id" id="" class="form-select select2">
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $row)
                                    <option value="{{ $row->id }}" {{ request('subject_id') == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 my-3">
                        <div class="form-group">
                            <select name="session_id" id="" class="form-select select2">
                                <option value="">Select Session</option>
                                @foreach ($sessions as $row)
                                    <option value="{{ $row->id }}" {{ request('session_id') == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 my-3">
                        <div class="form-group">
                            <select name="term_id" id="" class="form-select select2">
                                <option value="">Select Term</option>
                                @foreach ($terms as $row)
                                    <option value="{{ $row->id }}" {{ request('term_id') == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 my-3">
                            <button class="btn btn-primary btn-sm float-end" type=""><i class="ri ri-eye-fill"></i></button>
                    </div>
            </form>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="card p-4">
            <div class="card-body">
                <div class="row justify-content-center">
                    @if ($grades && $grades != '')
                    <div class="row mb-2">
                        <div class="col-6">
                            <div>Session: {{ $session->name }}</div>
                            <div>Term: {{ $term->name }}</div>
                        </div>
                        <div class="col-6">
                            <div>Class: {{ $class->name }}</div>
                            <div>Subject: {{ $subject->name }}</div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Student Name</th>
                                    <th>Wing</th>
                                    <th>CA 1</th>
                                    <th>CA 2</th>
                                    <th>CA 3</th>
                                    <th>Exams</th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grades as $index => $row)
                                <tr>
                                    <input type="hidden" name="id[]" id="id" class="id" value="{{ $row->id }}">
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $row->student->last_name.' '.$row->student->first_name.' '.$row->student->other_name }} ({{ $row->id }})</td>
                                    <td>{{ $row->student->wing ?? '-' }}</td>
                                    <td>{{ $row->ca1 ?? '-' }}</td>
                                    <td>{{ $row->ca2 ?? '-' }}</td>
                                    <td>{{ $row->ca3 ?? '-' }}</td>
                                    <td>{{ $row->exam ?? '-' }}</td>
                                    {{-- <td>
                                        <button class="btn btn-primary btn-sm open" id="open" data-bs-toggle="modal" data-bs-target="#flipModal" data-id="{{ $row->id }}" ><i class="ri ri-eye-fill"></i></button>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-danger text-center">
                        No data found
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="card">
    <div class="row justify-content-center">
        <div class="alert-alert-danger text-center">You cannot access these resources</div>
    </div>
</div>
@endif



@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        $(document).ready(function(){
        });
    </script>

@endsection
