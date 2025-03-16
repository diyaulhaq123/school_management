@extends('layouts.master')
@section('title')
Student
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Student @endslot
@slot('title') Edit/View Profile  @endslot
@endcomponent

<div class="container-fluid" bis_skin_checked="1">

    <div class="position-relative mx-n4 mt-n4" bis_skin_checked="1">
        <div class="profile-wid-bg profile-setting-img" bis_skin_checked="1">
            <img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
            <div class="overlay-content" bis_skin_checked="1">
                <div class="text-end p-3" bis_skin_checked="1">
                    <div class="p-0 ms-auto rounded-circle profile-photo-edit" bis_skin_checked="1">
                        <input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input">
                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                            <i class="ri-image-edit-line align-bottom me-1"></i> Dashboard
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" bis_skin_checked="1">
        <div class="col-xxl-3" bis_skin_checked="1">
            <div class="card mt-n5" bis_skin_checked="1">
                <div class="card-body p-4" bis_skin_checked="1">
                    <div class="text-center" bis_skin_checked="1">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4" bis_skin_checked="1">
                            <img src="{{ asset('build/images/avatar.jpeg') }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit" bis_skin_checked="1">
                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                    <span class="avatar-title rounded-circle bg-light text-body">
                                        <i class="ri-camera-fill"></i>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <h5 class="fs-16 mb-1">{{ $student->last_name.' '.$student->first_name.' '.$student->other_name }}</h5>
                        <p class="text-muted mb-0">Student</p>
                    </div>
                </div>
            </div>
            <!--end card-->
            <div class="card" bis_skin_checked="1">
                <div class="card-body" bis_skin_checked="1">
                    <div class="d-flex align-items-center mb-5" bis_skin_checked="1">
                        <div class="flex-grow-1" bis_skin_checked="1">
                            <h5 class="card-title mb-0">Complete Your Profile</h5>
                        </div>
                        <div class="flex-shrink-0" bis_skin_checked="1">
                            <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i class="ri-edit-box-line align-bottom me-1"></i> Edit</a>
                        </div>
                    </div>
                    <div class="progress animated-progress custom-progress progress-label" bis_skin_checked="1">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" bis_skin_checked="1">
                            <div class="label" bis_skin_checked="1">50%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-9" bis_skin_checked="1">
            <div class="card mt-xxl-n5" bis_skin_checked="1">
                <div class="card-header" bis_skin_checked="1">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="true">
                                <i class="fas fa-home"></i> Personal Details
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab" aria-selected="false" tabindex="-1">
                                <i class="far fa-user"></i> Change Password
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4" bis_skin_checked="1">
                    <div class="tab-content" bis_skin_checked="1">
                        <div class="tab-pane active show" id="personalDetails" role="tabpanel" bis_skin_checked="1">
                            <form action="{{ route('student.update', $student->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="row justify-content-between align-items-end">
                                    <input type="hidden" value="{{ $student->id }}" name="id" id="id">
                                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="">First Name <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $student->first_name }}" placeholder="First name">
                                        </div>
                                        @error('first_name')
                                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="">Last Name <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $student->last_name }}" placeholder="Last name">
                                        </div>
                                        @error('last_name')
                                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="">Other Name </label>
                                            <input type="text" class="form-control" name="other_name" id="other_name" value="{{ $student->other_name }}" placeholder="Other name">
                                        </div>
                                        @error('other_name')
                                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="">Select Guardian  <i class="text-danger">*</i></label>
                                            <select class="select2 form-select" name="guardian_id" id="guardian_id" >
                                                <option value="">Select Guardian</option>
                                                @foreach ($guardians as $row)
                                                <option value="{{ $row->id }}" {{ $row->id == $student->guardian_id ? 'selected' : '' }} > {{ ucfirst($row->name) }} ({{ $row->email }}) </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('guardian_id')
                                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="">Select Class Category  <i class="text-danger">*</i></label>
                                            <select class="form-select" name="class_category_id" id="class_category_id" >
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $row)
                                                <option value="{{ $row->id }}" {{ $row->id == $student->class_category_id ? 'selected' : '' }} > {{ $row->name }} </option>
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
                                            <select class="form-select" name="class_id" id="class_id" >
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $row)
                                                <option value="{{ $row->id }}" {{ $row->id == $student->class_id ? 'selected' : '' }} > {{ $row->name }} </option>
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
                                                <option value="{{ $row->name }}" {{ $row->name == $student->wing ? 'selected' : '' }} > {{ $row->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('wing')
                                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4" id="session_div">
                                        <div class="form-group">
                                            <label for="">Select Session  <i class="text-danger">*</i></label>
                                            <select class="form-select" name="session_id" id="session_id" >
                                                <option value="">Select Session</option>
                                                @foreach ($sessions as $row)
                                                <option value="{{ $row->id }}" {{ $row->id == $student->session_id ? 'selected' : '' }} > {{ $row->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('session_id')
                                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="">Select Gender  <i class="text-danger">*</i></label>
                                            <select class="select2 form-select" name="gender" id="gender" >
                                                <option value="">Select Guardian</option>
                                                <option value="male" {{ 'male' == $student->gender ? 'selected' : '' }} > Male </option>
                                                <option value="female" {{ 'female' == $student->gender ? 'selected' : '' }} > Female </option>
                                            </select>
                                        </div>
                                        @error('gender')
                                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @if ($student->category > 0 || $student->class_category_id == 4)
                                    <div class="col-lg-6 col-sm-6 mb-3" id="category" style="display:" >
                                        <label for="">Category</label>
                                        <select name="category" id="category" class="form-select">
                                            <option value="">Select Category</option>
                                            @foreach ($category as $row)
                                            <option value="{{ $row->id }}" {{ $student->category == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @endif

                                    {{-- <div class="col-lg-6 col-md-6 col-sm-12 mb-4" id="admission_div">
                                        <div class="form-group">
                                            <label for="">Admission Number <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" name="admission_no" id="admission_no" value="{{ old('admission_no') }}" placeholder="Enter Student Admission No">
                                            <input type="text" class="form-control text-muted" readonly name="admission_no" id="admission_no_generate" value="111111111" placeholder="Admission No">
                                        </div>
                                        @error('admission_no')
                                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                        @enderror
                                    </div> --}}

                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="">Address <i class="text-danger">*</i></label>
                                            <textarea type="text" class="form-control" name="address" id="address" placeholder="Address">{{ $student->address }}</textarea>
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
                                                <option value="{{ $row->id }}" {{ $row->id == $student->state_id ? 'selected' : '' }} > {{ $row->name }} </option>
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
                                                <option value="{{ $row->id }}" {{ $row->id == $student->lga_id ? 'selected' : '' }} > {{ $row->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('lga_id')
                                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-lg-12" bis_skin_checked="1">
                                        <div class="hstack gap-2 justify-content-end" bis_skin_checked="1">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="{{ route('student.index') }}" class="btn btn-soft-success">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel" bis_skin_checked="1">
                            <form action="javascript:void(0);">
                                <div class="row g-2" bis_skin_checked="1">
                                    <div class="col-lg-4" bis_skin_checked="1">
                                        <div bis_skin_checked="1">
                                            <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                            <input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4" bis_skin_checked="1">
                                        <div bis_skin_checked="1">
                                            <label for="newpasswordInput" class="form-label">New Password*</label>
                                            <input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4" bis_skin_checked="1">
                                        <div bis_skin_checked="1">
                                            <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                            <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12" bis_skin_checked="1">
                                        <div class="text-end" bis_skin_checked="1">
                                            <button type="submit" class="btn btn-success">Change Password</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

</div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        document.getElementById('status-switch').addEventListener('change', function () {
            const statusInput = document.getElementById('status');
            statusInput.value = this.checked ? '1' : '0';
        });
        $(document).ready(function(){
            $('#class_category_id').change(function(){
                var category = $('#class_category_id').val();
                if(category == 4){
                    $('#category').show();
                }else{
                    $('#category').hide();
                }
            });
        });
    </script>

@endsection
