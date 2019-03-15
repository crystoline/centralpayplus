<?php
/**
 * Created by PhpStorm.
 * User: aisha.alimi
 * Date: 19/11/2018
 * Time: 1:11 PM
 */

namespace Crystoline\CentralPayPlus;


use SoapFault;
use Crystoline\CentralPayPlus\Exception\CentralPayPlusRequestException;
use Crystoline\CentralPayPlus\RequestBuilder;
use Crystoline\CentralPayPlus\Routes;
use Crystoline\CentralPayPlus\Helpers\Router;

class CentralPayPlus
{
    public $secret_key;
    public $use_guzzle = false;
    public static $fallback_to_file_get_contents = true;
    const VERSION="1.0.0";

    public static $ROUTES = [
        'CreateMandateRequest',
        'ValidateOTPRequest',
        'GenerateOTPRequest',
        'GenerateOTPRequestNoReg',
        'CancelMandateRequest',
        'RequeryMandateRequest',
        'listActiveBanks',
        'listActiveBanksOTP'
    ];

    public $soapClient;
    public $soapOptions;
    public $wsdl = 'https://staging.nibss-plc.com.ng/CentralPayWebservice/CentralPayOperations?wsdl';
    public function __construct ($soapOptions = array(), $wsdl = null)
    {
        if($wsdl){
            $this->setWsdl($wsdl);
        }
        $this->soapOptions = $soapOptions;
        try{
            $this->soapClient = new \SoapClient($this->wsdl, $soapOptions);

        } catch (SoapFault $soapFault){
            //logger('Soap Connect Error: '.$soapFault->getMessage());
            throw new CentralPayPlusRequestException("Error communicating with web service: ". $soapFault->getMessage());
        }

    }


    public function __call($method, $args)
    {
        //dump($args);
        if (count($args) >= 1) {

            $requestBuilder = new Router($method, $args);
            try{
                //$response = $this->soapClient->__soapCall($method, $requestBuilder->generateRequest()->getRequest()->xml());
                if(gettype($args[0]) == 'string'){
                    $response = $this->soapClient->{$method}(
                        ["arg0" => $args[0]]
                    );
                } else {
                    //echo $requestBuilder->generateRequest()->getRequest()->xml();
                    $request_xml = trim('<arg0><![CDATA['.$requestBuilder->generateRequest()->getRequest()->xml().']]></arg0>', "\r\n");
                    //echo $request_xml;
                    $response = $this->soapClient->{$method}(
                        //new \SoapVar($request_xml,XSD_ANYXML, null, null,'arg0')
                        [
                            "arg0" => new \SoapVar($request_xml,XSD_ANYXML, null, null,null)
                        ]
                    );
                }


                //dump($this->soapClient->__getLastRequest());
                return $response;
            } catch (\SoapFault $soapFault){

            }
        }
        throw new \InvalidArgumentException(
            'Route "' . $method . '" can only accept an id or code.'
        );
    }

    /**
     * @return mixed
     */
    public function getWsdl ()
    {
        return $this->wsdl;
    }

    /**
     * @param mixed $wsdl
     */
    public function setWsdl ($wsdl)
    {
        $this->wsdl = $wsdl;
    }

    /**
     * @return mixed
     */
    public function getSecretKey ()
    {
        return $this->secret_key;
    }

    /**
     * @param mixed $secret_key
     * @return CentralPayPlus
     */
    public function setSecretKey ($secret_key)
    {
        $this->secret_key = $secret_key;
        return $this;
    }

    /**
     * @return \SoapClient
     */
    public function getSoapClient (): \SoapClient
    {
        return $this->soapClient;
    }

    /**
     * @param \SoapClient $soapClient
     * @return CentralPayPlus
     */
    public function setSoapClient (\SoapClient $soapClient): CentralPayPlus
    {
        $this->soapClient = $soapClient;
        return $this;
    }

    /**
     * @return array
     */
    public function getSoapOptions (): array
    {
        return $this->soapOptions;
    }

    /**
     * @param array $soapOptions
     * @return CentralPayPlus
     */
    public function setSoapOptions (array $soapOptions): CentralPayPlus
    {
        $this->soapOptions = $soapOptions;
        return $this;
    }

    public function calculateHashValue(){
        $hashValue = '';
        return $hashValue;
    }

    public function makeRequest(){

    }

    public function parseResponse(){

    }

}