@extends('layouts.master')
@section('title')
Lesson Plan
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Lesson Plan  @endslot
@slot('title') Edit Lesson Plan  @endslot
@endcomponent

<div class="card p-4">
    <div class="card-body">
        <form action="{{ route('lesson_plan.update', $lessonPlan->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="row justify-content-center">
                <div class="card p-3">
                    <div class="card-header bg-light">
                        <strong>{{ $lessonPlan->term->name ?? '-' }} Lesson Plan Session {{ $lessonPlan->session->name ?? '-' }} </strong>
                    </div>
                    <input type="hidden" name="term_id" id="term_id" value="{{ $lessonPlan->term_id }}">
                    <input type="hidden" name="session_id" id="session_id" value="{{ $lessonPlan->session_id }}">
                    <input type="hidden" name="staff_id" id="staff_id" value="{{ auth()->user()->id }}">
                    <div class="card-body">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row align-items-end">

                                <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="">Date</label>
                                        <input type="date" class="form-control" name="date" id="date" value="{{ $lessonPlan->date }}" placeholder="date">
                                    </div>
                                    @error('date')
                                    <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-lg-3 col-sm-12 mb-4" >
                                    <label for="">Class</label>
                                    <select name="class_id" id="class_id" class="form-select">
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $row)
                                        <option value="{{ $row->id }}" {{ $lessonPlan->class_id == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                    <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="">No in class</label>
                                        <input type="number" class="form-control" name="no_in_class" id="no_in_class" value="{{ $lessonPlan->no_in_class }}" placeholder="no in class">
                                    </div>
                                    @error('no_in_class')
                                    <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="">Average Age</label>
                                        <input type="number" class="form-control" name="average_age" id="average_age" value="{{ $lessonPlan->average_age }}" placeholder="average age">
                                    </div>
                                    @error('average_age')
                                    <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-3 col-sm-12 mb-4">
                                    <label for="">Subject</label>
                                    <select name="subject_id" id="subject_id" class="form-select">
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $row)
                                        <option value="{{ $row->id }}" {{ $row->id == $lessonPlan->subject_id ? 'selected' : '' }} >{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                    <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="">Topic</label>
                                        <input type="text" class="form-control" name="topic" id="topic" value="{{ $lessonPlan->topic }}" placeholder="Topic">
                                    </div>
                                    @error('topic')
                                    <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="">Sub Topic</label>
                                        <input type="text" class="form-control" name="sub_topic" id="sub_topic" value="{{ $lessonPlan->sub_topic }}" placeholder="Sub Topic">
                                    </div>
                                    @error('sub_topic')
                                    <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="">Time From</label>
                                        <input type="time" class="form-control" name="time_from" id="time_from" value="" placeholder="Time From">
                                    </div>
                                    @error('time_from')
                                    <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="">Time To</label>
                                        <input type="time" class="form-control" name="time_to" id="time_to" value="" placeholder="Time To">
                                    </div>
                                    @error('time_to')
                                    <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="">Duration</label>
                                        <input type="text" class="form-control" name="duration" id="duration" value="{{ $lessonPlan->duration }}" placeholder="Duration">
                                    </div>
                                    @error('duration')
                                    <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="">Lesson Objectives</label>
                                        <textarea class="form-control" name="objective" id="objective" placeholder="Lesson Objective">{{ $lessonPlan->objective }}</textarea>
                                    </div>
                                    @error('objective')
                                    <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-3">
                    <div class="card-header bg-light">
                        <strong>Step I: Introduction</strong>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Mode</label>
                                <select name="mode_1" id="mode_1" class="form-select">
                                    <option value="">Select</option>
                                    <option value="1" {{ $lessonPlan->mode_1 == 1 ? 'selected' : '' }} >Individual</option>
                                    <option value="2" {{ $lessonPlan->mode_1 == 2 ? 'selected' : '' }} >Group</option>
                                </select>
                                @error('mode_1')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Teacher's Activities</label>
                                <input name="teachers_activity_1" id="teachers_activity_1" class="form-control" value="{{ $lessonPlan->teachers_activity_1 }}" placeholder="Teacher's Activities">
                                @error('teachers_activity_1')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Student's Activities</label>
                                <input name="student_activity_1" id="student_activity_1" class="form-control" value="{{ $lessonPlan->student_activity_1 }}" placeholder="Student's Activities">
                                @error('student_activity_1')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-3">
                    <div class="card-header bg-light">
                        <strong>Step II: Exploration</strong>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Mode</label>
                                <select name="mode_2" id="mode_2" class="form-select">
                                    <option value="">Select</option>
                                    <option value="1" {{ $lessonPlan->mode_2 == 1 ? 'selected' : '' }} >Individual</option>
                                    <option value="2" {{ $lessonPlan->mode_2 == 2 ? 'selected' : '' }} >Group</option>
                                </select>
                                @error('mode_2')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Teacher's Activities</label>
                                <input name="teachers_activity_2" id="teachers_activity_2" class="form-control" value="{{ $lessonPlan->teachers_activity_2 }}" placeholder="Teacher's Activities">
                                @error('teachers_activity_2')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Student's Activities</label>
                                <input name="student_activity_2" id="student_activity_2" class="form-control" value="{{ $lessonPlan->student_activity_2 }}" placeholder="Student's Activities">
                                @error('student_activity_2')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-3">
                    <div class="card-header bg-light">
                        <strong>Step III: Discussion</strong>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Mode</label>
                                <select name="mode_3" id="mode_3" class="form-select">
                                    <option value="">Select</option>
                                    <option value="1" {{ $lessonPlan->mode_3 == 1 ? 'selected' : '' }} >Individual</option>
                                    <option value="2" {{ $lessonPlan->mode_3 == 2 ? 'selected' : '' }} >Group</option>
                                </select>
                                @error('mode_3')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Teacher's Activities</label>
                                <input name="teachers_activity_3" id="teachers_activity_3" class="form-control" value="{{ $lessonPlan->teachers_activity_3 }}" placeholder="Teacher's Activities">
                                @error('teachers_activity_3')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Student's Activities</label>
                                <input name="student_activity_3" id="student_activity_3" class="form-control" value="{{ $lessonPlan->student_activity_3 }}" placeholder="Student's Activities">
                                @error('student_activity_3')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-3">
                    <div class="card-header bg-light">
                        <strong>Step IV: Application</strong>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Mode</label>
                                <select name="mode_4" id="mode_4" class="form-select">
                                    <option value="">Select</option>
                                    <option value="1" {{ $lessonPlan->mode_4 == 1 ? 'selected' : '' }} >Individual</option>
                                    <option value="2" {{ $lessonPlan->mode_4 == 2 ? 'selected' : '' }} >Group</option>
                                </select>
                                @error('mode_1')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Teacher's Activities</label>
                                <input name="teachers_activity_4" id="teachers_activity_4" class="form-control" value="{{ $lessonPlan->teachers_activity_4 }}" placeholder="Teacher's Activities">
                                @error('teachers_activity_4')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Student's Activities</label>
                                <input name="student_activity_4" id="student_activity_4" class="form-control" value="{{ $lessonPlan->student_activity_4 }}" placeholder="Student's Activities">
                                @error('student_activity_4')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-3">
                    <div class="card-header bg-light">
                        <strong>Step V: Evaluation</strong>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Mode</label>
                                <select name="mode_5" id="mode_5" class="form-select">
                                    <option value="">Select</option>
                                    <option value="1" {{ $lessonPlan->mode_5 == 1 ? 'selected' : '' }} >Individual</option>
                                    <option value="2" {{ $lessonPlan->mode_5 == 2 ? 'selected' : '' }} >Group</option>
                                </select>
                                @error('mode_1')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Teacher's Activities</label>
                                <input name="teachers_activity_5" id="teachers_activity_5" class="form-control" value="{{ $lessonPlan->teachers_activity_5 }}" placeholder="Teacher's Activities">
                                @error('teachers_activity_1')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-4" >
                                <label for="">Student's Activities</label>
                                <input name="student_activity_5" id="student_activity_5" class="form-control" value="{{ $lessonPlan->student_activity_5 }}" placeholder="Student's Activities">
                                @error('student_activity_5')
                                <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12">
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="{{ route('lesson_plan.index') }}" class="btn btn-danger" >Back</a>
            </div>
        </form>
    </div>
</div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        document.getElementById('status-switch').addEventListener('change', function () {
            const statusInput = document.getElementById('status');
            statusInput.value = this.checked ? '1' : '0';
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#class_category_id').change(function(){
                var category = $('#class_category_id').val();
                if(category == 4){
                    $('#category').show();
                }
            });
        });

    </script>

@endsection
