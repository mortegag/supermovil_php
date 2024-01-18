<?php
$host = "192.168.0.3"; // Replace with the IP address of your Android device
$port = 8080; // Use the same port as in the Java code

try {
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($socket === false) {
        die("Failed to create socket: " . socket_strerror(socket_last_error()));
    }

    $result = socket_connect($socket, $host, $port);
    if ($result === false) {
        die("Failed to connect to server: " . socket_strerror(socket_last_error($socket)));
    }

    // Read data from the server (e.g., camera images)
    while (true) {
        $imageSize = socket_read($socket, 4);
        $imageSize = unpack('N', $imageSize)[1];

        $imageData = socket_read($socket, $imageSize);

        // Process or display the image data
        $image = imagecreatefromstring($imageData);

        // Here, we resize the image for demonstration purposes
        $resizedImage = imagescale($image, 400, 300);

        // Output the image to the browser
        header('Content-Type: image/jpeg');
        imagejpeg($resizedImage);

        // Free up memory
        imagedestroy($image);
        imagedestroy($resizedImage);
    }

    socket_close($socket);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

