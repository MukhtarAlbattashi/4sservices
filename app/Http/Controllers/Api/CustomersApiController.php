<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomersApiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'];

        return response()->json(Customer::query()
            ->withCount('cars')
            ->withCount('invoices')
            ->withSum('invoices', 'total')
            ->withSum('payments', 'amount')
            ->mySearch($search)
            ->latest()
            ->paginate(15), Response::HTTP_OK);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(
            [
                'message' => __('Customer deleted successfully.'),
            ],
            Response::HTTP_OK);
    }

    public function store(CustomerStoreRequest $request)
    {
        $customer = new Customer();
        $customer->fill($request->validated());
        $customer->save();

        return response()->json(
            [
                'message' => __('Customer created successfully.'),
            ],
            Response::HTTP_CREATED);
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->fill($request->validated());
        $customer->save();

        return response()->json(
            [
                'message' => __('Customer updated successfully.'),
            ], Response::HTTP_OK);
    }
}
