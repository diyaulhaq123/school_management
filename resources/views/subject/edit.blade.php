@extends('layouts.master')
@section('title')
Subject
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Page @endslot
@slot('title') Edit/View Subject  @endslot
@endcomponent

<div class="card p-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <form action="{{ route('subject.update', $subject->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row justify-content-between align-items-end">
                        <input type="hidden" name="id" id="id" value="{{ $subject->id }}">

                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <div class="form-group">
                                <label for="">Subject Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $subject->name }}" placeholder="Name">
                            </div>
                            @error('name')
                            <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="">Class Category</label>
                            <select name="class_category_id" id="class_category_id" class="form-select">
                                <option value="">Select Class Category</option>
                                @foreach ($class_categories as $row)
                                <option value="{{ $row->id }}" {{ $subject->class_category_id == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                @endforeach
                            </select>
                            @error('class_category_id')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3" >
                            <label for="">Classes</label>
                            <select name="class_id" id="class_id" class="form-select">
                                <option value="">Select Class</option>
                                @foreach ($classes as $row)
                                <option value="{{ $row->id }}" {{ $subject->class_id == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                @endforeach
                            </select>
                            @error('class_id')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($subject->category > 0 )
                        <div class="col-lg-12 col-sm-12 mb-3" id="category" style="display:" >
                            <label for="">Category</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">Select Category</option>
                                @foreach ($categories as $row)
                                <option value="{{ $row->id }}" {{ $subject->category == $row->id ? 'selected' : '' }}>{{ $row->name }} </option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif

                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-select">
                                <option value="">Select Status</option>
                                <option value="1" {{ $subject->status == 1 ? 'selected' : '' }} >Activate</option>
                                <option value="0" {{ $subject->status == 0 ? 'selected' : '' }} >Deactivate</option>
                            </select>
                            @error('status')
                            <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" id="save">Save</button>
                            <a href="{{ route('subject.index') }}" class="btn btn-danger" >Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
                }else{
                    $('#category').hide();
                }
            });
        });

    </script>

@endsection
