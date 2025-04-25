<?php
include('./Repostatge.php');
include('./autoload.php');
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

</body>

</html>