@extends('layouts.master')
@section('title')
Students
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Student @endslot
@slot('title') Add new Student  @endslot
@endcomponent

<div class="card p-4">
    <div class="card-header">
        <a href="{{ route('student.index') }}" class="btn btn-primary"><i class="ri-arrow-left-circle-line"></i> Back to list</a>
        <div class="form-check form-switch mb-2 float-end" bis_skin_checked="1">
            <input class="form-check-input" type="checkbox" role="switch" id="status-switch">
            <label class="form-check-label" for="flexSwitchCheckDefault">Student have an admission number(Yes)</label>
            <input type="hidden" name="status" id="status" value="0">
        </div>
    </div>
    <div class="card-body">

        <div class="col-lg-12 col-md-12 col-sm-12">
            <form action="{{ route('student.store') }}" method="post">
                @csrf
                <div class="row justify-content-between align-items-end">

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">First Name <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="First name">
                        </div>
                        @error('first_name')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Last Name <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Last name">
                        </div>
                        @error('last_name')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Other Name </label>
                            <input type="text" class="form-control" name="other_name" id="other_name" value="{{ old('other_name') }}" placeholder="Other name">
                        </div>
                        @error('other_name')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Select Guardian  <i class="text-danger">*</i></label>
                            <select class="select2 form-select" name="guardian_id" id="guardian_id" >
                                <option value="">Select Guardian</option>
                                @foreach ($guardians as $row)
                                <option value="{{ $row->id }}" {{ $row->id == old('guardian_id') ? 'selected' : '' }} > {{ ucfirst($row->name) }} ({{ $row->email }}) </option>
                                @endforeach
                            </select>
                        </div>
                        @error('guardian_id')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Select Gender  <i class="text-danger">*</i></label>
                            <select class="select2 form-select" name="gender" id="gender" >
                                <option value="">Select Guardian</option>
                                <option value="male" {{ 'male' == old('gender') ? 'selected' : '' }} > Male </option>
                                <option value="female" {{ 'female' == old('gender') ? 'selected' : '' }} > Female </option>
                            </select>
                        </div>
                        @error('gender')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Select Class Category  <i class="text-danger">*</i></label>
                            <select class="form-select" name="class_category_id" id="class_category_id" >
                                <option value="">Select Category</option>
                                @foreach ($categories as $row)
                                <option value="{{ $row->id }}" {{ $row->id == old('class_category_id') ? 'selected' : '' }} > {{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        @error('class_category_id')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Select Class  <i class="text-danger">*</i></label>
                            <select class="form-select " name="class_id" id="class_id" >
                                <option value="">Select Class</option>
                                @foreach ($classes as $row)
                                <option value="{{ $row->id }}" {{ $row->id == old('class_id') ? 'selected' : '' }} > {{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        @error('class_id')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Select Wing  <i class="text-danger">*</i></label>
                            <select class="form-select" name="wing" id="wing" >
                                <option value="">Select Wing</option>
                                @foreach ($wings as $row)
                                <option value="{{ $row->name }}" {{ $row->name == old('wing') ? 'selected' : '' }} > {{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        @error('wing')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-12 col-sm-12 mb-3" id="category" style="display:none" >
                        <label for="">Category</label>
                        <select name="category" id="category" class="form-select">
                            <option value="">Select Category</option>
                            @foreach ($category as $row)
                            <option value="{{ $row->id }}" {{ old('category') == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4" id="session_div">
                        <div class="form-group">
                            <label for="">Select Session  <i class="text-danger">*</i></label>
                            <select class="form-select" name="session_id" id="session_id" >
                                <option value="">Select Session</option>
                                @foreach ($sessions as $row)
                                <option value="{{ $row->id }}" {{ $row->id == old('session_id') ? 'selected' : '' }} > {{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        @error('session_id')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4" id="admission_div">
                        <div class="form-group">
                            <label for="">Admission Number <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="admission_no" id="admission_no" value="{{ old('admission_no') }}" placeholder="Enter Student Admission No">
                            <input type="text" class="form-control text-muted" readonly name="admission_no" id="admission_no_generate" value="111111111" placeholder="Admission No">
                        </div>
                        @error('admission_no')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Address <i class="text-danger">*</i></label>
                            <textarea type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" placeholder="Address"></textarea>
                        </div>
                        @error('address')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Select State Of Origin</label>
                            <select class="form-select" name="state_id" id="state_id" >
                                <option value="">Select State</option>
                                @foreach ($states as $row)
                                <option value="{{ $row->id }}" {{ $row->id == old('state_id') ? 'selected' : '' }} > {{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        @error('state_id')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Select Lga Of Origin</label>
                            <select class="form-select" name="lga_id" id="lga_id" >
                                <option value="">Select Lga</option>
                                @foreach ($lgas as $row)
                                <option value="{{ $row->id }}" {{ $row->id == old('lga_id') ? 'selected' : '' }} > {{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        @error('lga_id')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-12">
                        <button class="btn btn-primary" type="submit"> <i class="ri-save-fill"></i>Save</button>
                        <a href="{{ route('student.index') }}" class="btn btn-danger" > <i class="ri-arrow-left-circle-line"></i>Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script src="{{ asset('build/js/app.js') }}"></script>

    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('build/js/pages/select2.init.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#admission_no').hide();
            $('#status-switch').on('change', function () {
                const statusInput = $('#status');
                statusInput.val(this.checked ? '1' : '0');
                const status = statusInput.val();
                if (status === '1') {
                    $('#admission_no_generate').hide();
                    $('#admission_no').show();
                } else {
                    $('#admission_no').hide();
                    $('#admission_no_generate').show();
                }
            });
        })

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
