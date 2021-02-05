<div class="table-responsive">
    <table class="table table-bordered" style="width:100%; text-align:center; color:#e60606;">
        <thead>
            <tr>
                <th scope="col" colspan="8">M/S SHREE LAMINATES</th>
            </tr>
            <tr>
                <th scope="col" colspan="8">PLOT NO. 136, SMALL FACTORY AREA, BAGADGANJ, NAGPUR-440008</th>
            </tr>
            <tr>
                <th scope="col" colspan="8">NIKUNJ KANERIYA - 8552920312 & PIYUSH TAUNK - 8669003459</th>
            </tr>
            <tr>
                <th scope="col" colspan="8">QUOTATION</th>
            </tr>
            <tr>
                <th scope="col" colspan="1">DATE</th>
                <th scope="col" colspan="7" style="text-align: left;">
                    @if(isset($billing_no) && $billing_no) 
                        {{ $categories[0]->billings[0]->created_at}}
                    @endif
                </th>
            </tr>
            <tr>
                <th scope="col" colspan="1">NAME</th>
                <th scope="col" colspan="7" style="text-align: left;">{{isset($customer) ? $customer->name : ''}}</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @if ($categories->count())
                @foreach ($categories as $key => $category)
                @php
                    $customerBillings = $category->billings();
                    if(isset($billing_no) && $billing_no)
                        $customerBillings = $customerBillings->wherePivot('billing_no', $billing_no);
                @endphp
                    @if ($customerBillings->count())
                        <tr style="background: #e60606; color: #FFFFFF">
                            <th scope="col" colspan="8">{{ $category->name }}</th>
                        </tr>
                        <tr>
                            <th scope="col">NO.</th>
                            <th scope="col">WIDTH</th>
                            <th scope="col">HEIGHT</th>
                            <th scope="col">SHUTTER</th>
                            <th scope="col">NET</th>
                            <th scope="col">SQ. FEET</th>
                            <th scope="col">RATE</th>
                            @if($key == 0)
                            <th scope="col">AMOUNT</th>
                            @else
                            <th scope="col"></th>
                            @endif
                        </tr>
                        @foreach ($customerBillings->get() as $key => $bill)
                        <tr>
                            <td scope="col">{{ $key+1 }}</td>
                            <td scope="col">{{ $bill->width }}</td>
                            <td scope="col">{{ $bill->height }}</td>
                            <td scope="col">{{ $bill->shutter }}</td>
                            <td scope="col">{{ $bill->net }}</td>
                            <td scope="col">{{ $bill->sq_feet }}</td>
                            <td scope="col">{{ $bill->rate }}</td>
                            <td scope="col">{{ $bill->amount }}</td>
                            @php $grandTotal += $bill->amount; @endphp
                        </tr>
                        @endforeach
                    @endif
                @endforeach
            @else
                <td scope="col" colspan="8">No Quotations found.</td>
            @endif
            <tr style="background:#e60606; color: #FFFFFF">
                <th scope="col" colspan="7" style="text-align: right;">GRAND TOTAL</th>
                <th scope="col" colspan="1">{{ format_amount($grandTotal) }}</th>
            </tr>
            <tr>
                <th scope="col" colspan="8" style="text-align: left;">
                    <ol>
                        <li>70% MUST BE ADVANCE PAYMENT</li>
                        <li>THIS QUOTATION VALID FOR 7 DAYS</li>
                        <li>TRANSPORATION COST WILL BE BEARED BY THE PARTY</li>
                        <li>G.S.T EXTRA 18%</li>
                    </ol>
                </th>
            </tr>
        </tbody>
    </table>
</div>
@push('styles')
<style>

</style>
@endpush
