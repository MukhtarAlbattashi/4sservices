<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarBrandRequest;
use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CarBrandApiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'];

        return response()->json(CarBrand::query()
            ->withCount('cars')
            ->with('user:id,name')
            ->mySearch($search)
            ->latest()
            ->paginate(10), Response::HTTP_OK);
    }

    public function destroy(CarBrand $carBrand)
    {
        $carBrand->delete();

        return response()->json(
            [
                'message' => __('Car Brand deleted successfully.'),
            ],
            Response::HTTP_OK);
    }

    public function store(CarBrandRequest $request)
    {
        $carBrand = new CarBrand();
        $carBrand->fill($request->validated());
        $carBrand->user_id = Auth::id();
        $carBrand->save();

        return response()->json(
            [
                'message' => __('Car Brand created successfully.'),
            ],
            Response::HTTP_CREATED);
    }

    public function update(CarBrandRequest $request, CarBrand $carBrand)
    {
        $carBrand->fill($request->validated());
        $carBrand->user_id = Auth::id();
        $carBrand->save();

        return response()->json(
            [
                'message' => __('Car Brand updated successfully.'),
            ], Response::HTTP_OK);
    }
}
