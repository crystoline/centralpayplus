<?php

use Crystoline\CentralPayPlus\CentralPayPlus;
use PHPUnit\Framework\TestCase;

class CreateMandateRequestNoRegTest extends TestCase
{
    /**
     * Check that the multiply method returns correct result
     * @return void
     */
    public function testCreateMandateRequestNoReg()
    {
        $options = $context = stream_context_create([
            'ssl' => [
                // set some SSL/TLS specific options
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);
        $centralPayRequest = new CentralPayPlus(
            array("soap_version" => SOAP_1_1,
                'trace' => 1, 'debug' => 1,
                'exceptions' => true,
                'stream_context' => $options));

        $result = $centralPayRequest->generateOTPRequestNoReg([
            "AcctNumber" => '5050007512',
            "AcctName" => 'OKOLI CHUKWUMA PAUL',
            "TransType" => 2,
            "BankCode" => '070',
            "BillerID" => "NIBSS0000000030",
            "BillerName" => 'Upperlink',
            'Amount' => 500,
            "BillerTransId" => 1045620,
        ]);

        $xml_array = (array)simplexml_load_string($result->return);
        dump($xml_array);
        $this->assertArrayHasKey("MandateCode", $xml_array);
        $this->assertArrayHasKey("ResponseCode", $xml_array);
        $this->assertEquals('00', $xml_array['ResponseCode']);

        if( $xml_array['ResponseCode'] == '00'){
            $result = $centralPayRequest->validateOTPRequestNoReg([
                "AcctNumber" => '5050007512',
                "AcctName" => 'OKOLI CHUKWUMA PAUL',
                "TransType" => 2,
                "BankCode" => '070',
                "BillerID" => "NIBSS0000000030",
                "BillerName" => 'Upperlink',
                'Amount' => 500,
                "BillerTransId" => 1045620,
                'MandateCode' => $xml_array['MandateCode'],
                'OTP' => '123321'
            ]);

            $xml_array = (array)simplexml_load_string($result->return);
            dump($xml_array);
            $this->assertArrayHasKey("MandateCode", $xml_array);
            $this->assertArrayHasKey("ResponseCode", $xml_array);
            $this->assertEquals('00', $xml_array['ResponseCode']);
            if( $xml_array['ResponseCode'] == '00'){
                print '\nsuccessful';
            }else{
                print "\nOTP code failed";
            }
        }

    }
}