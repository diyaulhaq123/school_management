<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management|Receipt</title>
    <!-- Layout config Js -->
    <script src="{{ asset('build/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container my-4 p-4 rounded">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12 border p-4">
                <!-- Header Section -->
                <div class="row align-items-center mb-4">
                    <div class="col-2 text-center">
                        <img src="{{ asset('build/images/companies/img-2.png') }}" alt="School Logo" class="img-fluid" style="max-height: 80px;">
                    </div>
                    <div class="col-8 text-center">
                        <h3 class="mb-0">School Name</h3>
                        <p class="mb-0">123 School Address, City, State</p>
                        <p class="mb-0">Phone: (123) 456-7890 | Email: info@school.com</p>
                    </div>
                    <div class="col-2"></div>
                </div>

                <!-- Receipt Details -->
                <h5 class="text-center mb-3">Payment Receipt</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Student Name:</strong> {{ $payment->student->last_name.' '.$payment->student->first_name.' '.$payment->student->other_name }}</p>
                        <p><strong>Guardian Name:</strong> {{ $payment->guardian->name }}</p>
                        <p><strong>Class:</strong> {{ $payment->class->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Term:</strong> {{ $payment->term->name }}</p>
                        <p><strong>Session:</strong> {{ $payment->session->name }}</p>
                        <p><strong>Date Paid:</strong> {{ $payment->created_at }}</p>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Type of Payment:</strong> {{ $payment->paymentType->name ?? '' }}</p>
                        <p><strong>Mode of Payment:</strong> {{ $payment->mode_of_payment == 1 ? 'Online Payment' : 'Offline Payment' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Amount:</strong> ₦ {{ number_format($payment->amount, 2) ?? '' }}</p>
                        <p><strong>Amount in Words:</strong> {{ $payment->amount_in_words ?? '' }}</p>
                    </div>
                </div>

                <!-- Signature Section -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <p><strong>Signature:</strong></p>
                        <div class="border rounded p-3" style="height: 50px;"></div>
                    </div>
                </div>

                <!-- Footer -->
                <p class="text-center mt-4">Thank you for your payment!</p>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
</body>
</html>
