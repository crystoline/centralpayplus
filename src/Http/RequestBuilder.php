<?php

namespace UplDevTeam\CentralPayPlus\Http;

use FluidXml\FluidXml;

class RequestBuilder
{
    protected $interface;
    protected $request;
    protected $requestMethod;

    public $payload = [ ];
    public $sentargs = [ ];

    public function __construct($requestMethod, $payload)
    {
        $this->requestMethod = $requestMethod;
        $this->payload = $payload;
    }

    public function build()
    {
        $request = new FluidXml( ucfirst($this->requestMethod));

        $request->addChild($this->payload);

        //$request->addChild('HashValue', hash_hmac('SHA256', $request->xml(), hex2bin('F1AF5921013C0B9E6310E317F5B9F29E')));
        //sha256($request->xml().'67651F8E63889980F83AD46C3DB0A27B');
        $request->addChild('HashValue', hash_hmac('SHA256',$request->xml(),'67651F8E63889980F83AD46C3DB0A27B'));
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
