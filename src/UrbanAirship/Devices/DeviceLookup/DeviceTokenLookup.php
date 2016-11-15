<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

namespace UrbanAirship\Devices\DeviceLookup;


class DeviceTokenLookup
{

    const LOOKUP_URL = "/api/device_tokens/";

    function __construct($airship, $deviceId)
	{
		$this->airship = $airship;
		$this->lookup_url = $airship->buildUrl(static::LOOKUP_URL.$deviceId);
	}

	function deviceTokenInfo() {
		$url = $this->lookup_url;
		$response = $this->airship->request("GET", null, $url, null, 3);
        print $response->raw_body."\n";
	}

}