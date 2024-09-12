$(document).ready(function () {
    
    
    $(document).ready(function() {
        function calcularIdade(diaNascimento, mesNascimento, anoNascimento) {
            const hoje = new Date();
            let idade = hoje.getFullYear() - anoNascimento;
            const mesAtual = hoje.getMonth() + 1; // Meses são 0-indexados
            const diaAtual = hoje.getDate();
    
            if (mesAtual < mesNascimento || (mesAtual === mesNascimento && diaAtual < diaNascimento)) {
                idade--;
            }
    
            return idade;
        }
    
        const nome = "Gustavo Fiss";
        const diaNascimento = 2;
        const mesNascimento = 10; // Outubro
        const anoNascimento = 2005;
        const idade = calcularIdade(diaNascimento, mesNascimento, anoNascimento);
    
        const texto = `${nome} sou estudante de desenvolvimento de páginas web e atualmente trabalho com desenvolvimento de APIs na Perceptiva. Tenho ${idade} anos e estou sempre buscando novos desafios e oportunidades para crescer na área de tecnologia. Minha paixão por programação começou cedo e, desde então, venho me dedicando a aprimorar minhas habilidades e a explorar novas tecnologias. Meu portfólio reflete minha trajetória e os projetos em que estive envolvido, demonstrando meu compromisso com a inovação e a qualidade. Estou sempre aberto a novas colaborações e ansioso para contribuir com soluções criativas e eficazes no campo do desenvolvimento web.`;
    
        $('#introducao').text(texto);
    });
    
    
    
    const canvas = document.getElementById('exemploCanva');
    const wrapper = document.getElementById('CanvaWarp');
    const ctx = canvas.getContext('2d');
    const numParticulas = 50;
    const particulas = [];

    // Ajustar o tamanho do canvas para o tamanho exato do wrapper
    function ajustarTamanhoCanvas() {
        canvas.width = wrapper.clientWidth;
        canvas.height = wrapper.clientHeight;
    }
    ajustarTamanhoCanvas();
    window.addEventListener('resize', ajustarTamanhoCanvas); // Ajusta quando a tela redimensiona

    class Particula {
        constructor(x, y, radius) {
            this.x = x;
            this.y = y;
            this.radius = radius;
            this.massa = radius * radius; // Massa proporcional ao quadrado do raio
            this.vx = (Math.random() - 0.5) * 4;
            this.vy = (Math.random() - 0.5) * 4;
        }

        desenhar() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(0, 150, 255, 0.7)';
            ctx.fill();
            ctx.closePath();
        }

        atualizar() {
            this.x += this.vx;
            this.y += this.vy;

            // Detecta colisão com as bordas e impede que as partículas saiam
            if (this.x + this.radius > canvas.width) {
                this.x = canvas.width - this.radius;
                this.vx = -this.vx;
            } else if (this.x - this.radius < 0) {
                this.x = this.radius;
                this.vx = -this.vx;
            }

            if (this.y + this.radius > canvas.height) {
                this.y = canvas.height - this.radius;
                this.vy = -this.vy;
            } else if (this.y - this.radius < 0) {
                this.y = this.radius;
                this.vy = -this.vy;
            }

            // Detecta colisão com outras partículas
            for (let i = 0; i < particulas.length; i++) {
                const outraParticula = particulas[i];
                if (this !== outraParticula) {
                    const dx = this.x - outraParticula.x;
                    const dy = this.y - outraParticula.y;
                    const distancia = Math.sqrt(dx * dx + dy * dy);
                    const somaRaios = this.radius + outraParticula.radius;

                    if (distancia < somaRaios) {
                        // Evita sobreposição corrigindo a posição
                        const overlap = (somaRaios - distancia) / 2;
                        const angulo = Math.atan2(dy, dx);

                        this.x += Math.cos(angulo) * overlap;
                        this.y += Math.sin(angulo) * overlap;
                        outraParticula.x -= Math.cos(angulo) * overlap;
                        outraParticula.y -= Math.sin(angulo) * overlap;

                        // Troca as velocidades após a colisão com base nas massas
                        const novaVx1 = (this.vx * (this.massa - outraParticula.massa) + 2 * outraParticula.massa * outraParticula.vx) / (this.massa + outraParticula.massa);
                        const novaVy1 = (this.vy * (this.massa - outraParticula.massa) + 2 * outraParticula.massa * outraParticula.vy) / (this.massa + outraParticula.massa);
                        const novaVx2 = (outraParticula.vx * (outraParticula.massa - this.massa) + 2 * this.massa * this.vx) / (this.massa + outraParticula.massa);
                        const novaVy2 = (outraParticula.vy * (outraParticula.massa - this.massa) + 2 * this.massa * this.vy) / (this.massa + outraParticula.massa);

                        this.vx = novaVx1;
                        this.vy = novaVy1;
                        outraParticula.vx = novaVx2;
                        outraParticula.vy = novaVy2;
                    }
                }
            }
        }
    }

    function criarParticula() {
        const radius = Math.random() * 10 + 5; // Reduzi o tamanho das partículas
        const x = Math.random() * (canvas.width - radius * 2) + radius;
        const y = Math.random() * (canvas.height - radius * 2) + radius;
        return new Particula(x, y, radius);
    }

    for (let i = 0; i < numParticulas; i++) {
        particulas.push(criarParticula());
    }

    function animar() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        particulas.forEach(particula => {
            particula.atualizar();
            particula.desenhar();
        });

        requestAnimationFrame(animar);
    }

    function removerParticula(particula) {
        const index = particulas.indexOf(particula);
        if (index !== -1) {
            particulas.splice(index, 1);
            particulas.push(criarParticula());
        }
    }

    canvas.addEventListener('click', function (event) {
        const rect = canvas.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        particulas.forEach(particula => {
            const dx = x - particula.x;
            const dy = y - particula.y;
            if (Math.sqrt(dx * dx + dy * dy) < particula.radius) {
                removerParticula(particula);
            }
        });
    });

    animar();
});
