@extends('layouts.master')
@section('title')
Terms
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Term  @endslot
@endcomponent

<div class="row">

    <div class="card p-4">
        <div class="card-header">
            <a class="btn btn-primary float-end" href="#" > <i class="ri-add-circle-line"></i> Add Term</a>
        </div>
        <div class="card-body">
            <div class="card-title fw-bold">Terms</div>
           <div class="row justify-content-center">
            <div class="col-10">
                <div class="table table-responsive">
                    <table class="table">
                        <thead>
                            @foreach ($terms as $row)
                            <tr>
                                <input type="hidden" value="{{ $row->id }}" name="id" id="id">
                                <th style="font-size:15px">
                                        <a class="text-dark" href="{{ route('terms.edit', $row->id) }}" >
                                        {{ $row->name }}
                                    </a> {{ $row->status == 1 ? '- (Current)' : '' }}
                                </th>
                                <th class="float-end">
                                    <div class="form-check form-switch mb-2" bis_skin_checked="1">
                                        <input class="form-check-input" type="checkbox" {{ $row->status == 1 ? 'checked' : '' }} role="switch" id="status-switch">
                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                    </div>
                                </th>
                            </tr>
                            @endforeach
                        </thead>
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

                // If checked, uncheck all other checkboxes
                if (isChecked) {
                    $('.form-check-input').not(this).prop('checked', false); // Uncheck all except the current one
                }

                // Send the AJAX request
                const url = `/toogle-term/${id}`;
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
