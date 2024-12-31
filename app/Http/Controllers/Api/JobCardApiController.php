<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobCardRequest;
use App\Models\JobCard;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobCardApiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'];

        return response()->json(JobCard::query()
            ->withTrashed()
            ->with(['customer', 'car', 'car.model', 'car.type', 'car.brand', 'user', 'status'])
            ->mySearch($search)
            ->latest()->paginate(10), Response::HTTP_OK);
    }

    public function show(JobCard $jobCard)
    {
        return response()->json($jobCard, Response::HTTP_OK);
    }

    public function store(JobCardRequest $request)
    {
        $jobCard = new JobCard();
        $jobCard->fill($request->validated());
        $jobCard->user_id = $request->user()->id;
        $jobCard->save();

        return response()->json(
            [
                'message' => __('Job Card created successfully.'),
            ],
            Response::HTTP_CREATED);
    }

    public function update(JobCardRequest $request, JobCard $jobCard)
    {
        $jobCard->fill($request->validated());
        $jobCard->user_id = $request->user()->id;
        $jobCard->save();

        return response()->json(
            [
                'message' => __('Job Card updated successfully.'),
            ], Response::HTTP_OK);
    }

    public function destroy(JobCard $jobCard)
    {
        $jobCard->delete();
        return response()->json(
            [
                'message' => __('Job Card deleted successfully.'),
            ],
            Response::HTTP_OK);
    }

}
