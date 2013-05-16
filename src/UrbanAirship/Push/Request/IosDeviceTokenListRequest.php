<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 3:33 PM
 */

namespace UrbanAirship\Push\Request;

use UrbanAirship\Push\Url\IosUrl;

/**
 * Get a list of device tokens for the give application
 * Class IosDeviceTokenListRequest
 * @package UrbanAirship\Push\Request
 */
class IosDeviceTokenListRequest extends UARequest
{

    private $nextPageUrl;

    /**
     * Set the URL for the next page of tokens. This URL will be used instead
     * of the device token URL.
     * @param $nextPageUrl string URL for the next page of device tokens.
     * @return $this
     */
    public function setNextPageUrl($nextPageUrl)
    {
        $this->nextPageUrl = $nextPageUrl;
        return $this;
    }

    public static function request()
    {
        return new IosDeviceTokenListRequest();
    }

    public function buildRequest()
    {
        if (is_null($this->nextPageUrl)) {
            $url = IosUrl::iosDeviceTokenList();
        }
        else {
            $url = $this->nextPageUrl;
        }
        return $this->basicAuthRequest($url);
    }

    public function send()
    {
        return $this->buildRequest()->send();
    }

}