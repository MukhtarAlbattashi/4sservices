<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CarApiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'];

        return response()->json(Car::query()
            ->with(
                [
                    'customer:id,name,phone',
                    'model:id,arName,enName',
                    'brand:id,arName,enName',
                    'type:id,arName,enName',
                    'user:id,name',
                ]
            )
            ->withCount('invoices')
            ->withCount('jobs')
            ->withSum('invoices', 'total')
            ->withSum('payments', 'amount')
            ->mySearch($search)
            ->latest()
            ->paginate(10), Response::HTTP_OK);
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json(
            [
                'message' => __('Car deleted successfully.'),
            ],
            Response::HTTP_OK);
    }

    public function store(CarRequest $request)
    {
        $car = new Car();
        $car->fill($request->validated());
        $car->user_id = Auth::id();
        $car->save();

        return response()->json(
            [
                'message' => __('Car created successfully.'),
            ],
            Response::HTTP_CREATED);
    }

    public function update(CarRequest $request, Car $car)
    {
        $car->fill($request->validated());
        $car->user_id = Auth::id();
        $car->save();

        return response()->json(
            [
                'message' => __('Car updated successfully.'),
            ], Response::HTTP_OK);
    }
}
