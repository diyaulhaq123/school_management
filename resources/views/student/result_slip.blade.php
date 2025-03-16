@extends('layouts.master')
@section('title')
Student Result Slip
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title')Result Slip  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <div class="row align-items-center mt-3">
                <!-- School Logo -->
                <div class="col-2 text-center">
                    <img src="{{ asset('build/images/companies/img-2.png') }}" alt="Student Photo" class="img-fluid rounded-circle" style="max-height: 100px;">
                </div>

                <!-- School Name and Address -->
                <div class="col-8 text-center">
                    <h2 class="mb-0">School Name</h2>
                    <p class="mb-0">123 School Address, City, State</p>
                    <p class="mb-0">Phone: (123) 456-7890 | Email: info@school.com</p>
                </div>

                <!-- Student Photo -->
                <div class="col-2 text-center">
                    <img src="{{ asset('build/images/avatar.jpeg') }}" alt="School Logo" class="img-fluid" style="max-height: 100px;">
                </div>
            </div>
            <!-- Student Details Section -->
            <div class="mt-4 p-3 border rounded">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Student Name:</strong> {{ $remarks->student->last_name.' '.$remarks->student->first_name.' '.$remarks->student->other_name }}</p>
                        <p><strong>Class:</strong> {{ $remarks->class->name }}</p>
                        <p><strong>Session:</strong> {{ $remarks->session->name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Term Average Score:</strong> {{ $average }}</p>
                        <p><strong>Highest Score:</strong> {{ $top_student->total_score }}</p>
                        <p><strong>Admission Number:</strong> {{ $remarks->student->admission_no }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Total Score:</strong> {{ $remarks->total_score }}</p>
                        <p><strong>Class Position:</strong> {{ $position }}</p>
                        <p><strong>Final Grade:</strong> A</p>
                    </div>
                </div>
            </div>
        </div>
        @if ($grades)
        <div class="card-body mt-3">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Subject</th>
                            <th>CA 1</th>
                            <th>CA 2</th>
                            <th>CA 3</th>
                            <th>Exams</th>
                            <th>Total</th>
                            <th>Grade</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($grades as $index => $row)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $row->subject->name }}</td>
                            <td>{{ $row->ca1 }}</td>
                            <td>{{ $row->ca2 }}</td>
                            <td>{{ $row->ca3 }}</td>
                            <td>{{ $row->exam }}</td>
                            <td>{{ $row->total }}</td>
                            <td>{{ $row->grade }}</td>
                            <td>{{ $row->remark }}</td>
                            @empty
                            <td class="text-center" colspan="9">No grades found for search</td>
                        </tr>
                        @endforelse
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
