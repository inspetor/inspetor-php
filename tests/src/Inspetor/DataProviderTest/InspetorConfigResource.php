<?php


namespace Ingresse\Test\Inspetor\DataProviderTest;

class InspetorConfigResource
{
    public static function getInspetorConfig()
    {
        return array(
            'trackerName' => 'ingresse.api',
            'appId' => 'test',
        );
    }
}
