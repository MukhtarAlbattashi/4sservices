<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarModelFormRequest;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CarModelApiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'];

        return response()->json(CarModel::query()
            ->withCount('cars')->with([
                'brand:id,arName,enName', 'user:id,name',
            ])
            ->mySearch($search)
            ->latest()
            ->paginate(10), Response::HTTP_OK);
    }

    public function store(CarModelFormRequest $request)
    {
        $carModel = new CarModel();
        $carModel->fill($request->validated());
        $carModel->user_id = Auth::id();
        $carModel->save();

        return response()->json(
            [
                'message' => __('Car Model created successfully.'),
            ],
            Response::HTTP_CREATED);
    }

    public function update(CarModelFormRequest $request, CarModel $carModel)
    {
        $carModel->fill($request->validated());
        $carModel->user_id = Auth::id();
        $carModel->save();

        return response()->json(
            [
                'message' => __('Car Model updated successfully.'),
            ], Response::HTTP_OK);
    }

    public function destroy(CarModel $carModel)
    {
        if ($carModel->image) {
            unlink($carModel->image);
        }
        $carModel->delete();

        return response()->json(
            [
                'message' => __('Car Model deleted successfully.'),
            ],
            Response::HTTP_OK);
    }
}
