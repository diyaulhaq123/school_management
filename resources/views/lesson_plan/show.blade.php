@extends('layouts.master-without-nav')
@section('title')
    Login
@endsection
@section('content')
<div class="card p-2 m-2">
    <div class="card-header">
        <div class="row align-items-center mb-4">
            <div class="col-2 text-center">
                <img src="{{ asset('build/images/companies/img-2.png') }}" alt="School Logo" class="img-fluid" style="max-height: 80px;">
            </div>
            <div class="col-10 text-center">
                <h3 class="mb-0">School Name</h3>
                <p class="mb-0">123 School Address, City, State</p>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <p>LESSON PLAN</p>
        </div>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date: <br> {{ $lessonPlan->date }}</th>
                        <th>Class: {{ $lessonPlan->class->name }}</th>
                    </tr>
                    <tr>
                        <th>No In Class: <br> {{ $lessonPlan->no_in_class }}</th>
                        <th>Average Age: {{ $lessonPlan->average_age }}</th>
                    </tr>
                    <tr>
                        <th>Subject: {{ $lessonPlan->subject->name }}</th>
                        <th>Topic: {{ $lessonPlan->topic }}</th>
                    </tr>
                    <tr>
                        <th>Time: {{ $lessonPlan->time_from }}</th>
                        <th>Sub Topic: {{ $lessonPlan->sub_topic }}</th>
                    </tr>
                    <tr>
                        <th>Duration: {{ $lessonPlan->duration }}</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="fw-bold">LESSON OBJECTIVES</h6>
            </div>
            <div class="card-body">
                <p class="fw-bold">At the end of the lesson the students should be able to:</p>
                <p>{{ $lessonPlan->objective }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="fw-bold">STEP I: IDENTIFICATION OF PRIOR IDEAS</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <p class="fw-bold">Mode:</p>
                        <p>{{ $lessonPlan->mode_1 == 1 ? 'Individual' : 'Group' }}</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold">Teacher's Activities:</p>
                        <p>{{ $lessonPlan->teachers_activity_1 }}</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold">Student's Activities:</p>
                        <p>{{ $lessonPlan->student_activity_1 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="fw-bold">STEP II: EXPLORATION</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <p class="fw-bold">Mode:</p>
                        <p>{{ $lessonPlan->mode_2 == 1 ? 'Individual' : 'Group' }}</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold">Teacher's Activities:</p>
                        <p>{{ $lessonPlan->teachers_activity_2 }}</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold">Student's Activities:</p>
                        <p>{{ $lessonPlan->student_activity_2 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="fw-bold">STEP III: DISCUSSION</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <p class="fw-bold">Mode:</p>
                        <p>{{ $lessonPlan->mode_3 == 1 ? 'Individual' : 'Group' }}</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold">Teacher's Activities:</p>
                        <p>{{ $lessonPlan->teachers_activity_3 }}</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold">Student's Activities:</p>
                        <p>{{ $lessonPlan->student_activity_3 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="fw-bold">STEP IV: APPLICATION</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <p class="fw-bold">Mode:</p>
                        <p>{{ $lessonPlan->mode_4 == 1 ? 'Individual' : 'Group' }}</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold">Teacher's Activities:</p>
                        <p>{{ $lessonPlan->teachers_activity_4 }}</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold">Student's Activities:</p>
                        <p>{{ $lessonPlan->student_activity_4 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="fw-bold">STEP V: EVALUATION</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <p class="fw-bold">Mode:</p>
                        <p>{{ $lessonPlan->mode_5 == 1 ? 'Individual' : 'Group' }}</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold">Teacher's Activities:</p>
                        <p>{{ $lessonPlan->teachers_activity_5 }}</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold">Student's Activities:</p>
                        <p>{{ $lessonPlan->student_activity_5 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <p><strong>References:</strong> {{ $lessonPlan->reference }}</p>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="fw-bold">REMARKS</h6>
            </div>
            <div class="card-body">
                <p><strong>Reviewed By:</strong> <span class="text-uppercase">{{ ucfirst($lessonPlan->user->name) }}</span></p>
                <p><strong>Date:</strong> <span>{{ $lessonPlan->reviewed_on }}</span></p>
            </div>
        </div>
        @if (auth()->user()->hasRole(['admin','principal']))
            @if($lessonPlan->status == 0)
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('approve.lesson_plan') }}" method="post">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" id="id" value="{{ $lessonPlan->id }}">
                        <input type="hidden" name="reviewed_by" id="reviewed_by" value="{{ auth()->user()->id }}">
                        <div class="form-group mt-2">
                            <label for="">Add Remark</label>
                            <textarea class="form-control" name="remark" id="remark" cols="30" rows="5">{{ $lessonPlan->remark }}</textarea>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Date Reviewed</label>
                                    <input class="form-control" type="date" value="{{ $lessonPlan->reviewed_on == '' ? date('Y-m-d') :  $lessonPlan->reviewed_on }}" name="reviewed_on" id="reviewed_on">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">Approval Status</label>
                                <select class="form-select" name="status" id="">
                                    <option value="">Select</option>
                                    <option value="1" {{ $lessonPlan->status == 1 ? 'selected' : '' }} >Approve</option>
                                    <option value="0" {{ $lessonPlan->status == 0 ? 'selected' : '' }} >Not Approved Yet</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-primary" type="submit" >Save</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        @endif
    </div>

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> Powered by <a href="https://hilinksnetworks.ng">Hilinks Networks</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>

@endsection
