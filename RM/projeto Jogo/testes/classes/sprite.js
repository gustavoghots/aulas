class Sprite {
    constructor({ position, imageSrc, context }) {
        this.position = position;
        this.image = new Image();
        this.image.src = imageSrc;
        this.context = context; // Armazena o contexto
    }

    draw() {
        if (!this.image) return;
        this.context.drawImage(this.image, this.position.x, this.position.y);
    }

    update() {
        this.draw();
    }
}
