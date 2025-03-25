<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include('db.php');
$user_id = $_SESSION['user'];

// Pega todas as mensagens
$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <script src="https://cdn.socket.io/4.1.3/socket.io.min.js"></script>
</head>
<body>
    <h1>Welcome to the Chat</h1>

    <div id="messages">
        <?php foreach ($messages as $message): ?>
            <p><strong><?= $message['username'] ?>:</strong> <?= $message['message'] ?></p>
        <?php endforeach; ?>
    </div>

    <form id="chatForm">
        <input type="text" id="message" placeholder="Type a message..." required>
        <button type="submit">Send</button>
    </form>

    <script>
        const socket = io('http://localhost:3000'); // URL do servidor Node.js
        const form = document.getElementById('chatForm');
        const messageInput = document.getElementById('message');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const message = messageInput.value;

            // Envia a mensagem para o servidor Node.js via WebSocket
            socket.emit('sendMessage', message);

            messageInput.value = '';
        });

        socket.on('newMessage', (message) => {
            const messageElement = document.createElement('p');
            messageElement.textContent = message;
            document.getElementById('messages').appendChild(messageElement);
        });
    </script>
</body>
</html>
