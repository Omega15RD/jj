<?php
include('./Repostatge.php');
include('./autoload.php');
session_start();



// Comprovem si s'ha enviat una selecció de surtidor
if (isset($_POST['surtidor'])) {
    $_SESSION['repostatge']->surtidor = $_POST['surtidor']; // Actualitzem el surtidor a l'objecte
}

// Si s'ha seleccionat el tipus de gasolina, l'actualitzem a l'objecte Repostatge
if (isset($_POST['gasolina'])) {
    $_SESSION['repostatge']->combustible = $_POST['gasolina'];
}
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>bonArea</title>
    <link rel="stylesheet" href="./css/cssPAG2.css">
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
    <h1>Selecciona el tipus de gasolina</h1>
    <p><strong>Surtidor seleccionat:</strong> <?php echo htmlspecialchars($_SESSION['repostatge']->surtidor); ?></p>

    <!-- Form per seleccionar el tipus de gasolina -->
    <form action="pantalla3.php" method="POST">
        <div class="container">
            <button type="submit" name="gasolina" value="95 sense plom" class="option green-strong">
                95 <span>Sense Plom</span>
            </button>
            <button type="submit" name="gasolina" value="98 sense plom" class="option green-light">
                98 <span>Sense Plom</span>
            </button>
            <button type="submit" name="gasolina" value="Gasiol" class="option black">
                A <span>Gasoli A</span>
            </button>
            <button type="submit" name="gasolina" value="AdBlue" class="option blue-light">
                Ad <span>Adblue</span>
            </button>
        </div>
    </form>

    <br>
    <a href="pantalla1.php"> Tornar</a>
</body>

</html>
