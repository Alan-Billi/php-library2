<?php

namespace UrbanAirship\Push;

use UrbanAirship\UALog;

class PushResponse
{
    public $ok = null;
    public $push_ids = null;
    public $schedule_ids = null;
    public $operation_id = null;
    public $payload = null;
    public $response = null;

    private $expected_keys = array('push_ids', 'schedule_ids', 'operation_id', 'ok');

    function __construct($response) {
        $payload = json_decode($response->raw_body, true);
        foreach ($this->expected_keys as $key) {
            if (array_key_exists($key, $payload)) {
                $this->$key = $payload[$key];
            }
        }
        $this->payload = $payload;
        $this->response = $response;
    }
}
