

<?php

$dns='mysql:host=localhost;dbname=testpts';
$user='root';
$Password='@lauris123';
try{
   $pdo=new PDO($dns,$user,$Password,[
     PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
   ]);

}catch(PDOException $e)
{
   echo 'ERROR:'. $e->getMessage();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    var_dump($email);
    exit;
    //INSERTION DANS LA TABLE 
    $statementCreate = $pdo->prepare('INSERT INTO articles 
VALUES (
DEFAULT,
:code,
:libelle,
:Datap,
:quantite,
:prix,
:seuil

) ');
      $statementCreate->bindValue(':code', $code);
      $statementCreate->bindValue(':libelle', $libelle);
      $statementCreate->bindValue(':Datap', $datap);
      $statementCreate->bindValue(':quantite', $quantite);
      $statementCreate->bindValue(':prix', $prix);
      $statementCreate->bindValue(':seuil', $Seuil);
      $statementCreate->execute();








    if (!empty($nom) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Merci <strong>$nom</strong> ! Votre message a bien été reçu à l'adresse <strong>$email</strong>.";
    } else {
        echo "Données invalides. Veuillez vérifier vos informations.";
    }
} else {
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link rel="stylesheet" href="/Respon.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Programmation Web</title>
</head>
<body>
    <header>
    </header>
    <div class="container">

        <h1>Gestion repas</h1>

        <div class="contenainer1">
      
    <form id="monFormulaire" method="POST" action="index1.php">
    <h2>Enregistrer</h2>
    <div class="erreur" id="erreur"></div>
    <input type="text" name="nom" id="nom" placeholder="nom repas" required>
    <input type="email" name="email" id="email" placeholder="lieu" required>
    <input type="email" name="email" id="email" placeholder="date" required>
    <button type="submit">Enregister</button>
    <div id="resultat"></div>
  </form>

        </div>

    </div>

    <script>
    document.getElementById('monFormulaire').addEventListener('submit', function(e) {
        e.preventDefault();

        // Réinitialisation
        document.getElementById('erreur').innerHTML = '';
        document.getElementById('resultat').innerHTML = '';

        // Récupération des champs
        const nom = document.getElementById('nom').value.trim();
        const email = document.getElementById('email').value.trim();

        // Validation simple
        if (nom.length < 4) {
            document.getElementById('erreur').innerHTML = "Le nom doit contenir au moins 2 caractères.";
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            document.getElementById('erreur').innerHTML = "Adresse email invalide.";
            return;
        }

        // Si tout est bon, envoi des données
        const formData = new FormData();
        formData.append("nom", nom);
        formData.append("email", email);

        fetch('index.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('resultat').innerHTML = data;
            document.getElementById('monFormulaire').reset();
        })
        .catch(error => {
            document.getElementById('resultat').innerHTML = "Erreur lors de l'envoi.";
            console.error('Erreur:', error);
        });
    });
  </script>
</body>
</html>