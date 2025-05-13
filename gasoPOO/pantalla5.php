<?php
include('./Repostatge.php');
include('./autoload.php');
include('./conn.php');
session_start();

// Comprovem si s'ha enviat el mètode de pagament
if (isset($_POST['pagament'])) {
    $_SESSION['repostatge']->pagament = $_POST['pagament']; // Guardem el mètode de pagament
}
// Comprovem si el botó "Nova Operació" ha estat premut
if (isset($_POST['nova_operacio'])) {
    // Destruïm la sessió i redirigim a la pàgina inicial
    session_destroy();
    header("Location: pantalla1.php");
    exit(); // Assegura't que la redirecció es fa immediatament
}
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>bonArea</title>
    <link rel="stylesheet" href="./css/cssPAG5.css">
    <style>
        .nova-operacio {
            background-color: #80c4ff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            border: none;
        }
    </style>
</head>

<body>
    <div class="header">bonArea</div>
    <div class="container">
        <h1>Resum de l'Operació</h1>

        <div class="summary-box">
            <p><strong>Surtidor:</strong> <?php echo $_SESSION['repostatge']->surtidor; ?></p>
        </div>
        <div class="summary-box">
            <p><strong>Gasolina:</strong> <?php echo $_SESSION['repostatge']->combustible; ?></p>
        </div>
        <div class="summary-box">
            <p><strong>Quantitat:</strong> <?php echo $_SESSION['repostatge']->quantitat; ?> Euros</p>
        </div>
        <div class="summary-box">
            <p><strong>Tipus de pagament:</strong> <?php echo $_SESSION['repostatge']->pagament; ?></p>
        </div>

    </div>
    <br>
    <a href="pantalla4.php"> Tornar</a>

    <!-- Botó per iniciar una nova operació -->
    <form action="pantalla1.php" method="post">
        <button class="nova-operacio" type="submit" name="nova_operacio">Nova Operació</button>
    </form>
    <form action="pantalla5.php" method="post">
        <button type="submit" name="pagar"
            style="background-color:#4CAF50;color:white;padding:1%;border-radius:5px;cursor:pointer;">
            Pagar
        </button>
    </form>
    <?php
    if (isset($_POST['pagar'])) {
        $combustible = $_SESSION['repostatge']->combustible;
        $quantitat = $_SESSION['repostatge']->quantitat;
        $surtidor = $_SESSION['repostatge']->surtidor;
        $fet = false;

        $stmt = $mysqli->prepare("INSERT INTO Surtidor (Combustible, Quantitat, Surtidors, Fet) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $combustible, $quantitat, $surtidor, $fet);
        $insercioExitosa = $stmt->execute();

        $stmt->close();
        $mysqli->close();
        header("Location: ../dispensador/dispensador.php");
    }
    ?>
</body>

</html>