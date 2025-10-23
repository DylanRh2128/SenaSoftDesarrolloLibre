<?php
session_start();
include ("../../conexion.php");

// Verificar si hay datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pasajeros'])) {
    // Guardar los datos de los pasajeros en la sesión
    $_SESSION['datos_reserva'] = [
        'idVuelo' => $_POST['idVuelo'],
        'pasajeros' => $_POST['pasajeros']
    ];
}

// Verificar si tenemos los datos necesarios en la sesión
if (!isset($_SESSION['datos_reserva'])) {
    header('Location: reserva.php');
    exit;
}

// Obtener información del vuelo y capacidad del avión
$sql = "SELECT d.*, av.nombreAvion, a.nombreAerolinea, ma.capacidad, ma.modelo
        FROM disponibilidad d
        INNER JOIN aviones av ON d.idAvion = av.idAvion
        INNER JOIN aerolinea a ON av.idAerolinea = a.idAerolinea
        INNER JOIN modeloaviones ma ON av.idModeloA = ma.idModeloA
        WHERE d.idDisponibilidad = ?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['datos_reserva']['idVuelo']);
mysqli_stmt_execute($stmt);
$vuelo = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

// Obtener asientos ocupados
$sql = "SELECT asiento FROM tiquetes WHERE idVuelo = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['datos_reserva']['idVuelo']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$asientosOcupados = [];
while ($row = mysqli_fetch_assoc($result)) {
    $asientosOcupados[] = $row['asiento'];
}

// Contar pasajeros correctamente (pasajeros principales, no infantes)
$cantidadPasajeros = 0;
foreach ($_SESSION['datos_reserva']['pasajeros'] as $pasajero) {
    // Solo contar si tiene nombre (es un pasajero principal)
    if (isset($pasajero['nombres']) && !empty($pasajero['nombres'])) {
        $cantidadPasajeros++;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Asientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/procesar_reserva.css">

</head>
<body class="bg-light">
    <div class="container py-5">
        <!-- Pasos del proceso -->
        <div class="progress-steps">
            <div class="step completed">1. Búsqueda</div>
            <div class="step completed">2. Datos de Pasajeros</div>
            <div class="step active">3. Selección de Asientos</div>
            <div class="step">4. Confirmación</div>
        </div>

        <!-- Información del vuelo -->
        <div class="flight-info">
            <h4 class="card-title"><?= htmlspecialchars($vuelo['nombreAerolinea']) ?> — <?= htmlspecialchars($vuelo['nombreAvion']) ?></h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Origen:</strong> <?= htmlspecialchars($vuelo['origen']) ?></p>
                    <p><strong>Destino:</strong> <?= htmlspecialchars($vuelo['destino']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Fecha:</strong> <?= htmlspecialchars($vuelo['fecha']) ?></p>
                    <p><strong>Horario:</strong> <?= htmlspecialchars($vuelo['horaSalida']) ?> - <?= htmlspecialchars($vuelo['horaLlegada']) ?></p>
                </div>
            </div>
        </div>

        <h2 class="mb-4">Selección de Asientos</h2>
        <p>Por favor, seleccione <?= $cantidadPasajeros ?> asiento(s) para los pasajeros.</p>

        <!-- Leyenda de asientos -->
        <div class="d-flex mb-4">
            <div class="leyenda-item">
                <div class="leyenda-color" style="background-color: white; border: 2px solid #dee2e6"></div>
                <span>Disponible</span>
            </div>
            <div class="leyenda-item">
                <div class="leyenda-color" style="background-color: #198754"></div>
                <span>Seleccionado</span>
            </div>
            <div class="leyenda-item">
                <div class="leyenda-color" style="background-color: #dc3545"></div>
                <span>Ocupado</span>
            </div>
        </div>

        <form action="confirmar_reserva.php" method="POST" id="asientosForm">
            <input type="hidden" name="asientosSeleccionados" id="asientosSeleccionados">
            
            <!-- Contenedor de asientos -->
            <div class="asientos-container" id="asientosContainer">
                <!-- Los asientos se generarán dinámicamente con JavaScript -->
            </div>

            <!-- Lista de pasajeros y sus asientos -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Asientos Seleccionados</h5>
                    <div id="asignacionAsientos">
                        <?php 
                        $indice = 1;
                        foreach ($_SESSION['datos_reserva']['pasajeros'] as $index => $pasajero): 
                            if (isset($pasajero['nombres']) && !empty($pasajero['nombres'])):
                        ?>
                            <div class="mb-2" data-pasajero-index="<?= $indice - 1 ?>">
                                <span><strong>Pasajero <?= $indice ?>:</strong> <?= htmlspecialchars($pasajero['nombres']) ?> <?= htmlspecialchars($pasajero['primerApellido']) ?></span>
                                <span class="asiento-asignado text-primary fw-bold"> - Pendiente de asignar</span>
                            </div>
                        <?php 
                            $indice++;
                            endif;
                        endforeach; 
                        ?>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="reserva.php?vuelo=<?= $_SESSION['datos_reserva']['idVuelo'] ?>" class="btn btn-outline-secondary">Volver</a>
                <button type="submit" class="btn btn-primary btn-lg" id="btnContinuar" disabled>
                    Continuar a Confirmación
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Configuración del mapa de asientos
        const capacidad = <?= $vuelo['capacidad'] ?>;
        const asientosOcupados = <?= json_encode($asientosOcupados) ?>;
        const cantidadPasajeros = <?= $cantidadPasajeros ?>;
        let asientosSeleccionados = [];

        console.log('Capacidad del avión:', capacidad);
        console.log('Asientos ocupados:', asientosOcupados);
        console.log('Cantidad de pasajeros:', cantidadPasajeros);

        // Configuración del layout del avión
        const filas = Math.ceil(capacidad / 6); // 6 asientos por fila (3-3)
        const container = document.getElementById('asientosContainer');
        
        // Establecer el grid basado en el número de columnas (3 + pasillo + 3)
        container.style.gridTemplateColumns = 'repeat(7, 1fr)';

        // Generar asientos
        let asientoActual = 1;
        for (let fila = 0; fila < filas && asientoActual <= capacidad; fila++) {
            // Letras para las filas
            const letraFila = String.fromCharCode(65 + fila);
            
            for (let col = 1; col <= 6 && asientoActual <= capacidad; col++) {
                if (col === 4) {
                    // Crear pasillo después de la columna 3
                    const pasillo = document.createElement('div');
                    pasillo.className = 'pasillo';
                    container.appendChild(pasillo);
                    continue;
                }

                const asiento = document.createElement('div');
                const numeroAsiento = letraFila + col;
                asiento.className = 'asiento';
                asiento.textContent = numeroAsiento;
                asiento.setAttribute('data-seat', numeroAsiento);
                
                // Verificar si el asiento está ocupado
                if (asientosOcupados.includes(numeroAsiento)) {
                    asiento.classList.add('ocupado');
                } else {
                    asiento.addEventListener('click', () => seleccionarAsiento(asiento, numeroAsiento));
                }
                
                container.appendChild(asiento);
                asientoActual++;
            }
        }

        function seleccionarAsiento(elemento, numeroAsiento) {
            if (elemento.classList.contains('ocupado')) return;
            
            // Toggle selección
            if (elemento.classList.contains('seleccionado')) {
                elemento.classList.remove('seleccionado');
                asientosSeleccionados = asientosSeleccionados.filter(a => a !== numeroAsiento);
            } else {
                // Verificar si ya se alcanzó el máximo de asientos
                if (asientosSeleccionados.length >= cantidadPasajeros) {
                    alert('Ya ha seleccionado el número máximo de asientos permitido: ' + cantidadPasajeros);
                    return;
                }
                elemento.classList.add('seleccionado');
                asientosSeleccionados.push(numeroAsiento);
            }

            console.log('Asientos seleccionados:', asientosSeleccionados);
            
            // Actualizar asignación de asientos
            actualizarAsignacionAsientos();
            
            // Actualizar estado del botón continuar
            document.getElementById('btnContinuar').disabled = asientosSeleccionados.length !== cantidadPasajeros;
            
            // Actualizar campo oculto con asientos seleccionados
            document.getElementById('asientosSeleccionados').value = JSON.stringify(asientosSeleccionados);
        }

        function actualizarAsignacionAsientos() {
            const asignaciones = document.querySelectorAll('#asignacionAsientos .mb-2');
            asignaciones.forEach((elem, index) => {
                const asiento = asientosSeleccionados[index];
                const label = elem.querySelector('.asiento-asignado');
                if (asiento) {
                    label.textContent = ` - Asiento ${asiento}`;
                    label.classList.remove('text-primary');
                    label.classList.add('text-success');
                } else {
                    label.textContent = ' - Pendiente de asignar';
                    label.classList.remove('text-success');
                    label.classList.add('text-primary');
                }
            });
        }

        // Validar antes de enviar
        document.getElementById('asientosForm').addEventListener('submit', function(e) {
            if (asientosSeleccionados.length !== cantidadPasajeros) {
                e.preventDefault();
                alert('Por favor, seleccione exactamente ' + cantidadPasajeros + ' asiento(s) antes de continuar');
                return false;
            }
            
            console.log('Enviando formulario con asientos:', asientosSeleccionados);
            document.getElementById('asientosSeleccionados').value = JSON.stringify(asientosSeleccionados);
            return true;
        });
    </script>
</body>
</html>