<!-- dashboard.php -->
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Message différent selon le rôle
$roleMessages = [
    'administrateur' => 'Bienvenue Administrateur ' . $user['name'] . ' ! Vous avez accès à tous les outils d\'administration.',
    'formateur' => 'Bienvenue Formateur ' . $user['name'] . ' ! Préparez vos formations et gérez vos apprenants.',
    'apprenant' => 'Bienvenue Apprenant ' . $user['name'] . ' ! Accédez à vos cours et ressources.'
];

$message = $roleMessages[$user['role']] ?? 'Bienvenue ' . $user['name'] . ' - ' . $user['role'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        .message {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Application Sécurisée</h1>
        <div class="message"><?php echo $message; ?></div>
        
        <form method="POST" action="">
            <button type="submit" name="logout">Se déconnecter</button>
        </form>
    </div>
</body>
</html>