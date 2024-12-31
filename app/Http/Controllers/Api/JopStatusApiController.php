<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JopStatusRequest;
use App\Models\JopStatus;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JopStatusApiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'];

        return response()->json(JopStatus::query()
            ->mySearch($search)
            ->latest()
            ->paginate(10), Response::HTTP_OK);
    }

    public function show(JopStatus $jopStatus)
    {
        return response()->json($jopStatus, Response::HTTP_OK);
    }

    public function store(JopStatusRequest $request)
    {
        $jopStatus = new JopStatus();
        $jopStatus->fill($request->validated());
        $jopStatus->user_id = $request->user()->id;
        $jopStatus->save();

        return response()->json(
            [
                'message' => __('Job Status created successfully.'),
            ],
            Response::HTTP_CREATED);
    }

    public function update(JopStatusRequest $request, JopStatus $jopStatus)
    {
        $jopStatus->fill($request->validated());
        $jopStatus->user_id = $request->user()->id;
        $jopStatus->save();

        return response()->json(
            [
                'message' => __('Job Status updated successfully.'),
            ], Response::HTTP_OK);
    }

    public function destroy(JopStatus $jopStatus)
    {
        $jopStatus->delete();

        return response()->json(
            [
                'message' => __('Job Status deleted successfully.'),
            ],
            Response::HTTP_OK);
    }
}
