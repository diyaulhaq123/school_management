@extends('layouts.master')
@section('title')
Subject Registration
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Add Subject Registration  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <a class="btn btn-primary float-end" href="{{ route('subject-registration.index') }}" > <i class="ri-arrow->left-line"></i> Back</a>
        </div>
        <div class="card-body">
            <div class="card-title fw-bold">Register Subjects for classes</div>
           <div class="row justify-content-center">
            <div class="col-8 mt-2">
                <form action="{{ route('subject-registration.store') }}" method="post">
                    @csrf

                    <div class="row">

                        <div class="col-lg-12 col-sm-12 mb-3" id="category">
                            <label for="">Class Category</label>
                            <select name="class_category_id" id="class_category_id" class="form-select">
                                <option value="">Select Class Category</option>
                                @foreach ($class_categories as $row)
                                <option value="{{ $row->id }}" {{ old('class_category_id') == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                @endforeach
                            </select>
                            @error('class_id')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3" >
                            <label for="">Classes</label>
                            <select name="class_id" id="class_id" class="form-select">
                                <option value="">Select Class</option>
                                @foreach ($classes as $row)
                                <option value="{{ $row->id }}" {{ old('class_id') == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                @endforeach
                            </select>
                            @error('class_id')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3" id="category" style="display: none">
                            <label for="">Category</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">Select Category</option>
                                <option value="science" {{  old('category') == 'science' ? 'selected' : ''  }} >Science</option>
                                <option value="arts" {{  old('arts') == 'arts' ? 'selected' : ''  }} >Arts</option>
                                <option value="socials" {{  old('socials') == 'socials' ? 'selected' : ''  }} >Socials</option>
                            </select>
                            @error('category')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="">Subject</label>
                            <select name="subject_id" id="subject_id" class="form-select">
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $row)
                                <option value="{{ $row->id }}" {{ old('subject_id') == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="">Session</label>
                            <select name="session_id" id="session_id" class="form-select">
                                <option value="">Select Session</option>
                                @foreach ($sessions as $row)
                                <option value="{{ $row->id }}" {{ old('session_id') == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                @endforeach
                            </select>
                            @error('session_id')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="">Term</label>
                            <select name="term_id" id="term_id" class="form-select">
                                <option value="">Select Term</option>
                                @foreach ($terms as $row)
                                <option value="{{ $row->id }}" {{ old('term_id') == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                @endforeach
                            </select>
                            @error('term_id')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mt-3">
                            <button class="btn btn-primary float-end" type="submit">Save Information</button>
                        </div>
                    </div>
                </form>
            </div>
           </div>
        </div>
    </div>

</div>

@endsection
@section('script')

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
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
