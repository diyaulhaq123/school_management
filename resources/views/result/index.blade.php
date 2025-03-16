@extends('layouts.master')
@section('title')
Result Activations
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Result  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <form action="{{ route('result.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="">Classes</label>
                        <select name="class_id" id="class_id" class="form-select">
                            <option value="">Select class</option>
                            @foreach ($classes as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('class_id')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="">Sessions</label>
                        <select name="session_id" id="session_id" class="form-select">
                            <option value="">Select session</option>
                            @foreach ($sessions as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('session_id')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="">Terms</label>
                        <select name="term_id" id="term_id" class="form-select">
                            <option value="">Select term</option>
                            @foreach ($terms as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('term_id')
                        <span class="text-danger" style="font-size:12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <button class="btn btn-primary mt-2" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="card-title fw-bold">Result Activations</div>
           <div class="row justify-content-center">
            <div class="col-10">
                <div class="table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Session</th>
                                <th>Term</th>
                                <th>Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $index => $row)
                            <tr>
                                <input type="hidden" value="{{ $row->id }}" name="id" id="id">
                                <input type="hidden" value="{{ $row->status }}" name="status" id="status">
                                <td>{{ $index+1 }}</td>
                                <td > {{ $row->session->name ?? '' }} </td>
                                <td > {{ $row->term->name ?? '' }} </td>
                                <td > {{ $row->class->name ?? '' }} </td>
                                <td >
                                    <div class="btn-group">
                                        <div class="form-check form-switch mb-2" bis_skin_checked="1">
                                            <input class="form-check-input" type="checkbox" {{ $row->status == 1 ? 'checked' : '' }} role="switch" id="status-switch">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                        <a class="btn btn-info btn-sm" href="{{ route('result.edit', $row->id) }}" ><i class="ri ri-edit-fill"></i></a>
                                        </div>
                                        <form action="{{ route('result.destroy', $row->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" id="id">
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="ri-delete-bin-line"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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

        $(document).ready(function(){
            $('.form-check-input').change(function () {
                // Get the status of the checkbox that was toggled
                const isChecked = $(this).is(':checked');

                // Find the closest row and extract the ID
                const row = $(this).closest('tr');
                const id = row.find('input[name="id"]').val();
                const token = '{{ csrf_token() }}';
                const status = isChecked ? 1 : 0;

                // Send the AJAX request
                const url = `/toogle-activate-result/${id}`;
                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: {
                        _token: token,
                        id: id,
                        status: status,
                    },
                    success: function (response) {
                        // Handle success
                        if (response.message === 'success') {
                            toastr.success('Updated!', 'Success');
                        }
                    },
                    error: function (xhr) {
                        // Handle error
                        toastr.error('An error occurred!', 'Error');
                    }
                });
            });

        });

    </script>

@endsection
