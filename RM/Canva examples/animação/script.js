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

    function Circulo(x, y, radius, color, vx, vy) {
        this.x = x;
        this.y = y;
        this.radius = radius;
        this.color = color;
        this.vx = vx;
        this.vy = vy;
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
    };

    let circulos = [];
    for (let i = 0; i < 50; i++) {
        let x = getRandomInt(50, canvas.width - 50);
        let y = getRandomInt(50, canvas.height - 50);
        let radius = getRandomInt(20, 50);
        let color = getRandomColorInSpectrum(colorSpectrum);
        let vx = getRandomNonZeroInt(-5, 5);
        let vy = getRandomNonZeroInt(-5, 5);
        circulos.push(new Circulo(x, y, radius, color, vx, vy));
    }

    function animacao() {
        requestAnimationFrame(animacao);

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        circulos.forEach(circulo => {
            circulo.atualizar(canvas);
            circulo.desenhar(ctx);
        });
    }

    animacao();
});
