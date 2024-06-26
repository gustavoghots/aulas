$(document).ready(function() {
    function resizeCanvas() {
        var canvas = $('#myCanvas')[0];
        canvas.width = $(window).width();
        canvas.height = $(window).height();
        drawCircles();
    }

    function drawCircles() {
        var canvas = $('#myCanvas')[0];
        var ctx = canvas.getContext('2d');

        ctx.globalAlpha = 0.5;
        ctx.beginPath();
        ctx.arc(100, 100, 50, 0, Math.PI * 2);
        ctx.fillStyle = 'red';
        ctx.fill();
        ctx.save();

        var gradient = ctx.createLinearGradient(200, 50, 300, 150);
        gradient.addColorStop(0, 'green');
        gradient.addColorStop(1, 'blue');
        ctx.globalAlpha = 1.0;
        ctx.beginPath();
        ctx.arc(250, 100, 50, 0, Math.PI * 2);
        ctx.fillStyle = gradient;
        ctx.fill();
        ctx.save();

        var radialGradient = ctx.createRadialGradient(400, 100, 20, 400, 100, 50);
        radialGradient.addColorStop(0, 'yellow');
        radialGradient.addColorStop(1, 'purple');
        ctx.beginPath();
        ctx.arc(400, 100, 50, 0, Math.PI * 2);
        ctx.fillStyle = radialGradient;
        ctx.fill();

        

        ctx.globalAlpha = 0.6;
        ctx.beginPath();
        ctx.arc(100, 250, 50, 0, Math.PI * 2);
        ctx.fillStyle = gradient;
        ctx.fill();

        ctx.beginPath();
        ctx.arc(250, 250, 50, 0, Math.PI * 2);
        ctx.restore();
        ctx.fill();

        ctx.globalAlpha = 0.8;
        ctx.beginPath();
        ctx.arc(400, 250, 50, 0, Math.PI * 2);
        ctx.restore();
        ctx.fill();
    }
    resizeCanvas();
    $(window).resize(function() {
        resizeCanvas();
    });
});
