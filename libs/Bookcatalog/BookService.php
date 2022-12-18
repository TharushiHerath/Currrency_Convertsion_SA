<?php

namespace Bookcatalog;

class BookService
{
    /**
     * @soap
     * @param Bookcatalog\Transfer $info_data
     * @return string
     */
    public function Money_convert($data_data)
    {
        $sourceCurrency_base = $this->get_Data($data_data->sourceCurrency);

        $targetCurrency_base = $this->get_Data($data_data->targetCurrency);

        $calculation = ($data_data->amountInSourceCurrency/$sourceCurrency_base)*$targetCurrency_base;

        return $calculation;
    }

    function get_Data($details)
    {
        $data_json = file_get_contents('data.json');

        $decode_file = json_decode($data_json, true);

        $currency_data = $decode_file['money'];

        foreach ($currency_data as $value)
        {
            $target_currency = $value['target_currency'];

            $money_value = $value['value'];

            if($target_currency == $details)
            {
                return $money_value;
            }
        }
    }
}

