<?php

namespace Inspetor;

use Inspetor\Exception\TrackerException;
use Snowplow\Tracker\Tracker;
use Snowplow\Tracker\Subject;
use Snowplow\Tracker\Emitters\SyncEmitter;


class SnowplowManager {
    /**
     * @var array
     */
    private $default_config;

    /**
     * @var array
     */
    private $company_config;

    /**
     * @var Snowplow\Tracker\Emitters\SyncEmitter;
     */
    private $emitter;

    /**
     * @var Snowplow\Tracker\Subject;
     */
    private $subject;

    /**
     * @var Snowplow\Tracker\Tracker;
     */
    private $tracker;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->company_config = $config;
        $this->default_config = include('config.php');
        $this->default_config = $this->default_config['inspetor_config'];

        $this->setupTracker();
    }

    public function __destruct()
    {
        $this->flush();
    }

    public function flush()
    {
        $this->tracker->flushEmitters();
        return;
    }

    public function getTracker() {
        return $this->tracker;
    }

    /**
     * @param array  $config Config from main application
     * @return array
     */
    private function setupTracker() {
        $company_config = $this->setupConfig($this->company_config);

        $this->emitter = new SyncEmitter(
            $company_config['collectorHost'],
            $company_config['protocol'],
            $company_config['emitMethod'],
            $company_config['bufferSize'],
            $company_config['debugMode']
        );
        $this->subject = new Subject();
        $this->tracker = new Tracker(
            $this->emitter,
            $this->subject,
            $company_config['trackerName'],
            $company_config['appId'],
            $company_config['encode64']
        );
    }

    /**
     * @param array  $config Config from main application
     * @return array
     * @throws TrackerException
     */
    private function setupConfig($config) {
        if (!($config['trackerName']) || !($config['appId'])) {
            throw new TrackerException(9001);
        }

        $keys = [
            'collectorHost',
            'protocol',
            'emitMethod',
            'bufferSize',
            'debugMode',
            'encode64'
        ];

        foreach ($keys as $item) {
            $config = $config + array($item => $this->default_config[$item]);
        }

        if(array_key_exists('devEnv', $config)) {
            if ($config['devEnv'] == true) {
                $config['collectorHost'] = $this->default_config['collectorHostDev'];
            }
        }

        if(array_key_exists('inspetorEnv', $config)) {
            if ($config['inspetorEnv'] == true) {
                $config['collectorHost'] = 'test';
            }
        }

        return $config;
    }
}
