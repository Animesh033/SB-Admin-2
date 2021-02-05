<div class="table-responsive">
    <table class="table table-bordered text-center" style="width:100%;">
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
                <th scope="col" colspan="7" class="text-left">{{ isset($quotationDate) ? $quotationDate : now()->format('d/m/Y') }}</th>
            </tr>
            <tr>
                <th scope="col" colspan="1">NAME</th>
                <th scope="col" colspan="7" class="text-left">R/S MAHESH SIR, WADI, NAGPUR</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
                $quotationDate = isset($quotationDate) ? $quotationDate : null;
            @endphp
            @if ($categories->count())
                @foreach ($categories as $key => $category)
                    @if($category->hasBillingCount($quotationDate))
                        <tr>
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
                        @foreach ($category->getBillings($quotationDate) as $key => $bill)
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
            <tr>
                <th scope="col" colspan="7">GRAND TOTAL</th>
                <th scope="col" colspan="1">{{ $grandTotal }}</th>
            </tr>
            <tr>
                <th scope="col" colspan="8" class="text-left">
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
