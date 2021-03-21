<?php

namespace Aslam\Bri\Traits;

trait BRIVA
{
    /**
     * Create BRIVA
     *
     * @param array
     * @return \Aslam\Bri\Response
     */
    public function createBriva(array $data)
    {
        $requestUrl = $this->apiUrlV1 . $this->endpoint->briva;
        $data = array_merge($data, ['institutionCode' => $this->institutionCode]);

        return $this->sendRequest('POST', $requestUrl, $data);
    }

    /**
     * Get BRIVA information that has been created.
     *
     * @param string $brivaNo
     * @param string $customerCode
     * @return \Aslam\Bri\Response
     */
    public function getBriva(string $brivaNo, string $customerCode)
    {
        $requestUrl = "{$this->apiUrlV1}{$this->endpoint->briva}/{$this->institutionCode}/{$brivaNo}/{$customerCode}";

        return $this->sendRequest('GET', $requestUrl);
    }

    /**
     * Get payment status of an existing BRIVA account.
     *
     * @param string $brivaNo
     * @param string $customerCode
     * @return \Aslam\Bri\Response
     */
    public function getStatusBriva(int $brivaNo, string $customerCode)
    {
        $requestUrl = "{$this->apiUrlV1}{$this->endpoint->briva_status}/{$this->institutionCode}/{$brivaNo}/{$customerCode}";

        return $this->sendRequest('GET', $requestUrl);
    }

    /**
     * Manage payment status of an existing BRIVA account
     *
     * @param array $data
     * @param string $statusBayar Y|N
     * @return \Aslam\Bri\Response
     */
    public function updateStatusBriva(array $data)
    {
        $requestUrl = "{$this->apiUrlV1}{$this->endpoint->briva_status}";
        $data = array_merge($data, ['institutionCode' => $this->institutionCode]);

        return $this->sendRequest('PUT', $requestUrl, $data);
    }

    /**
     * Update existing BRIVA account.
     *
     * @param array $data
     * @return \Aslam\Bri\Response
     */
    public function updateBriva(array $data)
    {
        $requestUrl = "{$this->apiUrlV1}{$this->endpoint->briva}";
        $data = array_merge($data, ['institutionCode' => $this->institutionCode]);

        return $this->sendRequest('PUT', $requestUrl, $data);
    }

    /**
     * Delete BRIVA
     *
     * @param string $brivaNo
     * @param string $custCode
     * @return \Aslam\Bri\Response
     */
    public function deleteBriva(string $brivaNo, string $custCode)
    {
        $requestUrl = "{$this->apiUrlV1}{$this->endpoint->briva}";
        $institutionCode = $this->institutionCode;

        $data = compact('institutionCode', 'brivaNo', 'custCode');
        $query = http_build_query($data);

        return $this->sendRequest('DELETE', $requestUrl, $query);
    }

    /**
     * Get transaction history of all BRIVA accounts registered to your BRIVA number.
     *
     * @param  string $brivaNo
     * @param  string $startDate
     * @param  string $endDate
     * @return \Aslam\Bri\Response
     */
    public function getReportBriva(string $brivaNo, string $startDate, string $endDate)
    {
        $requestUrl = "{$this->apiUrlV1}{$this->endpoint->briva_report}/{$this->institutionCode}/{$brivaNo}/{$startDate}/{$endDate}";
        return $this->sendRequest('GET', $requestUrl);
    }

    public function getReportTimeBrive()
    {

    }
}
