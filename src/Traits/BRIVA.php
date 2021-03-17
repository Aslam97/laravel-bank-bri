<?php

namespace Aslam\Bri\Traits;

trait BRIVA
{
    /**
     * Endpoint ini digunakan untuk membuat virtual account BRI baru.
     *
     * @param  mixed $data
     * @return void
     */
    public function createBriva(array $data)
    {
        // try {
        $requestUrl = $this->apiUrlV1 . $this->endpoint->briva;

        return $this->sendRequest('POST', $requestUrl, $data);
        // } catch (RequestException $e) {
        //     return $e->response->toJson();
        // }
    }

    /**
     * Endpoint ini digunakan untuk mendapatkan informasi virtual account yang telah dibuat.
     *
     * @param  string $institutionCode
     * @param  int $brivaNo
     * @param  string $customerCode
     * @return void
     */
    public function getBriva(string $institutionCode, int $brivaNo, string $customerCode)
    {
        $requestUrl = "{$this->apiUrlV1}{$this->endpoint->briva}/{$institutionCode}/{$brivaNo}/{$customerCode}";

        return $this->sendRequest('GET', $requestUrl);
    }

    /**
     * Semua akun BRIVA memiliki statusBayar atau status pembayaran.
     * Endpoint ini digunakan untuk mendapatkan status pembayaran dari akun BRIVA yang ada.
     *
     * @param  string $institutionCode
     * @param  int $brivaNo
     * @param  string $customerCode
     * @return void
     */
    public function getStatusBriva(string $institutionCode, int $brivaNo, string $customerCode)
    {
        $requestUrl = "{$this->apiUrlV1}{$this->endpoint->briva}/status/{$institutionCode}/{$brivaNo}/{$customerCode}";

        return $this->sendRequest('GET', $requestUrl);
    }
}
