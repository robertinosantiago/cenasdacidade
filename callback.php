<?php
//Include Composer's autoloader
include 'vendor/autoload.php';

//Build configuration array
$config = [
    //Location where to redirect users once they authenticate with Facebook
    //For this example we choose to come back to this same script
    'callback' => 'http://localhost/cenasdacidade/callback.php',

    //Facebook application credentials
    'keys' => [
        'id'     => '...', //Required: your Facebook application id
        'secret' => '...'  //Required: your Facebook application secret
    ]
];

try {
    //Instantiate Facebook's adapter directly
    $adapter = new Hybridauth\Provider\Facebook($config);

    //Attempt to authenticate the user with Facebook
    $adapter->authenticate();

    //Returns a boolean of whether the user is connected with Facebook
    $isConnected = $adapter->isConnected();

    //Retrieve the user's profile
    $userProfile = $adapter->getUserProfile();

    //Inspect profile's public attributes
    var_dump($userProfile);

    //Disconnect the adapter
    $adapter->disconnect();
}
catch(\Exception $e){
    echo 'Oops, we ran into an issue! ' . $e->getMessage();
}
