<?php
include('./Repostatge.php');
include('./autoload.php');
session_start();



// Comprovem si s'ha enviat una quantitat
if (isset($_POST['quantitat'])) {
    $_SESSION['repostatge']->quantitat = $_POST['quantitat']; // Actualitzem la quantitat a l'objecte
}

?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>bonArea</title>
    <link rel="stylesheet" href="./css/cssPAG3.css">
    <style>
        .keyboard {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            width: 150px;
            margin: 20px auto;
        }

        .keyboard button {
            padding: 10px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
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
    <h1>Introduïu la quantitat</h1>
    <p><strong>Gasolina seleccionada:</strong> <?php echo htmlspecialchars($_SESSION['repostatge']->combustible); ?></p>

    <form action="pantalla4.php" method="POST">
        <input type="text" name="quantitat" id="quantitat" class="display"
            value="<?php echo isset($_SESSION['repostatge']->quantitat) ?>" readonly>

        <div class="keyboard">
            <button type="button" onclick="addNumber(1)">1</button>
            <button type="button" onclick="addNumber(2)">2</button>
            <button type="button" onclick="addNumber(3)">3</button>
            <button type="button" onclick="addNumber(4)">4</button>
            <button type="button" onclick="addNumber(5)">5</button>
            <button type="button" onclick="addNumber(6)">6</button>
            <button type="button" onclick="addNumber(7)">7</button>
            <button type="button" onclick="addNumber(8)">8</button>
            <button type="button" onclick="addNumber(9)">9</button>
            <button type="button" onclick="addNumber(0)" style="grid-column: span 3;">0</button>
        </div>

        <div class="controls">
            <button type="button" class="delete" onclick="deleteNumber()">Esborra</button>
            <button type="submit" class="confirm">Confirma</button>
        </div>
    </form>

    <br>
    <a href="pantalla2.php"> Tornar</a>

    <script>
        function addNumber(num) {
            let input = document.getElementById("quantitat");
            if (input.value.length < 6) {
                input.value += num;
                sessionStorage.setItem("quantitat", input.value);
            }
        }

        function deleteNumber() {
            let input = document.getElementById("quantitat");
            input.value = input.value.slice(0, -1);
            sessionStorage.setItem("quantitat", input.value);
        }

        document.addEventListener("DOMContentLoaded", function () {
            let input = document.getElementById("quantitat");
            if (sessionStorage.getItem("quantitat")) {
                input.value = sessionStorage.getItem("quantitat");
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let input = document.getElementById("quantitat");
            let confirmButton = document.querySelector(".confirm");
            let errorMessage = document.createElement("p");
            errorMessage.style.color = "red";
            errorMessage.style.display = "none"; // Ocultar al inicio
            errorMessage.textContent = "La quantitat ha de ser superior a 5.";
            confirmButton.parentNode.appendChild(errorMessage); // Agregar debajo del botón

            // Función para añadir número
            function addNumber(num) {
                if (input.value.length < 6) {
                    input.value += num;
                    sessionStorage.setItem("quantitat", input.value);
                }
            }

            // Función para borrar número
            function deleteNumber() {
                input.value = input.value.slice(0, -1);
                sessionStorage.setItem("quantitat", input.value);
            }

            // Asignar eventos a botones numéricos
            document.querySelectorAll(".button").forEach(button => {
                button.addEventListener("click", function () {
                    addNumber(this.textContent);
                });
            });

            // Asignar evento a botón de borrar
            document.querySelector(".delete").addEventListener("click", deleteNumber);

            // Validación antes de enviar el formulario
            confirmButton.addEventListener("click", function (event) {
                let cantidad = parseFloat(input.value);
                if (isNaN(cantidad) || cantidad <= 5) {
                    event.preventDefault(); // Bloquear el envío
                    errorMessage.style.display = "block"; // Mostrar mensaje de error
                } else {
                    errorMessage.style.display = "none"; // Ocultar error si es válido
                }
            });
        });
    </script>
</body>

</html>
