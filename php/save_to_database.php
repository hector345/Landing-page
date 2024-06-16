<?php

function saveToDatabase($nombre, $email, $telefono, $ciudad)
{
    $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASS'];
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    try {
        $pdo = new PDO($dsn, $username, $password, $options);

        // Verificar si el contacto ya existe
        $sql = 'SELECT * FROM contacts WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $existingContact = $stmt->fetch();

        // Si el contacto ya existe, retornar false
        if ($existingContact) {
            return true;
        }

        // Si el contacto no existe, insertarlo
        $sql = 'INSERT INTO contacts (nombre, email, telefono, ciudad, created_at) VALUES (:nombre, :email, :telefono, :ciudad, :created_at)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':telefono' => $telefono,
            ':ciudad' => $ciudad,
            ':created_at' => date('Y-m-d H:i:s') // Añade la fecha y hora actual
        ]);

        return true;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}