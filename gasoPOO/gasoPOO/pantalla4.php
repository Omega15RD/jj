<?php
include('./Repostatge.php');
include('./autoload.php');
session_start();


if (isset($_POST['quantitat'])) {
    $_SESSION['repostatge']->quantitat = $_POST['quantitat'];
}
// Comprovem si s'ha enviat el mètode de pagament
if (isset($_POST['pagament'])) {
    $_SESSION['repostatge']->pagament = $_POST['pagament']; // Guardem el mètode de pagament
}

?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>bonArea</title>
    <link rel="stylesheet" href="./css/cssPAG4.css">
    <script>
        // Comprovem si han passat més de 60 segons
        function comprovarTemps() {
            var horaSeleccio = sessionStorage.getItem('seleccioHora');
            var tempsTranscorregut = (Date.now() - horaSeleccio) / 1000;
            if (tempsTranscorregut > 60) {
                // Si han passat més de 60 segons, redirigim a la pantalla inicial
                window.location.href = "pantalla1.php";
            }
        }

        // Cridem la funció cada segon
        setInterval(comprovarTemps, 1000);
    </script>
</head>

<body>
    <div class="header">bonArea</div>
    <h1>Selecciona el mètode de pagament</h1>
    <p><strong>Quantitat:</strong> <?php echo isset($_SESSION['repostatge']->quantitat) ?> Euros</p>

    <form action="pantalla5.php" method="POST">
        <button type="submit" name="pagament" value="Efectiu" class="payment-option efectiu">Efectiu</button>
        <button type="submit" name="pagament" value="Targeta" class="payment-option targeta">Targeta</button>
    </form>

    <br>
    <a href="pantalla3.php"> Tornar</a>
</body>

</html>
