<x-admin.layout>
    <x-slot name="title">Receipts</x-slot>
    <x-slot name="pageHeading">All Receipts</x-slot>
    <div class="card card-radius-20 mb-5">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col">SN.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Contact No</th>
                            <th scope="col">Receipt No</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($customers->count())
                            @foreach ($customers as $key => $customer)
                                <tr>
                                    <td scope="col">{{ $key+1 }}</td>
                                    <td scope="col"><a href="{{route('receipts.show', $customer->id)}}">{{ $customer->name }}</a></td>
                                    <td scope="col">{{ $customer->address }}</td>
                                    <td scope="col">{{ $customer->contact_no }}</td>
                                    @php
                                        $receipts = $customer->receipts();
                                        if (isset($receipt_no) && $receipt_no)
                                            $receipts = $receipts->where('receipt_no', $receipt_no);
                                        $receipts = $receipts->get();
                                        $receiptNos = collect([]);
                                    @endphp
                                    <td scope="col">
                                        <ol type="A">
                                            @foreach ($receipts as $key => $receipt)
                                            @php
                                                $receiptNo = $receipt->receipt_no;
                                            @endphp
                                                @if (!$receiptNos->containsStrict($receiptNo))
                                                    <li><a href="{{$receipt->getReceiptUrl($receiptNo)}}" target="_blank">{{$receiptNo }}</a></li>
                                                    @if ($key >= 2)
                                                        <a href="" class="float-right">...More</a>
                                                        @break
                                                    @endif
                                                    @php
                                                    $receiptNos->push($receiptNo);
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </ol>
                                    </td>
                                    @php
                                        $receiptNos = collect([]);
                                    @endphp
                                    <td scope="col">
                                        <ol type="A">
                                            @foreach ($receipts as $key => $receipt)
                                            @php
                                                $receiptNo = $receipt->receipt_no;
                                            @endphp
                                                @if (!$receiptNos->containsStrict($receiptNo))
                                                    <li><a href="">{{$receipt->created_at}}</a></li>
                                                    @if ($key >= 2)
                                                        <a href="" class="float-right">...More</a>
                                                        @break
                                                    @endif
                                                    @php
                                                    $receiptNos->push($receiptNo);
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </ol>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td scope="col" colspan="8">No Customers found.</td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin.layout>
