<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\DistanceCalculatorService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class CalculateDistanceController extends Controller
{
    protected DistanceCalculatorService $distanceCalculatorService;

    public function __construct(DistanceCalculatorService $distanceCalculatorService)
    {
        $this->distanceCalculatorService = $distanceCalculatorService;
    }

    public function calculateDistance(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');

        if (empty($origin) || empty($destination)) {
            return response()->json(['message' => __('Prašome nurodyti išvykimo vietą ir atvykimo vietą.')]);
        }

        try {
            $data = $this->distanceCalculatorService->getDistanceAndDuration($origin, $destination);
        } catch (GuzzleException $e) {
            return response()->json(['message' => __('Klaida gavus atstumo informaciją.')]);
        }

        if (empty($data['distance']) || empty($data['duration'])) {
            return response()->json(['message' => __('Nepavyko gauti atstumo arba trukmės informacijos.')]);
        }

        return response()->json([
            'distance' => $data['distance'],
            'duration' => $data['duration'],
        ]);
    }
}
