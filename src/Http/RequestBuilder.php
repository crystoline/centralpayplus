<?php

namespace Crystoline\CentralPayPlus\Http;

use FluidXml\FluidXml;

class RequestBuilder
{
    protected $interface;
    protected $request;
    protected $requestMethod;

    public $payload = [ ];
    public $sentargs = [ ];
    public $param_keys = [
       'generateOTPRequestNoReg' => 'GenerateOTPRequest',
       'validateOTPRequestNoReg' => 'ValidateOTPRequest'
    ];

    public function __construct($requestMethod, $payload)
    {
        $this->requestMethod = $requestMethod;
        $this->payload = $payload;
    }

    public function build()
    {
        $root_param = (array_key_exists($this->requestMethod, $this->param_keys))? $this->param_keys[$this->requestMethod] : ucfirst($this->requestMethod);
      //dd($root_param);
        $request = new FluidXml( $root_param );

        $request->addChild($this->payload);

        //$request->addChild('HashValue', hash_hmac('SHA256', $request->xml(), hex2bin('F1AF5921013C0B9E6310E317F5B9F29E')));
        $request->addChild('HashValue',hash('sha256',$request->xml().'67651F8E63889980F83AD46C3DB0A27B'));
       // sha256($request->xml().'67651F8E63889980F83AD46C3DB0A27B');
        //$request->addChild('HashValue', hash_hmac('SHA256',$request->xml(),'67651F8E63889980F83AD46C3DB0A27B'));
        $this->request = $request;
        //dump($this->request->xml());
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequest ()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    /*public function setRequest ($request)
    {
        $this->request = $request;
    }*/

}
