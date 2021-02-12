<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Billings\Customer;
use App\Repositories\Eloquent\BillingRepositoryInterface;

class BillingComposer
{

    protected $billingRepository;

    public function __construct(BillingRepositoryInterface $billingRepository)
    {
        // Dependencies are automatically resolved by the service container...
        $this->billingRepository = $billingRepository;
    }

    public function compose(View $view)
    {
        $customers = Customer::all();
        $categories = $this->billingRepository->getCategories();
        $data = [
            'categories' => $categories,
            'customers' => $customers,
        ];
        $view->with($data);
    }
}
