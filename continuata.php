<?php
/*********************************************
*
*   continuata.php API for Connect purchasing
*   © Continuata Ltd 2014
*
**********************************************/

class Continuata
{
    public $company = "";
    public $password = "";

    public function __construct($company, $password) {
        $this->company = $company;
        $this->password = $password;
    }

    private function sendRequest($data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://continuata.net/int/api.php');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    function addPurchase($name, $email, $sku, $price, $target_company="", $serial="") {
        $company = $target_company ? $target_company : $this->company;
        $reseller = $target_company ? $this->company : '';

        $data = array(
                    'action' => 'add_purchase',
                    'company' => $company,
                    'reseller' => $reseller,
                    'password' => $this->password,
                    'name' => $name,
                    'email' => $email,
                    'price' => $price,
                    'sku' => $sku,
                    'serial' => $serial);

        $this->sendRequest($data);
    }

    function getManualLinks($email, $sku, $target_company="") {
        $company = $target_company ? $target_company : $this->company;
        $reseller = $target_company ? $this->company : '';

        $data = array(
                    'action' => 'manual_links',
                    'company' => $company,
                    'reseller' => $reseller,
                    'password' => $this->password,
                    'email' => $email,
                    'sku' => $sku);

        $output = $this->sendRequest($data);
        $links = json_decode($output);
        return $links;
    }

    function getSerialNumber($email, $sku, $target_company="") {
        $company = $target_company ? $target_company : $this->company;
        $reseller = $target_company ? $this->company : '';

        $data = array(
                    'action' => 'get_serial',
                    'company' => $company,
                    'reseller' => $reseller,
                    'password' => $this->password,
                    'email' => $email,
                    'sku' => $sku);

        $output = $this->sendRequest($data);
        return trim($output);
    }

    function resetTries($serial, $target_company="") {
        $company = $target_company ? $target_company : $this->company;
        $reseller = $target_company ? $this->company : '';

        $data = array(
                    'action' => 'reset_tries',
                    'company' => $company,
                    'reseller' => $reseller,
                    'password' => $this->password,
                    'serial' => $serial);

        $this->sendRequest($data);
    }

    function registerCode($name, $email, $serial, $target_company="") {
        $company = $target_company ? $target_company : $this->company;
        $reseller = $target_company ? $this->company : '';

        $data = array(
            'action' => 'register_code',
            'company' => $company,
            'reseller' => $reseller,
            'password' => $this->password,
            'name' => $name,
            'email' => $email,
            'serial' => $serial);

        $this->sendRequest($data);
    }
}

?>
