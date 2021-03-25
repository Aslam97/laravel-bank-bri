<?php

namespace Aslam\Bri\Traits;

trait FundTransferInternal
{
    /**
     * FTIAccountValidation
     *
     * @param  string $sourceAccount
     * @param  string $beneficiaryAccount
     * @return \Aslam\Bri\Response
     */
    public function FTIAccountValidation(string $sourceAccount, string $beneficiaryAccount)
    {
        if (strlen($sourceAccount) < 15) {
            $sourceAccount = '0' . $sourceAccount;
        }

        if (strlen($beneficiaryAccount) < 15) {
            $beneficiaryAccount = '0' . $beneficiaryAccount;
        }

        $requestUrl = sprintf(
            '%s%s?sourceaccount=%s&beneficiaryaccount=%s',
            $this->apiUrl,
            $this->fundTransferInternal->account_validation,
            $sourceAccount,
            $beneficiaryAccount
        );

        return $this->sendRequest('GET', $requestUrl);
    }

    public function transfer()
    {
        $requestUrl = $this->apiUrl . $this->fund_transfer_internal->transfer;
    }

    public function checkStatus()
    {
        $requestUrl = $this->apiUrl . $this->fund_transfer_internal->check_status;

    }
}
