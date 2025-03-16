@extends('layouts.master')
@section('title')
Subject Allocations
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Add Subject Allocations  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <a class="btn btn-primary float-end" href="{{ route('subject-allocations.index') }}" > <i class="ri-arrow->left-line"></i> Back</a>
        </div>
        <div class="card-body">
            <div class="card-title fw-bold">Create Subject Allocations</div>
           <div class="row justify-content-center">
            <div class="col-8 mt-2">
                <form action="{{ route('subject-allocations.store') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="">Staff Information</label>
                            <select name="staff_id" id="staff_id" class="form-select">
                                <option value="">Select Staff</option>
                                @foreach ($staffs as $row)
                                <option value="{{ $row->id }}" {{ old('staff_id') == $row->id ? 'selected' : '' }} >{{ ucfirst($row->name) }} - {{ $row->email }}</option>
                                @endforeach
                            </select>
                            @error('staff_id')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3">
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
                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="">Wing</label>
                            <select name="wing" id="wing" class="form-select">
                                <option value="">Select Wing</option>
                                @foreach ($wings as $row)
                                <option value="{{ $row->name }}" {{ old('wing') == $row->name ? 'selected' : '' }}>{{ $row->name }} </option>
                                @endforeach
                            </select>
                            @error('class_id')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="">Subject</label>
                            <select name="subject_id" id="subject_id" class="form-select">
                                <option value="">Select Subject</option>
                                {{-- @foreach ($subjects as $row)
                                <option value="{{ $row->id }}" {{ old('subject_id') == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                @endforeach --}}
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
                            <div class="float-end">
                                <button class="btn btn-warning" type="reset">Reset</button>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
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
    {{-- <script>

    </script> --}}
@endsection
