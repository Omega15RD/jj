<?php
include '../gasoPOO/conn.php';
$sql = "SELECT * FROM Surtidor ORDER BY ID DESC LIMIT 1";
$result = $mysqli->query($sql);

$quantitat = 0;
$combustible = '';
$surtidor = '';

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $quantitat = $row['Quantitat'];
    $combustible = $row['Combustible'];
    $surtidor = $row['Surtidors'];
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/50e712d75a.js" crossorigin="anonymous"></script>
    <title>Dispensador</title>
</head>

<body>
    <div class="container">
        <div class="infodispensador">
            <div class="info"style="background-color: white; border-radius:5px;">
                <h3 id="surtidor">Surtidor: <?php echo htmlspecialchars($surtidor); ?> </h3>
                <h2 id="euros">Euros: <?php echo htmlspecialchars($quantitat); ?> <i class="fa-solid fa-euro-sign"></i></h2>
                <p id="litros">Litros</p>
                
                <p>Carburant: <?php echo htmlspecialchars($combustible); ?></p>
                <p id="precioLitro">Preu: 1.31 e/l</p>
            </div> 
        </div>

        <div class="infedispensador">
            <button><i class="fa-solid fa-gas-pump" style="color: #00a6ff;"></i> Despenjar maniga</button>
            <button id="stop">Atura</button>
            <button id="continue" style="display: none;">Continua</button>
            <button><i class="fa-solid fa-gas-pump" style="color: #ff000d;"></i> Penjar maniga</button>
        </div>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const eurosElemento = document.querySelector(".infodispensador h2");
        const litrosElemento = document.getElementById("litros");
        const precioLitroTexto = document.getElementById("precioLitro").textContent;
        const despenjarBtn = document.querySelector(".infedispensador button:first-child");
        const penjarBtn = document.querySelector(".infedispensador button:last-child");

        const precioPorLitro = parseFloat(precioLitroTexto.match(/\d+(\.\d+)?/)[0]);
        const totalEuros = parseFloat(eurosElemento.textContent.match(/\d+(\.\d+)?/)[0]);
        const maxLitros = totalEuros / precioPorLitro;
        console.log(maxLitros);
        let litros = 0;
        let interval;

        despenjarBtn.addEventListener("click", function () {
            if (!interval) {
                interval = setInterval(() => {
                    if (litros <= maxLitros) {
                        litros += 0.1; // Incremento progresivo
                        litrosElemento.textContent = `Litros: ${litros.toFixed(2)}`;
                    } else {
                        clearInterval(interval);
                    }
                }, 100);
            }
        });

        penjarBtn.addEventListener("click", function () {
            clearInterval(interval);
            interval = null;
        });
    });

</script>

</html>