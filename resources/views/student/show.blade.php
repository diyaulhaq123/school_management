@extends('layouts.master')
@section('title')
Student
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Student Record  @endslot
@endcomponent


<div class="container-fluid" bis_skin_checked="1">
    <div class="profile-foreground position-relative mx-n4 mt-n4" bis_skin_checked="1">
        <div class="profile-wid-bg" bis_skin_checked="1">
            <img src="build/assets/images/profile-bg.jpg" alt="" class="profile-wid-img">
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper" bis_skin_checked="1">
        <div class="row g-4" bis_skin_checked="1">
            <div class="col-auto" bis_skin_checked="1">
                <div class="avatar-lg" bis_skin_checked="1">
                    <img src="{{ asset('build/images/avatar.jpeg') }}" alt="user-img" class="img-thumbnail rounded-circle">
                </div>
            </div>
            <!--end col-->
            <div class="col" bis_skin_checked="1">
                <div class="p-2" bis_skin_checked="1">
                    <h3 class="text-white mb-1">{{ $student->last_name.' '.$student->first_name.' '.$student->other_name }}</h3>
                    <p class="text-white text-opacity-75">Student</p>
                    <div class="hstack text-white-50 gap-1" bis_skin_checked="1">
                        <div class="me-2" bis_skin_checked="1"><i class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ $student->class_category->name ?? '' }}</div>
                        <div bis_skin_checked="1">
                            <i class="ri-building-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ $student->class->name ?? '' }}
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-12 col-lg-auto order-last order-lg-0" bis_skin_checked="1">
                <div class="row text text-white-50 text-center" bis_skin_checked="1">
                    <div class="col-lg-6 col-4" bis_skin_checked="1">
                        <div class="p-2" bis_skin_checked="1">
                            <h4 class="text-white mb-1">{{ $student->studentSessions($student->id) }}</h4>
                            <p class="fs-14 mb-0">Sessions</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->

        </div>
        <!--end row-->
    </div>

    <div class="row" bis_skin_checked="1">
        <div class="col-lg-12" bis_skin_checked="1">
            <div bis_skin_checked="1">
                <div class="d-flex profile-wrapper" bis_skin_checked="1">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab" aria-selected="true">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Overview</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#projects" role="tab" aria-selected="false" tabindex="-1">
                                <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Results/Grades</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab" aria-selected="false" tabindex="-1">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Documents/Payments</span>
                            </a>
                        </li>
                    </ul>
                    @can('edit-student')
                    <div class="flex-shrink-0" bis_skin_checked="1">
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                    </div>
                    @endcan
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted" bis_skin_checked="1">
                    <div class="tab-pane active show" id="overview-tab" role="tabpanel" bis_skin_checked="1">
                        <div class="row" bis_skin_checked="1">
                            <div class="col-xxl-12" bis_skin_checked="1">
                                <div class="card" bis_skin_checked="1">
                                    <div class="card-body" bis_skin_checked="1">

                                        <h5 class="card-title mb-3">About</h5>

                                        <div class="row" bis_skin_checked="1">
                                            <div class="col-6 col-md-4" bis_skin_checked="1">
                                                <div class="d-flex mt-4" bis_skin_checked="1">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3" bis_skin_checked="1">
                                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary" bis_skin_checked="1">
                                                            <i class="ri-user-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden" bis_skin_checked="1">
                                                        <p class="mb-1">Name (Last - First - Middle/Other) :</p>
                                                        <h6 class="text-truncate mb-0">{{ $student->last_name.' '.$student->first_name.' '.$student->other_name }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-6 col-md-4" bis_skin_checked="1">
                                                <div class="d-flex mt-4" bis_skin_checked="1">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3" bis_skin_checked="1">
                                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary" bis_skin_checked="1">
                                                            <i class="ri-graduation-cap-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden" bis_skin_checked="1">
                                                        <p class="mb-1">Admission No :</p>
                                                        <h6 class="text-truncate mb-0">{{ $student->admission_no }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->


                                            <div class="col-6 col-md-4" bis_skin_checked="1">
                                                <div class="d-flex mt-4" bis_skin_checked="1">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3" bis_skin_checked="1">
                                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary" bis_skin_checked="1">
                                                            <i class="ri-user-2-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden" bis_skin_checked="1">
                                                        <p class="mb-1">Guardian Name :</p>
                                                        <h6>{{ $student->guardian->name ?? '' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-6 col-md-4" bis_skin_checked="1">
                                                <div class="d-flex mt-4" bis_skin_checked="1">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3" bis_skin_checked="1">
                                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary" bis_skin_checked="1">
                                                            <i class="ri-book-2-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden" bis_skin_checked="1">
                                                        <p class="mb-1">Student Class :</p>
                                                        <h6>{{ $student->class->name ?? '' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-6 col-md-4" bis_skin_checked="1">
                                                <div class="d-flex mt-4" bis_skin_checked="1">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3" bis_skin_checked="1">
                                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary" bis_skin_checked="1">
                                                            <i class="ri-book-2-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden" bis_skin_checked="1">
                                                        <p class="mb-1">Student Class Wing :</p>
                                                        <h6>{{ $student->wing ?? '' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-6 col-md-4" bis_skin_checked="1">
                                                <div class="d-flex mt-4" bis_skin_checked="1">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3" bis_skin_checked="1">
                                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary" bis_skin_checked="1">
                                                            <i class="ri-flag-2-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden" bis_skin_checked="1">
                                                        <p class="mb-1">State :</p>
                                                        <h6>{{ $student->state->name ?? '' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-6 col-md-4" bis_skin_checked="1">
                                                <div class="d-flex mt-4" bis_skin_checked="1">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3" bis_skin_checked="1">
                                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary" bis_skin_checked="1">
                                                            <i class="ri-map-2-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden" bis_skin_checked="1">
                                                        <p class="mb-1">Local Government :</p>
                                                        <h6>{{ $student->lga->name ?? '' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-6 col-md-4" bis_skin_checked="1">
                                                <div class="d-flex mt-4" bis_skin_checked="1">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3" bis_skin_checked="1">
                                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary" bis_skin_checked="1">
                                                            <i class="ri-home-2-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden" bis_skin_checked="1">
                                                        <p class="mb-1">Home Address :</p>
                                                        <i>{{ $student->address ?? '' }}</i>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->

                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!-- end card -->

                                <div class="row" bis_skin_checked="1">
                                    <div class="col-lg-12" bis_skin_checked="1">
                                        <div class="card" bis_skin_checked="1">
                                            <div class="card-header align-items-center d-flex" bis_skin_checked="1">
                                                <h4 class="card-title mb-0  me-2">Recent Activity(Classes)</h4>
                                            </div>
                                            <div class="card-body" bis_skin_checked="1">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Class</th>
                                                                <th>Session</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($classes as $row)
                                                            <tr>
                                                                <td>#</td>
                                                                <td>{{ $row->class->name }}</td>
                                                                <td>{{ $row->session->name }}</td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td>#</td>
                                                                <td>{{ $student->class->name }}</td>
                                                                <td>{{ $student->session->name }}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
                                </div><!-- end row -->

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <div class="tab-pane fade" id="projects" role="tabpanel" bis_skin_checked="1">
                        <div class="card" bis_skin_checked="1">
                            <div class="card-body" bis_skin_checked="1">
                                <div class="row" bis_skin_checked="1">
                                    @foreach ($results as $result)
                                    <div class="col-lg-6 col-md-6 col-sm-6" bis_skin_checked="1">
                                        <div class="card profile-project-card shadow-none profile-project-success" bis_skin_checked="1">
                                            <div class="card-body p-4" bis_skin_checked="1">
                                                <div class="d-flex" bis_skin_checked="1">
                                                    <div class="flex-grow-1 text-muted overflow-hidden" bis_skin_checked="1">
                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">{{$result->class->name ?? '' }}</a></h5>
                                                        <p class="text-muted text-truncate mb-0">{{$result->session->name ?? '' }} </p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2" bis_skin_checked="1">
                                                        <div class="badge bg-primary-subtle text-primary fs-10" bis_skin_checked="1">Ready!</div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-4" bis_skin_checked="1">
                                                    <div class="flex-grow-1" bis_skin_checked="1">
                                                        <div class="d-flex align-items-center gap-2" bis_skin_checked="1">
                                                            <div bis_skin_checked="1">
                                                                <h5 class="fs-12 text-muted mb-0">{{$result->term->name ?? '' }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ route('get.result', [$student->id,$result->class_id,$result->session_id,$result->term_id]) }}" class="btn btn-primary btn-sm float-end">View Result <i class="ri-eye-fill"></i></a>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    @endforeach


                                    @if (!empty($result2))
                                    @foreach ($result2 as $result)
                                    <div class="col-lg-6 col-md-6 col-sm-6" bis_skin_checked="1">
                                        <div class="card profile-project-card shadow-none profile-project-success" bis_skin_checked="1">
                                            <div class="card-body p-4" bis_skin_checked="1">
                                                <div class="d-flex" bis_skin_checked="1">
                                                    <div class="flex-grow-1 text-muted overflow-hidden" bis_skin_checked="1">
                                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body">{{$result->class->name ?? '' }}</a></h5>
                                                        <p class="text-muted text-truncate mb-0">{{$result->session->name ?? '' }} </p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2" bis_skin_checked="1">
                                                        <div class="badge bg-primary-subtle text-primary fs-10" bis_skin_checked="1">Ready!</div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-4" bis_skin_checked="1">
                                                    <div class="flex-grow-1" bis_skin_checked="1">
                                                        <div class="d-flex align-items-center gap-2" bis_skin_checked="1">
                                                            <div bis_skin_checked="1">
                                                                <h5 class="fs-12 text-muted mb-0">{{$result->term->name ?? '' }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ route('get.result', [$student->id,$result->class_id,$result->session_id,$result->term_id]) }}" class="btn btn-primary btn-sm float-end">View Result <i class="ri-eye-fill"></i></a>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    @endforeach
                                    @endif

                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane fade" id="documents" role="tabpanel" bis_skin_checked="1">
                        <div class="card" bis_skin_checked="1">
                            <div class="card-body" bis_skin_checked="1">
                                <div class="d-flex align-items-center mb-4" bis_skin_checked="1">
                                    <h5 class="card-title flex-grow-1 mb-0">Documents & Payments</h5>
                                    <div class="flex-shrink-0" bis_skin_checked="1">
                                        <input class="form-control d-none" type="file" id="formFile">
                                        <label for="formFile" class="btn btn-danger"><i class="ri-upload-2-fill me-1 align-bottom"></i> Upload File</label>
                                    </div>
                                </div>
                                <div class="row" bis_skin_checked="1">
                                    <div class="col-lg-12" bis_skin_checked="1">
                                        <div class="table-responsive" bis_skin_checked="1">
                                            <table class="table table-borderless align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">File Name</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Payment Status</th>
                                                        <th scope="col">Session</th>
                                                        <th scope="col">Term</th>
                                                        <th scope="col">Transaction Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payments as $row)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center" bis_skin_checked="1">
                                                                {{-- <div class="avatar-sm" bis_skin_checked="1">
                                                                    <div class="avatar-title {{ $row->response == 'success' ?  'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} rounded fs-20" bis_skin_checked="1">
                                                                        <i class="ri-cash-fill"></i>
                                                                    </div>
                                                                </div> --}}
                                                                <div class="ms-3 flex-grow-1" bis_skin_checked="1">
                                                                    <h6 class="fs-15 mb-0">{{ 'Payment' }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $row->paymentType->name ?? '' }}</td>
                                                        <td>{{ number_format($row->amount, 2) ?? '' }}</td>
                                                        <td>{!! $row->response == 'success' ? '<span class="badge bg-success">Successful</span>' : '<span class="badge bg-danger">Not Paid</span>' !!}</td>
                                                        <td>{{ $row->session->name }}</td>
                                                        <td>{{ $row->term->name }}</td>
                                                        <td>{{ $row->created_at ? $row->created_at->format('Y-m-d') : '' }}</td>
                                                        <td>
                                                            @if($row->response == 'success')
                                                            <div class="dropdown" bis_skin_checked="1">
                                                                <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink15" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    <i class="ri-equalizer-fill"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink15">
                                                                    <li><a class="dropdown-item" href="{{ $row->id }}"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                                    {{-- <li class="dropdown-divider"></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li> --}}
                                                                </ul>
                                                            </div>
                                                            @else
                                                            <button class="btn btn-success btn-sm makePayment" type="button" style="font-size:"  id="makePayment" data-id="{{ $row->id }}" >Make Payment</button>
                                                            @endif
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
                    <!--end tab-pane-->
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

</div>


@endsection


{{-- @section('css')

@endsection --}}

@section('script')

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script type="text/javascript" src="https://sdk.monnify.com/plugin/monnify.js"></script>
    <script>

            // Monnify Payment Function
            // function payWithMonnify(payment) {
            //     MonnifySDK.initialize({
            //         amount: payment.amount, // Amount from the AJAX response
            //         currency: "NGN",
            //         reference: payment.ref_no, // Generate unique reference
            //         customerFullName: "{{ auth()->user()->name }}", // Pass from the AJAX response
            //         customerEmail: "{{ auth()->user()->email }}", // Pass from the AJAX response
            //         apiKey: "MK_TEST_LSB8PVX5N4",
            //         contractCode: "8676269291",
            //         paymentDescription: payment.payment_type_id, // Pass from the AJAX response
            //         metadata: {
            //             studentId: payment.student_id, // Pass from the AJAX response
            //         },
            //         onLoadStart: () => {
            //             console.log("Loading started...");
            //         },
            //         onLoadComplete: () => {
            //             console.log("SDK is ready.");
            //         },
            //         onComplete: function (response) {
            //             // Handle transaction success
            //             console.log("Transaction complete:", response);
            //             if (response.paymentStatus === "PAID") {
            //                 Swal.fire('Success', 'Payment completed successfully.', 'success');
            //             } else {
            //                 Swal.fire('Incomplete', 'Payment not completed.', 'warning');
            //             }
            //         },
            //         onClose: function (data) {
            //             // Handle modal close event
            //             console.log("Payment modal closed:", data);
            //         },
            //     });
            // }


        $(document).ready(function(){
            $('.makePayment').click(function () {
    var id = $(this).data('id');

    Swal.fire({
        text: "Do you want to complete payment for this student?",
        icon: "question",
        title: "Make Payment Online",
        showConfirmButton: true,
        confirmButtonText: 'Pay',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform an AJAX request to fetch payment details
            $.ajax({
                url: `make-payment/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        // Ensure paymentDescription is a string
                        var paymentDescription = data.payment.payment_type_id;
                        if (typeof paymentDescription !== 'string') {
                            paymentDescription = String(paymentDescription);
                        }

                        // Proceed with the payment
                        MonnifySDK.initialize({
                            amount: data.payment.amount,
                            currency: "NGN",
                            reference: data.payment.ref_no,
                            customerFullName: "{{ auth()->user()->name }}",
                            customerEmail: "{{ auth()->user()->email }}",
                            apiKey: "MK_TEST_LSB8PVX5N4",
                            contractCode: "8676269291",
                            paymentDescription: paymentDescription,
                            metadata: {
                                studentId: data.payment.student_id,
                            },
                            onComplete: function (response) {
                                if (response.paymentStatus === "PAID") {
                                    Swal.fire('Success', 'Payment completed successfully.', 'success');
                                } else {
                                    Swal.fire('Incomplete', 'Payment not completed.', 'warning');
                                }
                            },
                            onClose: function (data) {
                                console.log("Payment modal closed:", data);
                            },
                        });
                    } else {
                        Swal.fire('Error', 'Unable to fetch payment details.', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Something went wrong while fetching payment details.', 'error');
                }
            });
        }
    });
});


        });
    </script>


@endsection
