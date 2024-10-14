$(document).ready(function () {
    const canvas = $('#animacao')[0];
    const c = canvas.getContext('2d');

    // Ajustar tamanho do canvas
    const resizeCanvas = () => {
        canvas.width = $(window).width();
        canvas.height = $(window).height();
    };
    resizeCanvas();
    $(window).resize(resizeCanvas);

    // Configuração do jogador e controle de teclas
    const teclas = { Left: false, Right: false, Up: false, Down: false };
    const player = {
        x: 100,
        y: 100,
        velocidadeMax: 5,
        velocidadeAtual: { x: 0, y: 0 },
        aceleracao: 0.9,
        raio: 20,
        cor: 'green'
    };

    // Detectar teclas pressionadas e soltas
    $(document).on('keydown keyup', (e) => {
        const estado = e.type === 'keydown';
        const keyMap = {
            'a': 'Left',
            'ArrowLeft': 'Left',
            'd': 'Right',
            'ArrowRight': 'Right',
            'w': 'Up',
            'ArrowUp': 'Up',
            's': 'Down',
            'ArrowDown': 'Down'
        };
        if (keyMap[e.key] !== undefined) {
            teclas[keyMap[e.key]] = estado;
        }
    });

    // Função para desenhar o jogador
    const desenharJogador = () => {
        c.beginPath();
        c.arc(player.x, player.y, player.raio, 0, Math.PI * 2);
        c.fillStyle = player.cor;
        c.fill();
    };

    // Função para movimentar o jogador com aceleração
    const movimentarJogador = () => {
        let movimentoX = teclas.Right - teclas.Left; // 1, 0, -1
        let movimentoY = teclas.Down - teclas.Up; // 1, 0, -1

        // Normalização para evitar velocidade extra ao andar na diagonal
        const magnitude = Math.sqrt(movimentoX ** 2 + movimentoY ** 2);
        if (magnitude > 0) {
            movimentoX /= magnitude;
            movimentoY /= magnitude;
        }

        // Aceleração para o movimento
        player.velocidadeAtual.x += movimentoX * player.aceleracao;
        player.velocidadeAtual.y += movimentoY * player.aceleracao;

        // Limitar a velocidade máxima
        const velocidadeTotal = Math.sqrt(player.velocidadeAtual.x ** 2 + player.velocidadeAtual.y ** 2);
        if (velocidadeTotal > player.velocidadeMax) {
            player.velocidadeAtual.x = (player.velocidadeAtual.x / velocidadeTotal) * player.velocidadeMax;
            player.velocidadeAtual.y = (player.velocidadeAtual.y / velocidadeTotal) * player.velocidadeMax;
        }

        // Desaceleração se nenhuma tecla for pressionada
        if (!teclas.Left && !teclas.Right) {
            player.velocidadeAtual.x = player.velocidadeAtual.x > 0 ? 
                Math.max(0, player.velocidadeAtual.x - player.aceleracao) : 
                Math.min(0, player.velocidadeAtual.x + player.aceleracao);
        }
        if (!teclas.Up && !teclas.Down) {
            player.velocidadeAtual.y = player.velocidadeAtual.y > 0 ? 
                Math.max(0, player.velocidadeAtual.y - player.aceleracao) : 
                Math.min(0, player.velocidadeAtual.y + player.aceleracao);
        }

        // Atualizar posição do jogador dentro dos limites do canvas
        player.x = Math.max(player.raio, Math.min(canvas.width - player.raio, player.x + player.velocidadeAtual.x));
        player.y = Math.max(player.raio, Math.min(canvas.height - player.raio, player.y + player.velocidadeAtual.y));
    };

    // Loop de animação
    const animacao = () => {
        requestAnimationFrame(animacao);
        c.clearRect(0, 0, canvas.width, canvas.height);
        movimentarJogador();
        desenharJogador();
    };

    animacao();
});
