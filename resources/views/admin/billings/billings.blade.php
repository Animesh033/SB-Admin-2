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
                    </tr>
                </thead>
                <tbody>
                    @if ($customers->count())
                        @foreach ($customers as $key => $customer)
                            <tr>
                                <td scope="col">{{ $key+1 }}</td>
                                <td scope="col"><a href="{{route('dashboard')}}">{{ $customer->name }}</a></td>
                                <td scope="col">{{ $customer->address }}</td>
                                <td scope="col">{{ $customer->contact_no }}</td>
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