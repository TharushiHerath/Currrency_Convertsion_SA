<?php

class data
{
    public $amountInSourceCurrency;

    public $sourceCurrency;

    public $targetCurrency;

}

class Client{

    public $instance = NULL;

    public function __construct()
    {
        $params = array(
            'location'=>'http://localhost/AA1824SA/Server.php?wsdl',
            'uri' =>  'urn://localhost/AA1824SA/Server.php?wsdl'  ,
            'trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE    );
        $this->instance =  new SoapClient(NULL, $params);
    }

    public function Money_Con($data_data)
    {
        return $this->instance->__soapCall('money_convert', [$data_data]);
    }

}

if(isset($_POST['submit']))
{
    $source_money_amount = $_POST['amount'];

    $source_money = $_POST['source'];

    $target_money = $_POST['target'];

    $client = new Client;

    $data_data = new data();

    $data_data->amountInSourceCurrency = $source_money_amount;

    $data_data->sourceCurrency = $source_money;

    $data_data->targetCurrency = $target_money;

    try
    {
        $return_data = $client->Money_Con($data_data);

        header('location: index.php?message= Server Says : '.$return_data);
    }
    catch (Exception $e)
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
























?>
