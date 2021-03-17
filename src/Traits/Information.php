<?php

namespace Aslam\Bri\Traits;

trait Information
{
    /**
     * Get company account information. including name, balance & status.
     *
     * @return \Aslam\Bri\Response
     */
    public function accountInformation()
    {
        $requestUrl = sprintf(
            '%s%s/%s',
            $this->apiUrlV2,
            $this->endpoint->account_information,
            config('bank-bri.account_number')
        );

        return $this->sendRequest('GET', $requestUrl);
    }

    /**
     * Get company account transaction history with max 1 month.
     *
     * @param  string $startDate
     * @param  string $endDate
     * @return \Aslam\Bri\Response
     */
    public function accountTransactionHistory(string $startDate, string $endDate)
    {
        $requestUrl = "{$this->apiUrlV1}{$this->endpoint->account_transaction_history}/{$startDate}/{$endDate}";

        return $this->sendRequest('GET', $requestUrl);
    }
}
