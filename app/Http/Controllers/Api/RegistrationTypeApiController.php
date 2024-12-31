<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArabicEnglishFormRequest;
use App\Models\RegistrationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RegistrationTypeApiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'];

        return response()->json(RegistrationType::query()
            ->withCount('cars')
            ->with('user:id,name')
            ->mySearch($search)
            ->latest()
            ->paginate(10), Response::HTTP_OK);
    }

    public function destroy(RegistrationType $registrationType)
    {
        $registrationType->delete();

        return response()->json(
            [
                'message' => __('Registration type deleted successfully.'),
            ],
            Response::HTTP_OK);
    }

    public function store(ArabicEnglishFormRequest $request)
    {
        $registrationType = new RegistrationType();
        $registrationType->fill($request->validated());
        $registrationType->user_id = Auth::id();
        $registrationType->save();

        return response()->json(
            [
                'message' => __('Registration type created successfully.'),
            ],
            Response::HTTP_CREATED);
    }

    public function update(ArabicEnglishFormRequest $request, RegistrationType $registrationType)
    {
        $registrationType->fill($request->validated());
        $registrationType->user_id = Auth::id();
        $registrationType->save();

        return response()->json(
            [
                'message' => __('Registration type updated successfully.'),
            ], Response::HTTP_OK);
    }
}
