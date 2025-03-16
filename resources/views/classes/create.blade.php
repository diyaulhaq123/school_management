@extends('layouts.master')
@section('title')
Classes
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Classes @endslot
@slot('title') Add Class  @endslot
@endcomponent

<div class="card p-4">
    <div class="card-body">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form action="{{ route('classes.store') }}" method="post">
                @csrf
                <div class="row justify-content-between align-items-end">

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                            <label for="">Class Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Name">
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
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
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
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Save</button>
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
