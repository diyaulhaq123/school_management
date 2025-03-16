@extends('layouts.master')
@section('title')
Subject Allocations
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Update Subject Allocations  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <a class="btn btn-primary float-end" href="{{ route('subject-allocations.index') }}" > <i class="ri-arrow->left-line"></i> Back</a>
        </div>
        <div class="card-body">
            <div class="card-title fw-bold">Update Subject Allocations</div>
           <div class="row justify-content-center">
            <div class="col-8 mt-2">
                <form action="{{ route('subject-allocations.update', $subjectAllocation->id) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" id="id" value="{{ $subjectAllocation->id }}">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="">Staff Information</label>
                            <select name="staff_id" id="staff_id" class="form-select">
                                <option value="">Select Staff</option>
                                @foreach ($staffs as $row)
                                <option value="{{ $row->id }}" {{ $subjectAllocation->staff_id == $row->id ? 'selected' : '' }} >{{ ucfirst($row->name) }} - {{ $row->email }}</option>
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
                                <option value="{{ $row->id }}" {{ $subjectAllocation->class_id == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
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
                                <option value="{{ $row->name }}" {{ $subjectAllocation->wing == $row->name ? 'selected' : '' }}>{{ $row->name }} </option>
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
                                @foreach ($subjects as $row)
                                <option value="{{ $row->id }}" {{ $subjectAllocation->subject_id == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
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
                                <option value="{{ $row->id }}" {{ $subjectAllocation->session_id == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
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
                                <option value="{{ $row->id }}" {{ $subjectAllocation->term_id == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                @endforeach
                            </select>
                            @error('term_id')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mt-3">
                            <button class="btn btn-primary float-end" type="submit">Update</button>
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
        $('#class_id').change(function(){
            var class_id = $(this).val();
            if(class_id){
                $.ajax({
                    url: '/api-subjects/' + class_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#subject_id').empty();

                        $('#subject_id').append('<option value="">Select Subject</option>');

                        $.each(data, function(key, value){
                            $('#subject_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            } else {
                $('#subject_id').empty();
                $('#subject_id').append('<option value="">Select Subject</option>');
            }
        });
    </script>

@endsection
