<?php
// require '../vendor/autoload.php';
// use Firebase\FirebaseLib;

// $firebase = new \Firebase\FirebaseLib($GLOBALS['firebaseBaseURI'], $_COOKIE['userIdToken']);

// $user = $firebase->get('users/' . $_GET['id']);
// $user = json_decode($user);

// //CHECK THEY'RE ALLOWED TO VIEW THE FILE
// if ($user->error) {
//     header('Location: /');
//     die();
// }

// //CREATE PDF
// $proof = new ProofOfAuthorization(
//     $user->signature,
//     $user->signatureTimestamp,
//     $user->signatureIP,
//     $user->signatureIPFromHeaders
// );

// //DISPLAY PDF
// $proof->Output();






// $app->get("/authorizationPDF/{userId}", function ($request, $response, $args) {

//     $firebase = new \Firebase\FirebaseLib($GLOBALS['firebaseBaseURI'], $_COOKIE['userIdToken']);
    
//     $user = $firebase->get('users/' . $args['userId']);
//     // die(var_dump($user));

//     $proof = new ProofOfAuthorization($user->signature, $user->signatureTimestamp, $user->signatureIP, $user->signatureIPFromHeaders);

//     $proof->Output();

//     return $response;
// });
