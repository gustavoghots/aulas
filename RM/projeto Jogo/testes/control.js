$(document).ready(function () {
    const canvas = document.getElementById("animacao");
    const ctx = canvas.getContext("2d");

    const resizeCanvas = () => {
        canvas.width = $(window).width();
        canvas.height = $(window).height();
    };
    resizeCanvas();
    $(window).resize(resizeCanvas);

    const player = {
        x: 50,
        y: 50,
        width: 30,
        height: 30,
        color: "blue",
        speed: 5,
        velocityX: 0,
        velocityY: 0,
        maxVelocityY: 15,
        friction: 0.8,
        gravity: 1.2,
        gravityIncrement: 0.4,
        jumpForce: 12,
        grounded: false,
        canJump: true,
        jumpReleased: false,
        maxJumpTime: 0,
        jumpTime: 0,
    };

    // Definindo múltiplas plataformas com altura aumentada
    const platforms = [
        { x: 0, y: canvas.height - 20, width: canvas.width, height: 20, color: "green" },
        { x: 0, y: 500, width: 900, height: 130, color: "green" },
        { x: 400, y: 250, width: 100, height: 20, color: "green" }
    ];

    const keys = {};

    $(window).on("keydown", (e) => {
        keys[e.key] = true;

        if (e.key === "w" && player.grounded && player.canJump) {
            player.velocityY = -player.jumpForce;
            player.grounded = false;
            player.canJump = false;
            player.jumpReleased = false;
            player.jumpTime = 0;
        }
    });

    $(window).on("keyup", (e) => {
        keys[e.key] = false;

        if (e.key === "w") {
            player.jumpReleased = true;
        }
    });

    function applyPhysics() {
        player.velocityX *= player.friction;

        if (player.velocityY > player.maxVelocityY) {
            player.velocityY = player.maxVelocityY;
        }

        if (player.velocityY < 0 && !player.jumpReleased) {
            player.velocityY += player.gravity * 0.2; // Gravidade suave na subida
        } else {
            player.velocityY += player.gravity + player.gravityIncrement; // Gravidade maior na queda
        }

        player.x += player.velocityX;
        player.y += player.velocityY;
    }

    function handleMovement() {
        if (keys["a"] && !keys["d"]) {
            player.velocityX = -player.speed;
        } else if (keys["d"] && !keys["a"]) {
            player.velocityX = player.speed;
        } else {
            player.velocityX = 0; // Para o jogador se ambas as teclas não estão pressionadas
        }
    }

    function checkCollisions() {
        player.grounded = false; // Reseta a verificação de chão
    
        platforms.forEach(platform => {
            // Verifica se há colisão entre o jogador e a plataforma
            const isColliding =
                player.x < platform.x + platform.width &&
                player.x + player.width > platform.x &&
                player.y < platform.y + platform.height &&
                player.y + player.height > platform.y;
    
            if (isColliding) {
                // Calcular as distâncias para ajustar a posição do jogador
                const overlapX = Math.min(
                    player.x + player.width - platform.x,
                    platform.x + platform.width - player.x
                );
                const overlapY = Math.min(
                    player.y + player.height - platform.y,
                    platform.y + platform.height - player.y
                );
    
                // Determinar a direção da colisão
                if (overlapX < overlapY) {
                    // Colisão lateral
                    if (player.x + player.width / 2 < platform.x + platform.width / 2) {
                        // Colidindo pela esquerda
                        player.x = platform.x - player.width; // Posiciona o jogador à esquerda da plataforma
                    } else {
                        // Colidindo pela direita
                        player.x = platform.x + platform.width; // Posiciona o jogador à direita da plataforma
                    }
                } else {
                    // Colisão vertical
                    if (player.velocityY > 0) {
                        // Se está caindo
                        player.y = platform.y - player.height; // Posiciona o jogador em cima da plataforma
                        player.velocityY = 0; // Reseta a velocidade vertical
                        player.grounded = true; // O jogador agora está no chão
                        player.canJump = true; // Permite pulo novamente
                    } else if (player.velocityY < 0) {
                        // Se está pulando
                        player.y = platform.y + platform.height; // Move o jogador para cima da plataforma
                        player.velocityY = 0; // Reseta a velocidade vertical
                    }
                }
            }
        });
    
        // Limites do canvas
        if (player.x < 0) player.x = 0;
        if (player.x + player.width > canvas.width) player.x = canvas.width - player.width;
        
    }
    
    
    
    
    

    function update() {
        handleMovement();
        applyPhysics();
        checkCollisions();
    }

    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Desenha as plataformas
        platforms.forEach(platform => {
            ctx.fillStyle = platform.color;
            ctx.fillRect(platform.x, platform.y, platform.width, platform.height);
        });

        // Desenha o jogador
        ctx.fillStyle = player.color;
        ctx.fillRect(player.x, player.y, player.width, player.height);
    }

    function gameLoop() {
        update();
        draw();
        requestAnimationFrame(gameLoop);
    }

    gameLoop();
});
