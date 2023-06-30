<?php
declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class DistanceCalculatorService
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
    public function getDistanceAndDuration(string $origin, string $destination): array
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $response = $this->client->get($this->apiPoint, [
            'query' => [
                'origins' => $origin,
                'destinations' => $destination,
                'key' => $apiKey,
            ],
        ]);

        $data = $response->json();

        return [
            'distance' => data_get($data, 'rows.0.elements.0.distance.text'),
            'duration' => data_get($data, 'rows.0.elements.0.duration.text'),
        ];
    }
}
