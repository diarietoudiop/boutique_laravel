<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .header h1 {
            margin: 0;
        }

        .content {
            padding: 20px;
            color: #333333;
            line-height: 1.6;
        }

        .content h2 {
            color: #4CAF50;
        }

        .content p {
            margin: 10px 0;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f4f4f4;
            color: #777777;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Bienvenue sur {{ config('app.name') }}</h1>
    </div>
    <div class="content">
        <h2>Bonjour {{ $user->prenom . ' ' . $user->nom }} !</h2> <!-- Correction ici -->
        <p>Nous sommes ravis de vous accueillir sur notre plateforme.</p>
        <p>Merci de vous être inscrit(e) et de rejoindre notre communauté.</p>
        <p>Vous pouvez dès à présent explorer notre site en cliquant sur le bouton ci-dessous :</p>
        <a href="{{ url('/') }}" class="button">Accéder à notre site</a>
        <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>
    </div>
    <div class="footer">
        <p>Merci d'utiliser notre application !</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
    </div>
</div>

</body>
</html>
