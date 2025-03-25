const http = require('http');
const socketIo = require('socket.io');
const server = http.createServer();
const io = socketIo(server);

let users = {};

io.on('connection', (socket) => {
    console.log('User connected: ' + socket.id);

    // Recebe uma mensagem do cliente
    socket.on('sendMessage', (message) => {
        console.log('Message received: ' + message);

        // Envia a mensagem para todos os usuários conectados
        io.emit('newMessage', message);
    });

    // Evento quando um usuário se desconecta
    socket.on('disconnect', () => {
        console.log('User disconnected: ' + socket.id);
    });
});

server.listen(3000, () => {
    console.log('Server listening on port 3000');
});
