<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class CalculateDistanceController extends Controller
{
    private Client $client;
    protected string $apiPoint = 'https://maps.googleapis.com/maps/api/distancematrix/json';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function calculateDistance(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        if (empty($origin) || empty($destination)) {
            return response()->json(['message' => __('Prašome nurodyti išvykimo vietą ir atvykimo vietą.')]);
        }

        try {
            $response = $this->client->get($this->apiPoint, [
                'query' => [
                    'origins' => $origin,
                    'destinations' => $destination,
                    'key' => $this->apiKey,
                ],
            ]);
            $data = $response->json();
        } catch (GuzzleException $e) {
            return response()->json(['message' => __('Klaida gavus atstumo informaciją.')]);
        }

        if ($response->failed()) {
            return response()->json(['message' => __('Klaida gaunant atstumo informaciją.')]);
        }

        $distance = data_get($data, 'rows.0.elements.0.distance.text');
        $duration = data_get($data, 'rows.0.elements.0.duration.text');

        if (empty($distance) || empty($duration)) {
            return response()->json(['message' => __('Nepavyko gauti atstumo arba trukmės informacijos.')]);
        }

        return response()->json([
            'distance' => $distance,
            'duration' => $duration,
        ]);
    }
}
