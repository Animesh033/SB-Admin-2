<x-admin.layout>
    <x-slot name="title">Customers</x-slot>
    <x-slot name="pageHeading">All Customers</x-slot>
    <div class="card card-radius-20">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col">SN.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Contact No</th>
                            <th scope="col">Quotation No</th>
                            <th scope="col">Date</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($customers->count())
                            @foreach ($customers as $key => $customer)
                                <tr>
                                    <td scope="col">{{ $key+1 }}</td>
                                    <td scope="col"><a href="{{route('customers.show', $customer->id)}}">{{ $customer->name }}</a></td>
                                    <td scope="col">{{ $customer->address }}</td>
                                    <td scope="col">{{ $customer->contact_no }}</td>
                                    @php
                                        $billings = $customer->billings();
                                        if (isset($billing_no) && $billing_no)
                                            $billings = $billings->wherePivot('billing_no', $billing_no);
                                        $billings = $billings->get();
                                        $billingNos = collect([]);
                                    @endphp
                                    <td scope="col">
                                        <ol type="A">
                                            @foreach ($billings as $key => $billing)
                                            @php
                                                $billingNo = $billing->pivot->billing_no;
                                            @endphp
                                                @if (!$billingNos->containsStrict($billingNo))
                                                    <li><a href="{{$billing->getQuotationPDFUrl($billingNo)}}" target="_blank">{{$billingNo }}</a></li>
                                                    @if ($key == 2)
                                                        <a href="" class="float-right">...More</a>
                                                        @break
                                                    @endif  
                                                    @php
                                                    $billingNos->push($billingNo);
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </ol>
                                    </td>
                                    @php
                                        $billingNos = collect([]);
                                    @endphp
                                    <td scope="col">
                                        <ol type="A">
                                            @foreach ($billings as $key => $billing)
                                            @php
                                                $billingNo = $billing->pivot->billing_no;
                                            @endphp
                                                @if (!$billingNos->containsStrict($billingNo))
                                                    <li><a href="">{{$billing->created_at}}</a></li>
                                                    @if ($key == 2)
                                                        <a href="" class="float-right">...More</a>
                                                        @break
                                                    @endif
                                                    @php
                                                    $billingNos->push($billingNo);
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td scope="col">{{ format_amount($customer->billings_sum_amount) }}</td>
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
