@extends('layouts.master')
@section('title')
Classes
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Page @endslot
@slot('title') Edit/View Classes  @endslot
@endcomponent

<div class="card p-4">
    <div class="card-body">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form action="{{ route('classes.update', $class->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row justify-content-between align-items-end">
                    <input type="hidden" name="id" id="id" value="{{ $class->id }}">

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Class Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $class->name }}" placeholder="Name">
                        </div>
                        @error('name')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <label for="">Class category</label>
                        <select name="class_category_id" id="class_category_id" class="form-select">
                            <option value="">Select Class Category</option>
                            @foreach ($class_categories as $row)
                            <option value="{{ $row->id }}" {{ $class->class_category_id == $row->id ? 'selected' : '' }}  >{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('class_category_id')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-select">
                            <option value="">Select Status</option>
                            <option value="1" {{ $class->status == 1 ? 'selected' : '' }} >Active</option>
                            <option value="0" {{ $class->status == 0 ? 'selected' : '' }} >Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit" id="save">Save</button>
                        <a href="{{ route('classes.index') }}" class="btn btn-danger" >Back</a>
                    </div>
                </div>
            </form>
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

@endsection
