<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobCardRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'dateEntry' => 'date',
            'timeEntry' => 'date_format:H:i',
            'whereTheCarCame' => 'nullable|string|max:255',
            'carDriverWhereTheCarCame' => 'nullable|string|max:255',
            'entryCounterNumber' => 'nullable|string|max:255',
            'carRepairPermission' => 'nullable|string|max:255',
            'entryImage' => 'nullable|string|max:255',
            'paintWorks' => 'nullable|string|max:255',
            'dentingWorks' => 'nullable|string|max:255',
            'electricalWorks' => 'nullable|string|max:255',
            'mechanicWorks' => 'nullable|string|max:255',
            'StatusCarOfEntry' => 'nullable|string|max:255',
            'StatusCarOfExit' => 'nullable|string|max:255',
            'dateExit' => 'date',
            'timeExit' => 'date_format:H:i',
            'departureDestination' => 'nullable|string|max:255',
            'carDriverDeparture' => 'nullable|string|max:255',
            'exitCounterNumber' => 'nullable|string|max:255',
            'exitImage' => 'nullable|string|max:255',
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'jop_status_id' => 'required|exists:jop_statuses,id',
            'user_id' => 'nullable|exists:users,id',
        ];
    }
}
