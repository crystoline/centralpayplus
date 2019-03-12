<?php
/**
 * Created by PhpStorm.
 * User: aisha.alimi
 * Date: 21/11/2018
 * Time: 9:04 AM
 */

require 'vendor/autoload.php';
require 'vendor/upldevteam/centralpayplus/src/autoload.php';

use UplDevTeam\CentralPayPlus;

try{
    $options = $context = stream_context_create([
        'ssl' => [
            // set some SSL/TLS specific options
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);
    $centralPayRequest = new CentralPayPlus\CentralPayPlus(
        array("soap_version" => SOAP_1_1,
            'trace' => 1, 'debug' => 1,
            'exceptions'=>true,
            'stream_context' => $options));
    /*dump($centralPayRequest->soapClient->__getFunctions());

    $result = $centralPayRequest->listActiveBanksOTP("NIBSS0000000103");
    dump($result);
    $token = simplexml_load_string($result->return);
    dump($token);*/

    $result = $centralPayRequest->createMandateRequest([
        "AcctNumber" => '0691391605',
        "AcctName" => 'Babatunde Daniel',
        "TransType" => 1,
        "BankCode" => '044',
        "BillerID" => "NIBSS0000000103",
        "BillerName" => 'Upperlink',
        "BillerTransId" => 1045620,
    ]);
    dump($result);
    $token = simplexml_load_string($result->return);
    print_r($token);

    //dump($token);
    if (is_soap_fault($result)) {
        trigger_error("SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring})", E_USER_ERROR);
    }
    dump($centralPayRequest->soapClient->__getLastRequest());
    dump($centralPayRequest->soapClient->__getLastResponse());
    /*
    dump($centralPayRequest->soapClient->listActiveBanksOTP('NIBSS0000000103'));
    dump($centralPayRequest->createMandateRequest
    (
       "<![CDATA[".\FluidXml\fluidxml([
               "CreateMandateRequest"
               => [
                   "AcctNumber" => '1020021016',
                   "AcctName" => 'John Smith',
                   "TransType" => 1,
                   "BankCode" => 023,
                   "BillerID" => 123,
                   "BillerName" => 'Konga',
                   "BillerTransId" => 1045621,
                   "HashValue" => ''
               ]
           ])->xml()."]]>"
    ));*/
} catch (Exception $e){
    dump($e);
}


/*dump("<![CDATA[".\FluidXml\fluidxml([
    "CreateMandateRequest"
            => [
            "AcctNumber" => '1020021016',
            "AcctName" => 'John Smith',
            "TransType" => 1,
            "BankCode" => 023,
            "BillerID" => 123,
            "BillerName" => 'Konga',
            "BillerTransId" => 1045621,
            "HashValue" => ''
        ]
    ])->xml()."]]>");
echo hash_hmac('SHA256',
    "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><CreateMandateRequest><AcctNumber>1020021016</AcctNumber><AcctName>John Smith</AcctName><TransType>1</TransType><BankCode>19</BankCode><BillerID>NIBSS0000000103</BillerID><BillerName>Konga</BillerName><BillerTransId>1045621</BillerTransId></CreateMandateRequest>",
    "F1AF5921013C0B9E6310E317F5B9F29E");
echo "<br>";
echo hash_hmac('SHA256',
'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><CreateMandateResponse><AcctNumber>1020021016</AcctNumber><AcctName>John Smith</AcctName><TransType>1</TransType><BankCode>19</BankCode><BillerID>NIBSS0000000103</BillerID><BillerName>Konga</BillerName><BillerTransId>1045621</BillerTransId><MandateCode></MandateCode></CreateMandateResponse>',
    "F1AF5921013C0B9E6310E317F5B9F29E");
echo "<br> NIBSSS";
echo hash_hmac('SHA256',
'<CreateMandateResponse><AcctNumber>1020021016</AcctNumber><AcctName>John Smith</AcctName><TransType>1</TransType><BankCode>19</BankCode><BillerID>NIBSS0000000103</BillerID><BillerName>Konga</BillerName><BillerTransId>1045621</BillerTransId><MandateCode></MandateCode><ResponseCode>19</ResponseCode></CreateMandateResponse>',
    "F1AF5921013C0B9E6310E317F5B9F29E");
echo "<br>";
echo hash('SHA256', "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><CreateMandateResponse><AcctNumber>1020021016</AcctNumber><AcctName>John Smith</AcctName><TransType>1</TransType><BankCode>19</BankCode><BillerID>NIBSS0000000103</BillerID><BillerName>Konga</BillerName><BillerTransId>1045621</BillerTransId><MandateCode></MandateCode><ResponseCode>19</ResponseCode></CreateMandateResponse>");*/
//


// '<CreateMandateResponse><AcctNumber>1020021016</AcctNumber><AcctName>John Smith</AcctName><TransType>1</TransType><BankCode>19</BankCode><BillerID>NIBSS0000000103</BillerID><BillerName>Konga</BillerName><BillerTransId>1045621</BillerTransId><MandateCode></MandateCode><HashValue>51fc32be55e21ac61a42a94b60b143ae21dc4588c724fbc38576d6eee6bd701a</HashValue></CreateMandateResponse>',

