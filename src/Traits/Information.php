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
            $this->apiUrl,
            $this->account->information,
            $this->accountNumber
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
        $requestUrl = sprintf(
            '%s%s/%s/%s/%s',
            $this->apiUrlExtra,
            $this->account->transaction_history,
            $this->accountNumber,
            $startDate,
            $endDate
        );

        return $this->sendRequest('GET', $requestUrl);
    }
}
