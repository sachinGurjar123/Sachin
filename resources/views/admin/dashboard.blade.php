@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header',[
    'title'=> __('header.dashboard'),
    'breadcrumbs'=> Breadcrumbs::render('admin.dashboard')
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-12">
                    <!--begin::Mixed Widget 2-->
                    <div class="card">
                        <!--begin::Body-->
                        <div class="card-body p-0 ">
                            <!--begin::Stats-->
                            <div class="card-p mt-20 position-relative">
                                <!--begin::Row-->
                                <div class="row g-0">
                                    <!--begin::Col-->
                                    <div class="col bg-light-primary px-10 py-10 rounded-2 me-7 mb-7">
                                        <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->
                                        <span class="svg-icon svg-icon-4x svg-icon-primary d-block my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                                <path
                                                    d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path
                                                    d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                            </svg>
                                            <h4 class="text-white fw-bold fs-6"><span class="new_users">0</span>
                                            </h4>
                                        </span>
                                        <!--end::Svg Icon-->

                                        <a href=" {{ route('admin.users.index') }}"
                                            class="text-primary fw-bold fs-6">{{ trans_choice('content.dashboard_cards.new_users', 1) }}</a>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col bg-light-primary px-10 py-10 rounded-2 me-7 mb-7">
                                        <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->
                                        <span class="svg-icon svg-icon-4x svg-icon-primary d-block my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <path
                                                        d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path
                                                        d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                        fill="#000000" fill-rule="nonzero" />
                                                </g>
                                            </svg>
                                            <h4 class="text-white fw-bold fs-6"><span class="total_clients">0</span>
                                            </h4>
                                        </span>
                                        <!--end::Svg Icon-->

                                        <a href="{{ route('admin.users.index') }}"
                                            class="text-primary fw-bold fs-6">{{ trans_choice('content.dashboard_cards.total_clients', 1) }}</a>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col bg-light-warning px-10 py-10 rounded-2 me-7 mb-7">
                                        <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->
                                        <span class="svg-icon svg-icon-4x svg-icon-warning d-block my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                                        rx="1.5" />
                                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
                                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
                                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
                                                </g>
                                            </svg>
                                            <h4 class="text-white fw-bold fs-6 ">₭ <span class="yearly_sales_count">0</span>
                                            </h4>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <a href="#"
                                            class="text-white fw-bold fs-6">{{ trans_choice('content.dashboard_cards.yearly_sales', 1) }}</a>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->

                                    <!--end::Col-->

                                    <!--begin::Col-->

                                    <!--end::Col-->

                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->

                                <!--end::Row-->
                                <!--begin::Row-->

                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Mixed Widget 2-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Post-->
@endsection

@push('scripts')
    <script>
        function dashboard() {
            $.ajax({
                    url: `{{ route('admin.dashboard-counts') }}`,
                    type: "get",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                })
                .done(function(response) {
                    console.log(response);
                    $('.new_users').text(response.data.new_users);
                    $('.total_clients').text(response.data.total_clients);
                    $('.yearly_sales_count').text(response.data.yearly_sales_count);

                    $('.total_vendors').text(response.data.total_vendors);

                    $('.total_purchase').text(response.data.total_purchase);

                    $('.total_unpaid_bill').text(response.data.total_unpaid_bill);
                    $('.total_unrecieved_bill').text(response.data.total_unrecieved_bill);
                    $('.total_unrecieved_amount').text((response.data.total_unrecieved_amount).toLocaleString());

                    $('.total_dept_balance').text((response.data.total_dept_balance).toLocaleString());
                    $('.total_asset').text(response.data.total_asset);
                })
                .fail(function() {
                    Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                });
        }
        dashboard();
    </script>
@endpush
