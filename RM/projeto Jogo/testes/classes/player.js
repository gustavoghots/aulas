class Player {
    constructor({ position, context, global, collisionBlocks }) {
        this.position = position;
        this.c = context;
        this.global = global;
        this.collisionBlocks = collisionBlocks;

        this.size = {
            height: 16,
            width: 16
        }
        this.velocity = {
            x: 0,
            y: 1
        }
    }

    draw() {
        this.c.fillStyle = 'red';
        this.c.fillRect(this.position.x, this.position.y, this.size.width, this.size.height);
    }

    update() {
        this.draw();

        // Aplica movimento com base na velocidade
        this.position.x += this.velocity.x;

        this.applyGravity();
        this.checkForCollisions();
    }

    applyGravity(){
        this.position.y += this.velocity.y;
    
        // Aplica gravidade
        this.velocity.y += this.global.gravity;
    
        // Verifica se o jogador colidiu com o chão
        if (this.position.y + this.size.height >= this.global.canvas.height) {
            // Ajusta a posição para exatamente em cima do chão
            this.position.y = this.global.canvas.height - this.size.height;
    
            // Zera a velocidade vertical ao tocar o chão
            this.velocity.y = 0;
        }
    }
    
    checkForCollisions() {
        for (let block of this.collisionBlocks) {
            const nextPositionX = this.position.x + this.velocity.x;
            const nextPositionY = this.position.y + this.velocity.y;
    
            const collisionDetected = (
                nextPositionX < block.position.x + block.size &&
                nextPositionX + this.size.width > block.position.x &&
                nextPositionY < block.position.y + block.size &&
                nextPositionY + this.size.height > block.position.y
            );
    
            if (collisionDetected) {
                console.log('Colisão detectada!', {
                    playerX: this.position.x,
                    playerY: this.position.y,
                    blockX: block.position.x,
                    blockY: block.position.y,
                });
    
                const overlapX = Math.min(
                    this.position.x + this.size.width - block.position.x,
                    block.position.x + block.size - this.position.x
                );
    
                const overlapY = Math.min(
                    this.position.y + this.size.height - block.position.y,
                    block.position.y + block.size - this.position.y
                );
    
                if (overlapX < overlapY) {
                    // Ajuste horizontal
                    if (this.velocity.x > 0) {
                        // Colisão pela direita
                        this.position.x = block.position.x - this.size.width; // Coloca o jogador à esquerda do bloco
                    } else {
                        // Colisão pela esquerda
                        this.position.x = block.position.x + block.size; // Coloca o jogador à direita do bloco
                    }
                    this.velocity.x = 0; // Zera a velocidade horizontal
                } else {
                    // Ajuste vertical
                    if (this.velocity.y > 0) {
                        // Colisão ao cair (parar em cima do bloco)
                        this.position.y = block.position.y - this.size.height; // Coloca o jogador em cima do bloco
                        this.velocity.y = 0; // Zera a velocidade vertical
                    } else {
                        // Colisão ao subir
                        if (this.position.y + this.size.height > block.position.y) {
                            this.position.y = block.position.y + block.size; // Coloca o jogador abaixo do bloco
                            this.velocity.y = 0; // Zera a velocidade vertical
                        }
                    }
                }
            }
        }
    }
    

    
}