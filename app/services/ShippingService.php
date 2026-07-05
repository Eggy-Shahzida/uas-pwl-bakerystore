<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Shipping Service
|--------------------------------------------------------------------------
| Bertugas berkomunikasi dengan API BinderByte.
|
| Seluruh request HTTP ke layanan ongkir dilakukan pada class ini agar
| Controller tetap fokus mengatur alur aplikasi (MVC).
|--------------------------------------------------------------------------
*/

class ShippingService
{
    /**
     * API Key BinderByte.
     */
    private string $apiKey;

    /**
     * Base URL BinderByte API.
     */
    private string $baseUrl;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->apiKey = BINDERBYTE_API_KEY;

        $this->baseUrl = BINDERBYTE_BASE_URL;
    }

    /**
     * Mengirim HTTP Request ke BinderByte.
     *
     * @param string $endpoint
     * @param array  $params
     *
     * @return array
     */
    private function request(
        string $endpoint,
        array $params = []
    ): array {

        $params['api_key'] = $this->apiKey;

        $url = $this->baseUrl . $endpoint . '?' . http_build_query($params);

        $curl = curl_init();

        curl_setopt_array($curl, [

            CURLOPT_URL => $url,

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_TIMEOUT => 30,

            CURLOPT_SSL_VERIFYPEER => true,

        ]);

        $response = curl_exec($curl);

        if ($response === false) {

            throw new Exception(
                'cURL Error : ' . curl_error($curl)
            );
        }

        curl_close($curl);

        $result = json_decode($response, true);

        if ($result === null) {

    echo "<h3>Request URL</h3>";
    echo $url;

    echo "<hr>";

    echo "<h3>Raw Response</h3>";
    echo "<pre>";
    echo htmlspecialchars($response);
    echo "</pre>";

    exit;
}

        return $result;
    }

    /**
     * Mengambil seluruh provinsi.
     *
     * @return array
     */
    public function getProvinces(): array
    {
        return $this->request('/wilayah/provinsi');
    }

    /**
     * Mengambil kota berdasarkan provinsi.
     *
     * @param string $provinceId
     *
     * @return array
     */
    public function getCities(
        string $provinceId
    ): array {

        return $this->request(

            '/wilayah/kabupaten',

            [
                'id_provinsi' => $provinceId
            ]

        );
    }

    /**
     * Menghitung ongkir.
     *
     * @param string $origin
     * @param string $destination
     * @param int    $weight
     * @param string $courier
     *
     * @return array
     */
    public function calculateCost(

        

        string $destination,

        int $weight,

        string $courier

    ): array {

        return $this->request(

            '/v1/cost',

            [

                'origin'      => STORE_CITY_ID,

                'destination' => $destination,

                'weight' => $weight,

                'courier' => $courier

            ]

        );
    }
}