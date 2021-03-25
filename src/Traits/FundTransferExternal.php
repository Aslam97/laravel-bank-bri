<?php

namespace Aslam\Bri\Traits;

trait FundTransferExternal
{
    /**
     * FTEAccountValidation
     *
     * @param  string $bankCode
     * @param  string $beneficiaryAccount
     * @return \Aslam\Bri\Response
     */
    public function FTEAccountValidation(string $bankCode, string $beneficiaryAccount)
    {
        $requestUrl = sprintf(
            '%s%s?bankcode=%s&beneficiaryaccount=%s',
            $this->apiUrl,
            $this->fundTransferExternal->account_validation,
            $bankCode,
            $beneficiaryAccount
        );

        return $this->sendRequest('GET', $requestUrl);
    }

    /**
     * FTETransfer
     *
     * @param  array $data
     * @return \Aslam\Bri\Response
     */
    public function FTETransfer(array $data)
    {
        $requestUrl = $this->apiUrl . $this->fundTransferExternal->transfer;

        return $this->sendRequest('POST', $requestUrl, $data);
    }

    /**
     * FTEListBankCode
     *
     * @return \Aslam\Bri\Response
     */
    public function FTEListBankCode()
    {
        $requestUrl = "{$this->apiUrl}{$this->fundTransferExternal->list_bank_code}";

        return $this->sendRequest('GET', $requestUrl);
    }
}
