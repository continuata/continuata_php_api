continuata_php_api
==================

API for Continuata download system.

If the purchase or operation is for a 3rd-party company (i.e. the code is being performed by a reseller), then the `target_company` variable is the company_id of the company the reseller has authorisation to act on behalf of.

Supports
* addPurchase (name, email, sku, price, [target_company], [serial]) - option to pass in serial/download code
* getManualLinks (email, sku, [target_company])
* getSerialNumber (email, sku, [target_company])
* resetTries (code, [target_company])
* registerCode (name, email, serial, [target_company])

Usage:

    <?php
	      include('continuata.php');

	      $continuata = new Continuata($company_id, $company_password);
        $continuata->addPurchase($customer_name, $customer_email, $product_sku);
        var_dump($continuata->getSerialNumber($customer_email, $product_sku));
    ?>
