<?
/*if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}*/

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
	$client->setRedirectUri('https://' . $_SERVER['HTTP_HOST'] . '/admin/');
    $client->setApplicationName('SAGUARO Google Calendar');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $client->setAuthConfig("".$_SERVER['DOCUMENT_ROOT']."/SaguaroCalendario.json");
    $client->setAccessType('online');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = "".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-token/".$_SESSION['sysusu_numeroUnico']."/token.json";
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }
		// If there is no previous token or it's expired.
		if ($client->isAccessTokenExpired()) {
			// Refresh the token if possible, else fetch a new one.
			if ($client->getRefreshToken()) {
				$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
			} else {
				// Request authorization from the user.
				$authUrl = $client->createAuthUrl();
				if(trim($_GET['code'])=="") { 
					echo "<script>window.open('".$authUrl."','_self','');</script>";
				} else {
					echo "<script>window.open('https://" . $_SERVER['HTTP_HOST'] . "/admin/','_self','');</script>";
				}
				#printf("Open the following link in your browser:\n%s\n", $authUrl);
				#print 'Enter verification code: ';
				$authCode = $_GET['code'];
				//$authCode = trim(fgets(STDIN));
	
				// Exchange authorization code for an access token.
				$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
				$client->setAccessToken($accessToken);
	
				// Check to see if there was an error.
				if (array_key_exists('error', $accessToken)) {
					throw new Exception(join(', ', $accessToken));
				}
			}
			// Save the token to a file.
			if (!file_exists(dirname($tokenPath))) {
				mkdir(dirname($tokenPath), 0755, true);
			}
			file_put_contents($tokenPath, json_encode($client->getAccessToken()));

	}
    return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);
