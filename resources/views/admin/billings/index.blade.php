<x-admin.layout>
    <x-slot name="title">All Quotation</x-slot>
    <x-slot name="pageHeading">All Quotations</x-slot>
    <x-slot name="generateReport">
        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  href="#" data-toggle="modal" data-target="#generateQuotationModal"><i class="fas fa-download fa-sm text-white-50"></i>Generate Quotation</a>
    </x-slot>
    {{-- <div class="card card-radius-20">
        <div class="card-body"> --}}
            @include('admin.billings.billings-pdf')
        {{-- </div>
    </div> --}}
    <!-- Modal-->
    <x-modal :modalHeader="true" :modalFooter="true" :modalId="__('generateQuotationModal')">
        <x-slot name="modalTitle">Ready to download the Quotation?</x-slot>
        <x-slot name="modalBody">
            <form method="POST" action="{{ route('billings.generate') }}" id="quotation-form">
                @csrf
                <div class="container d-flex justify-content-center">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="">Select Date:</label>
                            <div class="input-group mb-3">
                                <input type="text" id="quotation-date" name="quotation_date" class="form-control input-text" placeholder="MM/DD/YY">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-warning" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </div>
                            </div>
                             <button class="btn btn-outline-warning" type="submit">Generate</button>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    @push('styles')
        <link rel="stylesheet" type="text/css" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569462035/datedropper.min.css">
    @endpush
    @push('scripts')
    <!-- Datepicker -->
    <script type="text/javascript" src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569462035/datedropper.min.js"></script>
    <script>
        $(function() {
            $("#quotation-date").dateDropper({
                animate: true,
                init_animation: "fadein",
                format: "m/d/Y",
                lang: "en",
                lock: false,
                minYear: 1970,
                yearsRange: 10,

                //CSS PRIOPRIETIES
                dropPrimaryColor: "#01CEFF",
                dropTextColor: "#333333",
                dropBackgroundColor: "#FFFFFF",
                dropBorder: "1px solid #08C",
                dropBorderRadius: 8,
                dropShadow: "0 0 10px 0 rgba(0, 136, 204, 0.45)",
                dropWidth: 124,
                dropTextWeight: 'bold'
            });

            $('#quotation-form').submit(function() {
                $('#generateQuotationModal').modal('hide');
            });

            // show the alert
            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);

        });
    </script>
    @endpush
</x-admin.layout>
