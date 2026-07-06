<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Shipping Service
|--------------------------------------------------------------------------
| Bertugas melakukan komunikasi dengan RajaOngkir API.
| Seluruh request API dilakukan pada class ini agar Controller tetap
| fokus mengatur alur aplikasi (MVC).
|--------------------------------------------------------------------------
*/

class ShippingService
{
    /**
     * API Key RajaOngkir.
     */
    private string $apiKey;

    /**
     * Base URL RajaOngkir.
     */
    private string $baseUrl;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->apiKey = RAJA_API_KEY;

        $this->baseUrl = rtrim(RAJA_BASE_URL, '/');
    }

    /**
     * ==========================================================
     * HTTP GET
     * ==========================================================
     */
    private function get(
        string $endpoint,
        array $params = []
    ): array {

        $url = $this->baseUrl .
            $endpoint .
            '?' .
            http_build_query($params);

        $curl = curl_init();

        curl_setopt_array($curl, [

            CURLOPT_URL => $url,

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_TIMEOUT => 30,

            CURLOPT_HTTPHEADER => [

                'key: ' . $this->apiKey

            ]

        ]);

        $response = curl_exec($curl);

        if ($response === false) {

            throw new Exception(curl_error($curl));
        }

        curl_close($curl);

        $result = json_decode($response, true);

        if (!is_array($result)) {

            throw new Exception('Response API tidak valid.');
        }

        return $result;
    }

    /**
     * ==========================================================
     * HTTP POST
     * ==========================================================
     */
    private function post(
        string $endpoint,
        array $data = []
    ): array {

        $curl = curl_init();

        curl_setopt_array($curl, [

            CURLOPT_URL => $this->baseUrl . $endpoint,

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POST => true,

            CURLOPT_POSTFIELDS => http_build_query($data),

            CURLOPT_TIMEOUT => 30,

            CURLOPT_HTTPHEADER => [

                'key: ' . $this->apiKey,

                'Content-Type: application/x-www-form-urlencoded'

            ]

        ]);

        $response = curl_exec($curl);

        if ($response === false) {

            throw new Exception(curl_error($curl));
        }

        curl_close($curl);

        $result = json_decode($response, true);

        if (!is_array($result)) {

            throw new Exception('Response API tidak valid.');
        }

        return $result;
    }

    /**
     * ==========================================================
     * Mengambil daftar provinsi.
     * ==========================================================
     */
    public function getProvinces(): array
    {
        return $this->get(
            '/api/v1/destination/province'
        );
    }

    /**
     * Mengambil daftar kota berdasarkan provinsi.
     */
    public function getCities(
        string $provinceId
    ): array {

        return $this->get(

            '/api/v1/destination/city/' . $provinceId

        );
    }

    /**
     * ==========================================================
     * Menghitung ongkir.
     * ==========================================================
     */
    public function calculateCost(

        string $destination,

        int $weight,

        string $courier

    ): array {

        return $this->post(

            '/api/v1/calculate/domestic-cost',

            [

                'origin' => STORE_CITY_ID,

                'destination' => $destination,

                'weight' => $weight,

                'courier' => $courier

            ]

        );
    }
}