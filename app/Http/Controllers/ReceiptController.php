<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\Billings\Receipt;
use App\Models\Billings\Customer;
use App\Models\Billings\ReceiptUrl;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreReceiptRequest;

class ReceiptController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::findOrFail(1);
        $receipts = $customer->receipts()->orderBy('created_at', 'desc')->get();
        return view('admin.receipts.receipt-pdf', compact('customer','receipts'));

        return view('admin.receipts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.receipts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceiptRequest $request)
    {
        $inputData = $request->only('customer_id', 'description', 'hsn_code', 'qty', 'rate', 'taxable_value');
        $receiptNo =  now()->format('YmdHis');
        $inputData['receipt_no'] = $receiptNo;
        $customer = Customer::findOrFail($inputData['customer_id']);
        if ($customer){
            $i = 0;
            while($i < count($request->description)) {
                $dataFormated = $this->formatInputReceiptData($inputData, $i);
                $customer->receipts()->create($dataFormated);
                $i++;
            }

            $this->createReceiptPDF($customer, $receiptNo);
        }
        $status = 'Receipt created successfully.';
        return redirect()->route('receipts.create')->with('status', $status);
    }

    public function createReceiptPDF($customer, $receiptNo)
    {
        $receipts = $customer->receipts()->whereReceiptNo($receiptNo)->orderBy('created_at', 'desc')->get();
        $pdf = PDF::loadView('admin.receipts.receipt-pdf', compact('customer','receipts', 'receiptNo'));
        if (isset($pdf) && $pdf) {
            $pdfName = ucfirst($customer->name).'_'.$receiptNo.'.pdf';
            $pdfPath = config('billings.receipt.pdf_path');
            $stored = Storage::put($pdfPath.$pdfName, $pdf->output());
            if ($stored) {
                $receiptUrlData = ['receipt_no' => $receiptNo, 'receipt_url' => $pdfName];
                ReceiptUrl::create($receiptUrlData);
            }
            // return $pdf->download($pdfName);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Billings\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Billings\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Billings\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Billings\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }

    public function formatInputReceiptData($data, $i)
    {
        $data = ['description' => $data['description'][$i],
                    'hsn_code' => $data['hsn_code'][$i], 'qty' => $data['qty'][$i],
                    'taxable_value' => $data['taxable_value'][$i], 'rate' => $data['rate'][$i],
                    'receipt_no' => $data['receipt_no']
                ];
        return $data;
    }
}