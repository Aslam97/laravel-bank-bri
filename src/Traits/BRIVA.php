<?php

namespace Aslam\Bri\Traits;

trait BRIVA
{
    /**
     * Create BRIVA
     *
     * @param array
     * @return \Aslam\Response\Response
     */
    public function createBriva(array $data)
    {
        $requestUrl = $this->apiUrl . $this->briva->store;
        $data = array_merge($data, ['institutionCode' => $this->institutionCode]);

        return $this->sendRequest('POST', $requestUrl, $data);
    }

    /**
     * Get BRIVA information that has been created.
     *
     * @param string $brivaNo
     * @param string $customerCode
     * @return \Aslam\Response\Response
     */
    public function getBriva(string $brivaNo, string $customerCode)
    {
        $requestUrl = "{$this->apiUrl}{$this->briva->show}/{$this->institutionCode}/{$brivaNo}/{$customerCode}";

        return $this->sendRequest('GET', $requestUrl);
    }

    /**
     * Update existing BRIVA account.
     *
     * @param array $data
     * @return \Aslam\Response\Response
     */
    public function updateBriva(array $data)
    {
        $requestUrl = "{$this->apiUrl}{$this->briva->update}";
        $data = array_merge($data, ['institutionCode' => $this->institutionCode]);

        return $this->sendRequest('PUT', $requestUrl, $data);
    }

    /**
     * Delete BRIVA
     *
     * @param string $brivaNo
     * @param string $custCode
     * @return \Aslam\Response\Response
     */
    public function deleteBriva(string $brivaNo, string $custCode)
    {
        $requestUrl = "{$this->apiUrl}{$this->briva->destroy}";
        $institutionCode = $this->institutionCode;

        $data = compact('institutionCode', 'brivaNo', 'custCode');
        $query = http_build_query($data);

        return $this->sendRequest('DELETE', $requestUrl, $query);
    }

    /**
     * Get payment status of an existing BRIVA account.
     *
     * @param string $brivaNo
     * @param string $customerCode
     * @return \Aslam\Response\Response
     */
    public function getStatusBriva(int $brivaNo, string $customerCode)
    {
        $requestUrl = "{$this->apiUrl}{$this->briva->status}/{$this->institutionCode}/{$brivaNo}/{$customerCode}";

        return $this->sendRequest('GET', $requestUrl);
    }

    /**
     * Manage payment status of an existing BRIVA account
     *
     * @param array $data
     * @param string $statusBayar Y|N
     * @return \Aslam\Response\Response
     */
    public function updateStatusBriva(array $data)
    {
        $requestUrl = "{$this->apiUrl}{$this->briva->status}";
        $data = array_merge($data, ['institutionCode' => $this->institutionCode]);

        return $this->sendRequest('PUT', $requestUrl, $data);
    }

    /**
     * Get transaction history of all BRIVA accounts registered to your BRIVA number.
     *
     * @param  string $brivaNo
     * @param  string $startDate
     * @param  string $endDate
     * @return \Aslam\Response\Response
     */
    public function getReportBriva(string $brivaNo, string $startDate, string $endDate)
    {
        $requestUrl = "{$this->apiUrl}{$this->briva->report}/{$this->institutionCode}/{$brivaNo}/{$startDate}/{$endDate}";
        return $this->sendRequest('GET', $requestUrl);
    }

    /**
     * getReportTimeBriva
     *
     * @param  string $brivaNo
     * @param  string $startDate FORMAT (Y-m-d)
     * @param  string $startTime FORMAT (H:i)
     * @param  string $endDate FORMAT (Y-m-d)
     * @param  string $endTime FORMAT (H:i)
     * @return \Aslam\Response\Response
     */
    public function getReportTimeBriva(
        string $brivaNo,
        string $startDate,
        string $startTime,
        string $endDate,
        string $endTime
    ) {
        $requestUrl = sprintf(
            '%s%s/%s/%s/%s/%s/%s/%s',
            $this->apiUrl,
            $this->briva->report_time,
            $this->institutionCode,
            $brivaNo,
            $startDate,
            $startTime,
            $endDate,
            $endTime
        );

        return $this->sendRequest('GET', $requestUrl);
    }
}
