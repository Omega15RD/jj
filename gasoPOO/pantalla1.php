<?php
include('./Repostatge.php');
include('./autoload.php');
session_start();

// Incloem la classe Repostatge

// Comprovem si ja existeix l'objecte Repostatge a la sessió, si no, el creem
if (!isset($_SESSION['repostatge'])) {
    $_SESSION['repostatge'] = new Repostatge();
}

if (isset($_GET['error']) && $_GET['error'] == 'expiracio') {
    echo "<p style='color:red;'>La teva sessió ha caducat per inactivitat.</p>";
}

// Guardem l'horari de la selecció del surtidor
echo "<script>sessionStorage.setItem('seleccioHora', Date.now());</script>";
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>bonArea</title>
    <link rel="stylesheet" href="./css/cssPAG1.css">
</head>

<body>
    <div class="header">Gasolinera</div>
    <h1>Selecciona el surtidor</h1>
    <form action="pantalla2.php" method="POST">
        <div class="container">
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <button type="submit" name="surtidor" value="<?php echo $i; ?>" class="surtidor">
                    <?php echo $i; ?>
                </button>
            <?php endfor; ?>
        </div>
    </form>
</body>
<script>
        // Funció per comprovar si el temps ha passat més d'un minut
        function comprovarTemps() {
            var horaSeleccio = sessionStorage.getItem('seleccioHora');
            var tempsTranscorregut = (Date.now() - horaSeleccio) / 1000; // Temps en segons
            if (tempsTranscorregut > 60) {
                // Si han passat més de 60 segons, redirigim a la pantalla inicial
                window.location.href = "pantalla1.php";
            }
        }

        // Cridem la funció de comprovació cada segon
        setInterval(comprovarTemps, 1000);
    </script>
</html>
