<?php

define('DB_HOSTNAME', 'hostname');
define('DB_DATABASE', 'database');
define('DB_USERNAME', 'username');
define('DB_PASSWORD', 'password');
/**
 * Build a configuration array to pass to `Hybridauth\Hybridauth`
 */
$config = [
  /**
   * Set the Authorization callback URL to https://path/to/hybridauth/examples/example_06/callback.php.
   * Understandably, you need to replace 'path/to/hybridauth' with the real path to this script.
   */
  'callback' => 'http://path/to/callback.php',
  'providers' => [
    'Google' => [
      'enabled' => true,
      'keys' => [
        'key' => '...',
        'secret' => '...',
      ],
      'scope' => 'email',
    ],
    'Facebook' => [
      'enabled' => true,
      'keys' => [
        'id' => '...',
        'secret' => '...',
      ],
    ],
  ],
];
