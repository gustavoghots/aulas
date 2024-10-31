class Plataform {
    constructor({ position, context }) {
        this.position = position;
        this.context = context; // Armazena o contexto
        this.size = 16;
    }

    draw() {
        this.context.fillStyle = 'rgba(0,0,255,0.5)';
        this.context.fillRect(
            this.position.x * this.size, 
            this.position.y * this.size, 
            this.size, 
            this.size
        );
    }

    update() {
        this.draw();
    }
}
