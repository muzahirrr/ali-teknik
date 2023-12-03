<?php

namespace App\Http\Controllers\API;

use App\Models\City;
use App\Models\District;
use App\Models\SubDistrict;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function __invoke(Request $request, string $type, string $id): JsonResponse
    {
        if ($type == 'cities') {
            $result =  City::where('province_id', $id)->get(['id', 'alternative_name' => 'name']);
        } else if ($type == 'districts') {
            $result =  District::where('city_id', $id)->get(['id', 'name']);
        } else if ($type == 'subdistricts') {
            $result = SubDistrict::where('district_id', $id)->get(['id', 'name']);
        } else {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($result);
    }
}
