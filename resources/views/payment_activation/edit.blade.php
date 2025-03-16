@extends('layouts.master')
@section('title')
Edit Payment Activation
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Payment Result  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header"></div>
        <div class="card-body">
            <div class="card-title fw-bold">Edit Payment Activation</div>
            <form action="{{ route('payment_activation.update', $paymentActivation->id) }}" method="post">
                @csrf
                @method('put')
                <input type="hidden" value="{{ $paymentActivation->id }}" name="id" id="id">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                        <label for="">Class category</label>
                        <select name="class_category_id" id="class_category_id" class="form-select">
                            <option value="">Select class category</option>
                            @foreach ($class_categories as $row)
                            <option value="{{ $row->id }}" {{ $paymentActivation->class_category_id == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('class_category_id')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                        <label for="">Classes</label>
                        <select name="class_id" id="class_id" class="form-select">
                            <option value="">Select class</option>
                            @foreach ($classes as $row)
                            <option value="{{ $row->id }}" {{ $paymentActivation->class_id == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('class_id')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                        <label for="">Sessions</label>
                        <select name="session_id" id="session_id" class="form-select">
                            <option value="">Select session</option>
                            @foreach ($sessions as $row)
                            <option value="{{ $row->id }}" {{ $paymentActivation->session_id == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('session_id')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                        <label for="">Terms</label>
                        <select name="term_id" id="term_id" class="form-select">
                            <option value="">Select term</option>
                            @foreach ($terms as $row)
                            <option value="{{ $row->id }}" {{ $paymentActivation->term_id == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('term_id')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                        <label for="">Payment Type</label>
                        <select name="payment_type_id" id="payment_type_id" class="form-select">
                            <option value="">Select Payment Type</option>
                            @foreach ($payment_types as $row)
                            <option value="{{ $row->id }}" {{ $paymentActivation->payment_type_id == $row->id ? 'selected' : '' }} >{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('payment_type_id')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                        <label for=""> Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control" value="{{ $paymentActivation->amount }}" placeholder="Enter Amount">
                        @error('amount')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <button class="btn btn-primary mt-2" type="submit">Save</button>
                        <a href="{{ route('payment_activation.index') }}" class="btn btn-danger mt-2" >Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
