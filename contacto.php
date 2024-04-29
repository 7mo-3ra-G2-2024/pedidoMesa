<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Contacto</h1>
    <div id="contacto">
        <form action="procesar_contacto.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" required></textarea>
            <button type="submit">Enviar Mensaje</button>
        </form>
    </div>
    <footer>
    <p>Correo Electrónico: rompeniebla2015@gmail.com</p>
    <p>Teléfono: 11 3492-7506</p>
    </footer>
</body>
</html>
