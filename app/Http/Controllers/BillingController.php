<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billings\Billing;
use App\Models\Billings\Customer;
use App\Http\Requests\StoreBillingRequest;
use App\Repositories\Eloquent\BillingRepositoryInterface;

class BillingController extends Controller
{
    private $billingRepository;

    public function __construct(BillingRepositoryInterface $billingRepository)
    {
        $this->billingRepository = $billingRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->billingRepository->getCategories();
        return view('admin.billings.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->billingRepository->getCategories();
        $customers = Customer::select('id', 'name')->get();
        return view('admin.billings.create', compact('categories', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillingRequest $request)
    {
        $this->billingRepository->store($request);
        return redirect()->back()->with('status', 'Quatation created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Billings\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function show(Billing $billing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Billings\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function edit(Billing $billing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Billings\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Billing $billing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Billings\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billing $billing)
    {
        //
    }
}
