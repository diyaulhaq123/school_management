<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ URL::asset('build/js/plugins.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}', 'Warning');
        </script>
    @endforeach
@endif

@if (session()->has('error'))
<script>
    toastr.error('{{ session()->get('error') }}.', 'Error');
</script>
@endif

@if (session()->has('success'))
    <script>
            toastr.success('{{ session()->get('success') }}', 'Success');
    </script>
@endif

    <script>
        $('#state_id').change(function(){
            var state_id = $(this).val();
            if(state_id){
                $.ajax({
                    url: '/api/get-lgas/' + state_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#lga_id').empty();

                        $('#lga_id').append('<option value="">Select LGA</option>');

                        $.each(data, function(key, value){
                            $('#lga_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            } else {
                $('#lga_id').empty();
                $('#lga_id').append('<option value="">Select LGA</option>');
            }
        });

        $('#class_category_id').change(function(){
            var class_category_id = $(this).val();
            if(class_category_id){
                $.ajax({
                    url: '/api/get-class/' + class_category_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#class_id').empty();

                        $('#class_id').append('<option value="">Select Class</option>');

                        $.each(data, function(key, value){
                            $('#class_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            } else {
                $('#class_id').empty();
                $('#class_id').append('<option value="">Select Class</option>');
            }
        });

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

@yield('script')
@yield('script-bottom')

