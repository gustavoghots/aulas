$(document).ready(function() {
    function resizeCanvas() {
        let canvas = $('#myCanvas')[0];
        canvas.width = $(window).width();
        canvas.height = $(window).height();
    }
    resizeCanvas();
    $(window).resize(function() {
        resizeCanvas();
    });

    let canvas = $('#myCanvas')[0];
    let ctx = canvas.getContext('2d');

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function getRandomNonZeroInt(min, max) {
        let num;
        do {
            num = getRandomInt(min, max);
        } while (num === 0);
        return num;
    }

    const colorSpectrum = {
        rMin: 133, gMin: 15, bMin: 141, // RGB for #850F8D
        rMax: 228, gMax: 155, bMax: 255 // RGB for #E49BFF
    };

    function getRandomColorInSpectrum(spectrum) {
        let r = getRandomInt(spectrum.rMin, spectrum.rMax);
        let g = getRandomInt(spectrum.gMin, spectrum.gMax);
        let b = getRandomInt(spectrum.bMin, spectrum.bMax);
        return `rgb(${r}, ${g}, ${b})`;
    }

    function Circulo(x, y, radius, color, vx, vy, moving) {
        this.x = x;
        this.y = y;
        this.radius = radius;
        this.color = color;
        this.vx = vx;
        this.vy = vy;
        this.moving = moving;
        this.initialRadius = radius;
        this.growthRate = 0.1;
        this.maxRadius = this.initialRadius * 2;
        this.growthInterval = setInterval(() => {
            if (!this.moving && this.radius < this.maxRadius) {
                this.radius += this.growthRate;
            }
        }, 50);
    }

    Circulo.prototype.desenhar = function(ctx) {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.strokeStyle = this.color;
        ctx.fillStyle = this.color;
        ctx.fill();
        ctx.stroke();
        ctx.closePath();
    };

    Circulo.prototype.atualizar = function(canvas) {
        if (this.moving) {
            this.x += this.vx;
            this.y += this.vy;

            if (this.x + this.radius > canvas.width || this.x - this.radius < 0) {
                this.vx = -this.vx;
                this.color = getRandomColorInSpectrum(colorSpectrum);
            }
            if (this.y + this.radius > canvas.height || this.y - this.radius < 0) {
                this.vy = -this.vy;
                this.color = getRandomColorInSpectrum(colorSpectrum);
            }
        }
    };

    function criarCirculo() {
        let x = getRandomInt(50, canvas.width - 50);
        let y = getRandomInt(50, canvas.height - 50);
        let radius = getRandomInt(20, 50);
        let color = getRandomColorInSpectrum(colorSpectrum);
        let vx = Math.random() < 0.1 ? getRandomNonZeroInt(-5, 5) : 0; // 10% chance de movimento
        let vy = Math.random() < 0.1 ? getRandomNonZeroInt(-5, 5) : 0;
        let moving = vx !== 0 || vy !== 0;
        return new Circulo(x, y, radius, color, vx, vy, moving);
    }

    let circulos = [];
    while (circulos.length < 15) {
        circulos.push(criarCirculo());
    }

    function animacao() {
        requestAnimationFrame(animacao);

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        circulos.forEach(circulo => {
            circulo.atualizar(canvas);
            circulo.desenhar(ctx);
        });
    }

    function estourarCirculo(circulo) {
        // Remove a bolinha do array
        const index = circulos.indexOf(circulo);
        if (index !== -1) {
            clearInterval(circulo.growthInterval); // Limpa o intervalo de crescimento
            circulos.splice(index, 1);
            // Cria uma nova bolinha em posição aleatória
            if (circulos.length < 15) {
                circulos.push(criarCirculo());
            }
        }
    }

    canvas.addEventListener('click', function(event) {
        let rect = canvas.getBoundingClientRect();
        let x = event.clientX - rect.left;
        let y = event.clientY - rect.top;
        circulos.forEach(circulo => {
            let dx = x - circulo.x;
            let dy = y - circulo.y;
            if (Math.sqrt(dx * dx + dy * dy) < circulo.radius) {
                estourarCirculo(circulo);
            }
        });
    });

    animacao();
});
