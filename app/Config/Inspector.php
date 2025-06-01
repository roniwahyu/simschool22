<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Inspector extends BaseConfig
{
    /**
     * Inspector ingestion key.
     *
     * @var string
     */
    public string $ingestionKey;

    /**
     * Enable or disable Inspector.
     *
     * @var bool
     */
    public bool $enabled = true;

    /**
     * Inspector API URL.
     *
     * @var string
     */
    public string $url = 'https://app.inspector.dev';

    /**
     * Transport method.
     *
     * @var string
     */
    public string $transport = 'http';

    /**
     * Additional options.
     *
     * @var array
     */
    public array $options = [];

    /**
     * Maximum number of items to send.
     *
     * @var int
     */
    public int $maxItems = 100;

    public function __construct()
    {
        $this->ingestionKey = ENV('inspector.ingestionKey', '');
    }
}
