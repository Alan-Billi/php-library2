<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/13/13
 * Time: 2:51 PM
 */

namespace UrbanAirship\Push\Request;

use Httpful\Http;
use Httpful\Mime as Mime;
use Httpful\Request as Request;
use UrbanAirship\Push\Url\IosUrl;

class IosRegisterTokenRequest extends UARequest
{

    protected  $deviceToken;

    // Don't allow construction outside factory method
    protected  function  __construct(){}

    public function setRegistrationPayload($registrationPayload)
    {
        return $this->setPayload($registrationPayload);
    }

    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;
        return $this;
    }

    public function buildRegistrationRequest()
    {
        $request = $this->tokenBasedAuthenticatedRequest($this->deviceToken);
        $request->method(self::PUT);
        if (!is_null($this->payload)) {
            $request->mime(Mime::JSON)
                ->body($this->payload);
        }
        return $request;
    }

    public static function request() {
        return new IosRegisterTokenRequest();
    }

    public function send()
    {
        $request =$this->buildRegistrationRequest();
        return $request->send();
    }

}


