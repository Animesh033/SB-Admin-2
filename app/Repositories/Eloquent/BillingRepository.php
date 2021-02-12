<?php

namespace App\Repositories\Eloquent;

use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Billings\Billing;
use App\Models\Billings\Category;
use App\Models\Billings\Customer;
use App\Models\Billings\Quotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\Eloquent\BillingRepositoryInterface;

class BillingRepository extends BaseRepository implements BillingRepositoryInterface
{

     protected $billing;

    public function __construct(Billing $billing)
    {
        $this->billing = $billing;
    }

    public function create(array $attributes): Model
    {
        return $this->billing->create($attributes);
    }

    public function find($id): ?Model
    {
        return $this->billing->find($id);
    }

    public function store(Request $request)
    {
        $inputData = $request->validated();

        if(!isset($request->customer_id)) {
            $customer = Customer::create($request->only('name', 'address', 'contact_no'));
            $customerId = $customer->id;
        }else{
            $customerId = $request->customer_id;
            $customer = Customer::findOrFail($customerId);
        }

        $inputData['customer_id'] = $customerId;

        $i = 0;
        $categoryIds = $request->category;
        $billingNo = now()->format('YmdHis');
        while($i < count($categoryIds)) {
            $category = Category::findOrFail($categoryIds[$i]);
            if($category) {
                $data = $this->formatInputBillingData($inputData, $i);
                $billing = $category->billings()->create($data);
                if ($billing ) {
                    $category->billings()->updateExistingPivot($billing->id, ['billing_no' => $billingNo]);
                    $customer->billings()->attach([$billing->id => ['billing_no' => $billingNo]]);
                }
            }
            $i++;
        }
        // $this->setQuotationDetailsInSession($request, $customerId, $billingNo, $categoryIds);
        $this->createBillingsPDF($customerId, $billingNo, $categoryIds);
    }

    public function getCategories(array $categoryIds=[])
    {
        $categories = Category::where('id', '>', 0);

        if (isset($categoryIds) && $categoryIds)
            $categories = $categories->whereIn('id', $categoryIds)->with('billings');

        return $categories->orderBy('name')->get();
    }

    public function formatInputBillingData($inputData, $i)
    {
        $totalAmountFormatted = $this->getTotalAmount($inputData, $i);

        $data = ['width' => $inputData['width'][$i], 'height' => $inputData['height'][$i],
                    'shutter' => $inputData['shutter'][$i], 'net' => $inputData['net'][$i],
                    'sq_feet' => $inputData['sq_feet'][$i], 'rate' => $inputData['rate'][$i],
                    'amount' => $totalAmountFormatted ];
        return $data;
    }

    public function getTotalAmount($inputData, $i) {
        $totalAmount = 0;
        $amount = (float) $inputData['sq_feet'][$i] * (float)$inputData['rate'][$i];
        $totalAmount = $amount + $amount*0.18;
        return format_amount($totalAmount);
    }

    public function createBillingsPDF($customerId=0, $billingNo='', $categoryIds=[]) {

        // $customerId = !isset($customerId) ? session('customer_id') : $customerId;
        // $billingNo = !isset($billingNo) ? session('billing_no') : $billingNo;
        // $categoryIds = !isset($categoryIds) ? session('category_ids') : $categoryIds;

        $customer = Customer::findOrFail($customerId);
        if (isset($customer) && $customer) {
            $categories = $this->getCategories($categoryIds);
            $billing_no =  $billingNo;
            $pdf = PDF::loadView('admin.billings.billings-pdf', compact('categories', 'customer', 'billing_no'));
            if (isset($pdf) && $pdf) {
                $pdfName = ucfirst($customer->name).'_'.$billingNo.'.pdf';

                $pdfPath = config('billings.quotation.pdf_path');

                $stored = Storage::put($pdfPath.$pdfName, $pdf->output());

                if ($stored) {
                    $data = ['quotation_no' => $billingNo,
                    'quotation_url' => $pdfName,];
                    Quotation::create($data);
                }
                // return $pdf->download($pdfName);
            }
        }
    }

    // public function setQuotationDetailsInSession($request, $customerId, $billingNo, $categoryIds) {
    //     $request->session()->forget([ 'customer_id', 'billing_no', 'category_ids']);
    //     $request->session()->put('customer_id', $customerId);
    //     $request->session()->put('billing_no', $billingNo);
    //     $request->session()->put('category_ids', $categoryIds);
    // }



    public function generateQuotation(Request $request)
    {
        $input = $request->all();
        $quotationDate = null;
        if(isset($input['quotation_date']))
            $quotationDate = $input['quotation_date'];

            $billings = Billing::whereDate('created_at', Carbon::createFromFormat('m/d/Y', $quotationDate)->format('Y-m-d'))->count();

        if($billings <= 0)
            return redirect()->back()->with('error', 'No data found!');

        $categories = $this->billingRepository->getCategories();

        $pdf = PDF::loadView('admin.quotation.quotation-pdf', compact('categories', 'quotationDate'));
        session(['status', 'Quatation downloaded successfully!']);
        return $pdf->download('quotation.pdf');
    }
}