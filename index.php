<?php
// Replace 'YOUR_CONSUMER_KEY' and 'YOUR_CONSUMER_SECRET' with your Daraja API credentials
$consumerKey = 'bFpQWjU8WGIhsAOTHvdcmfsABzfdVr9NDk7fInCDDA2Acpzw';
$consumerSecret = 'hGY5nTZGBgedFSHDVDHmtcHhm4XdCst71g2LuA7EOPzjanZkwycNI7Yn34971OnN';

// M-Pesa Daraja API URL for access token request (use sandbox URL or production URL as needed)
$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

// Initialize a cURL session
$curl = curl_init($url);

// Set headers, including the authorization header with Base64 encoded credentials
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret)
]);

// Additional cURL options
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Ensure we get the response as a string
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification for sandbox testing (use true for production)

// Execute the cURL request
$response = curl_exec($curl);
$err = curl_error($curl);

// Close the cURL session
curl_close($curl);

// Check for errors
if ($err) {
    echo "cURL Error: " . $err;
} else {
    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if the 'access_token' key exists in the response data
    if (isset($data['access_token'])) {
        $accessToken = $data['access_token'];
        echo "Access Token: " . $accessToken;
    } else {
        echo "Failed to retrieve access token. Response: " . $response;
    }
}
?>
