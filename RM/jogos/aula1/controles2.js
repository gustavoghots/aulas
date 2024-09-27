window.onload = function() {
    let canvas = document.getElementById("animacao");
    let c = canvas.getContext("2d");

    const cores = ["#85847e", "#ab6a6e", "#f7345b", "#353130", "#cbcfb4"];
    let arrayCirculos = [];
    let arrayTiros = [];
    let wave = 1; // Número da onda atual
    let qtdeCirculos = 5; // Quantidade de bolinhas na onda inicial
    let velocidadeIncremento = 0.5; // Aumento na velocidade a cada onda
    let jogadorVivo = true; // Flag para controlar se o jogador está vivo
    let cooldownTiro = 500; // Tempo de cooldown em milissegundos
    let ultimoTiro = 0; // Timestamp do último tiro

    // Ajustar o tamanho do canvas e remover barras de rolagem
    function ajustarCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        document.body.style.overflow = "hidden"; // Remove barras de rolagem
        reiniciarCirculos(); // Reinicia as bolinhas após redimensionar
    }

    // Suavizar movimento do jogador
    let teclas = {
        ArrowLeft: false,
        ArrowRight: false,
        ArrowUp: false,
        ArrowDown: false
    };

    function Jogador(x, y, raio, cor) {
        this.x = x;
        this.y = y;
        this.raio = raio;
        this.cor = cor;
        this.velocidade = 5;

        this.desenhar = () => {
            c.beginPath();
            c.arc(this.x, this.y, this.raio, 0, Math.PI * 2, false);
            c.fillStyle = this.cor;
            c.fill();
        };

        this.movimentar = () => {
            if (teclas.ArrowLeft && this.x - this.raio > 0) this.x -= this.velocidade;
            if (teclas.ArrowRight && this.x + this.raio < canvas.width) this.x += this.velocidade;
            if (teclas.ArrowUp && this.y - this.raio > 0) this.y -= this.velocidade;
            if (teclas.ArrowDown && this.y + this.raio < canvas.height) this.y += this.velocidade;
        };
    }

    function Circulo(x, y, dx, dy, raio, cor) {
        this.x = x;
        this.y = y;
        this.dx = dx;
        this.dy = dy;
        this.raio = raio;
        this.cor = cor;

        this.desenhar = function() {
            c.beginPath();
            c.arc(this.x, this.y, this.raio, 0, Math.PI * 2, false);
            c.fillStyle = this.cor;
            c.fill();
        };

        this.atualizar = function() {
            if (this.x + this.raio > canvas.width || this.x - this.raio < 0) this.dx = -this.dx;
            if (this.y + this.raio > canvas.height || this.y - this.raio < 0) this.dy = -this.dy;

            this.x += this.dx;
            this.y += this.dy;
            this.desenhar();
        };
    }

    function Tiro(x, y, dx, dy, raio, cor) {
        this.x = x;
        this.y = y;
        this.dx = dx;
        this.dy = dy;
        this.raio = raio;
        this.cor = cor;

        this.desenhar = function() {
            c.beginPath();
            c.arc(this.x, this.y, this.raio, 0, Math.PI * 2, false);
            c.fillStyle = this.cor;
            c.fill();
        };

        this.atualizar = function() {
            this.x += this.dx;
            this.y += this.dy;
            this.desenhar();
        };

        this.foraDaTela = function() {
            return this.x + this.raio < 0 || this.x - this.raio > canvas.width ||
                   this.y + this.raio < 0 || this.y - this.raio > canvas.height;
        };
    }

    // Inicializando jogador
    let jogador = new Jogador(100, 100, 20, "green");

    // Criar círculos iniciais
    function criarCirculo() {
        let raio = Math.random() * 20 + 30; // Raio aleatório para a bolinha
        let x, y;
        let tentativas = 0;
        const maxTentativas = 100; // Limite de tentativas para evitar loops infinitos

        let posicaoValida = false;

        while (!posicaoValida && tentativas < maxTentativas) {
            // Gera posições aleatórias dentro dos limites do canvas
            x = Math.random() * (canvas.width - raio * 2) + raio; // Considera o raio
            y = Math.random() * (canvas.height - raio * 2) + raio; // Considera o raio

            // Verifica se a nova posição está distante do jogador
            let distanciaJogador = Math.hypot(jogador.x - x, jogador.y - y);
            if (distanciaJogador >= 100 + raio + jogador.raio) {
                // Verifica se a nova posição não está próxima de outros círculos
                let proximo = arrayCirculos.every(circulo => {
                    const distanciaCirculo = Math.hypot(circulo.x - x, circulo.y - y);
                    return distanciaCirculo >= (circulo.raio + raio + 20); // +20 para espaçamento adicional
                });

                if (proximo) {
                    posicaoValida = true; // Posição válida encontrada
                }
            }
            tentativas++;
        }

        let dx = (Math.random() - 0.5) * 2 * wave; // Direção aleatória
        let dy = (Math.random() - 0.5) * 2 * wave; // Direção aleatória
        let cor = cores[Math.floor(Math.random() * cores.length)];
        arrayCirculos.push(new Circulo(x, y, dx, dy, raio, cor));
    }

    function reiniciarCirculos() {
        arrayCirculos = []; // Limpa a lista de círculos
        for (let i = 0; i < qtdeCirculos + (wave - 1) * 5; i++) {
            criarCirculo(); // Cria novos círculos
        }
    }

    function detectarColisao(circulo, objeto) {
        const distancia = Math.hypot(circulo.x - objeto.x, circulo.y - objeto.y);
        return distancia <= circulo.raio + objeto.raio;
    }

    function atirar(x, y) {
        const angulo = Math.atan2(y - jogador.y, x - jogador.x);
        const velocidade = 7;
        const dx = Math.cos(angulo) * velocidade;
        const dy = Math.sin(angulo) * velocidade;

        const agora = Date.now();
        if (agora - ultimoTiro >= cooldownTiro) { // Verifica se o cooldown expirou
            arrayTiros.push(new Tiro(jogador.x, jogador.y, dx, dy, 5, "red"));
            ultimoTiro = agora; // Atualiza o timestamp do último tiro
        }

        if (arrayTiros.length > 10) arrayTiros.shift();
    }

    function verificarVitoria() {
        if (arrayCirculos.length === 0) {
            wave++; // Aumenta a onda
            qtdeCirculos += 5; // Adiciona mais 5 círculos
            reiniciarCirculos(); // Reinicia as bolinhas
        }
    }

    function verificarColisaoJogador() {
        for (let i = 0; i < arrayCirculos.length; i++) {
            if (detectarColisao(arrayCirculos[i], jogador)) {
                jogadorVivo = false; // O jogador é tocado
                alert("Você morreu!\nScore: " + (wave - 1)); // Exibe alerta ao jogador
                window.location.reload(); // Reinicia o jogo
                break;
            }
        }
    }

    function animacao() {
        if (!jogadorVivo) return; // Para a animação se o jogador não estiver vivo
        requestAnimationFrame(animacao);
        c.clearRect(0, 0, canvas.width, canvas.height);
    
        jogador.movimentar();
        jogador.desenhar(); // Adicione esta linha para desenhar o jogador
    
        arrayCirculos.forEach((circulo) => {
            circulo.atualizar();
        });
    
        arrayTiros = arrayTiros.filter((tiro) => {
            tiro.atualizar();
            if (tiro.foraDaTela()) return false;
    
            for (let j = 0; j < arrayCirculos.length; j++) {
                if (detectarColisao(arrayCirculos[j], tiro)) {
                    arrayCirculos.splice(j, 1); // Remove círculo destruído
                    verificarVitoria(); // Verifica se o jogador venceu
                    return false;
                }
            }
            return true;
        });
    
        verificarColisaoJogador(); // Verifica se o jogador foi atingido
    }
    

    window.addEventListener("keydown", (event) => {
        teclas[event.key] = true;
    });
    window.addEventListener("keyup", (event) => {
        teclas[event.key] = false;
    });

    canvas.addEventListener("click", (event) => {
        if (jogadorVivo) {
            atirar(event.clientX, event.clientY);
        }
    });

    ajustarCanvas();
    reiniciarCirculos(); // Inicia com a quantidade de círculos da primeira onda
    animacao(); // Inicia a animação
};
