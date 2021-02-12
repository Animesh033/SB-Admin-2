{{-- <x-admin.layout>
    <x-slot name="title">Receipts</x-slot>
    <x-slot name="pageHeading">All Receipts</x-slot>
    <div class="card card-radius-20 mb-5">
        <div class="card-body"> --}}
<style>
    table{margin-top: 5px;width:100%; text-align:center; color:#e60606; border: 1px solid red; border-collapse: collapse;}
    th, p{text-align:center;}
    td {border: 1px solid red;;}
    #address p{text-align:left;}
    .hr{border: 1px solid red; margin: 20px 0;}
    .pdf-footer{padding-top: 15px;}
</style>

<div style="text-align: center; color: red; height: auto;">
    <div style="float:left; width:25%;">
        <h5 style="">GSTIN - 84703589847097</h5>
    </div>
    <div style="float:left; width:50%;">
        <h5 style="">TAX INVOICE</h5>
    </div>
    <div style="float:right; width:25%;">
        <h5 style="">M: 7767985032</h5>
    </div>
    <div style="clear: both;"></div>
    <div>
        <h3 style="border-bottom: 1px sold red;">M/s. SHREE LAMINATES</h3>
        <h5>Plot No: 136, Small Factory Area, Bagadganj, Nagpur 440008</h5>
        <div style="float: left;">Bill No: {{  isset($receiptNo) ? $receiptNo : '1' }}</div>
        <div style="float: right;">Date: {{ isset($receiptDate) ? $receiptDate: now()->format('d-m-Y') }}</div>
        <div style="clear:both;"></div>
        <div id="address">
        <p>To: {{ $customer->name }}</p>
        <p>Address: {{ $customer->address }}</p>
        <p>Mobile No: {{ $customer->contact_no }}</p>
        </div>
    </div>
</div>
<div class="hr"></div>
<div class="table-responsive">
    <table class="table table-bordered" style="">
        <thead>
            <tr style="background: #e60606; color: #FFFFFF">
                <th scope="col">Sr No.</th>
                {{-- <th scope="col">Name</th> --}}
                {{-- <th scope="col">Address</th> --}}
                {{-- <th scope="col">Contact No</th> --}}
                {{-- <th scope="col">Receipt No</th> --}}
                <th scope="col">Description</th>
                <th scope="col">HSN Code</th>
                <th scope="col">Qty</th>
                <th scope="col">Rate</th>
                <th scope="col">Taxable Value</th>
            </tr>
        </thead>
        <tbody>
            @if ($receipts->count())
                @foreach ($receipts as $key => $receipt)
                    <tr>
                        <td scope="col">{{ $key+1 }}</td>
                        {{-- <td scope="col"><a href="{{route('receipts.show', $receipt->customer_id)}}" style="color: red;">{{ $receipt->customer->name }}</a></td> --}}
                        {{-- <td scope="col">{{ $receipt->customer->address }}</td> --}}
                        {{-- <td scope="col">{{ $receipt->customer->contact_no }}</td> --}}
                        {{-- <td scope="col"><a href="{{ $receipt->getReceiptUrl($receipt->receipt_no) }}" target="_blank" style="color: red;">{{ $receipt->receipt_no }}</a></td> --}}
                        {{-- <td scope="col">{{ $receipt->created_at }}</td> --}}
                        <td scope="col">{{ $receipt->description }}
                        <td scope="col">{{ $receipt->hsn_code }}
                        <td scope="col">{{ $receipt->qty }}
                        <td scope="col">{{ $receipt->rate }}
                        <td scope="col">{{ $receipt->taxable_value }}
                    </tr>
                @endforeach
                    <tr>
                        <td scope="col" colspan="2" rowspan="6" style="padding: 5px 10px;">
                            <p>Bank Details: Kotak Mahindra Bank</p>
                            <p>Account No: - IFSC Code:</p>
                            <p style="text-align: justify;">Amount of Tax Subject to Reverse Charge <span style="text-decoration: underline;">aalballa</span> </p>
                            <p style="text-align: justify;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </td>
                        <td scope="col" colspan="3">Transaction Packing Charge</td>
                        <td scope="col" colspan="1">5</td>
                    </tr>
                    <tr>
                        <td scope="col" colspan="3">Total of Taxable Value</td>
                        <td scope="col" colspan="1">1000</td>
                    </tr>
                    <tr>
                        <td scope="col" colspan="3">S-GST% 9</td>
                        <td scope="col" colspan="1"></td>
                    </tr>
                    <tr>
                        <td scope="col" colspan="3">C-GST% 9</td>
                        <td scope="col" colspan="1"></td>
                    </tr>
                    <tr>
                        <td scope="col" colspan="3"></td>
                        <td scope="col" colspan="1"></td>
                    </tr>
                    <tr>
                        <td scope="col" colspan="3">G. Total Rs.</td>
                        <td scope="col" colspan="1"></td>
                    </tr>
            @else
                <td scope="col" colspan="8">No Receipts found.</td>
            @endif
        </tbody>
    </table>
    <div class="hr"></div>
    <div class="pdf-footer">
        <div style="float:left; width:50%;">
            <label style="">Receiver's Signature</label>
        </div>
        <div style="float:right; width:50%;">
            <label style="">For M/s. SHREE LAMINATES</label>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>

{{-- </div>
    </div>
</x-admin.layout> --}}
