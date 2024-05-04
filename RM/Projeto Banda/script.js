$(document).mousemove(function (e) {
    if (e.clientY < 50 || $(this).scrollTop() < 550) {
        $('#navbar').slideDown();
    } else {
        $('#navbar').slideUp();
    }
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 550) {
        $('#navbar').css('position', 'fixed'); // Altera para posição absoluta
        $('#navbar').slideUp();
        $('.voltar-container').removeClass('d-none').addClass('d-flex').fadeOut(700);
    } else {
        $('#navbar').css('position', 'fixed'); // Mantém fixo na parte superior
        $('#navbar').slideDown(); // Mostra o navbar quando rolar para cima
        $('.voltar-container').removeClass('d-flex').addClass('d-none').fadeIn(700);
    }
});


function chamarMusicas() {
    // Retornar uma nova Promise
    return new Promise(function (resolve, reject) {
        // Chamada AJAX para obter a lista de arquivos de música
        $.ajax({
            url: 'http://localhost/aulas/RM/Projeto%20Banda/bancoImagens/musicas',
            dataType: 'html',
            success: function (data) {
                // Criar um DOM temporário
                let tempDOM = $('<div>').html(data);

                // Extrair os nomes dos arquivos
                let fileLinks = tempDOM.find('a[href]').map(function () {
                    return $(this).text();
                }).get();

                // Remover os primeiros 5 elementos que são os cabeçalhos da tabela
                fileLinks = fileLinks.slice(5);

                // Definir a array de músicas inicialmente vazia
                let musicas = [];

                // Processar os arquivos de música
                let promises = fileLinks.map(nomeArquivo => processarArquivo(nomeArquivo, musicas));

                // Esperar por todas as Promises serem resolvidas
                Promise.all(promises)
                    .then(function (musicas) {
                        // Filtrar para remover valores nulos
                        musicas = musicas.filter(Boolean);
                        // Resolver a Promise com a array de músicas
                        resolve(musicas);
                    })
                    .catch(function (error) {
                        reject(error);
                    });
            },
            error: function (xhr, status, error) {
                console.error('Erro ao obter lista de arquivos:', error);
                reject(error);
            }
        });
    });
}

function processarArquivo(nomeArquivo, musicas) {
    // Retornar uma nova Promise
    return new Promise(function (resolve, reject) {
        let video = document.createElement('video');
        video.src = 'http://localhost/aulas/RM/Projeto%20Banda/bancoImagens/musicas/' + nomeArquivo;

        video.addEventListener('loadedmetadata', function () {
            let duracao = video.duration;

            let partes = nomeArquivo.split('_');
            let nome = partes[0];
            let artista = partes[1].split('.')[0];

            // Verificar se o nome da música já existe em algum objeto na array musicas
            let musicaExistenteIndex = musicas.findIndex(musica => musica.nome === nome);
            if (musicaExistenteIndex !== -1) {
                // Se a música já existe, apenas adicionar o arquivo à array arquivo
                musicas[musicaExistenteIndex].arquivo.push(nomeArquivo);
                resolve(null); // Resolvemos como null para não criar um novo objeto
            } else {
                // Se a música não existe, criar um novo objeto
                let novaMusica = {
                    nome: nome,
                    artista: artista,
                    duracao: duracao,
                    arquivo: [nomeArquivo]
                };

                // Adicionar a nova música à array musicas
                musicas.push(novaMusica);

                // Resolver a Promise com o objeto de música
                resolve(novaMusica);
            }
        });

        video.addEventListener('error', function () {
            //console.error('Erro ao carregar o vídeo:', video.src);
            // Resolver a Promise com null em caso de erro
            resolve(null);
        });

        video.load();
    });
}


chamarMusicas().then(function (musicas) {
    //set inicial
    let idMusica = 0;
    let caminhoMusicas = 'http://localhost/aulas/rm/Projeto%20Banda/bancoimagens/musicas/';
    let caminhoIcones = 'http://localhost/aulas/rm/Projeto%20Banda/bancoimagens/icones/';
    let botaoPlay = $('.big_play_pause img').prop('src');
    let audio = $('#audioPlayer');
    audio.get(0).load();
    trocaMusica();


    //controle musicas
    $('.big_play_pause').click(function () {
        PlayPause();
    });

    //proxima musica
    $('.next').click(function () {
        proximaMusica();
    });
    //musica anterior
    $('.back').click(function () {
        voltaMusica();
    });

    //trocar dados mostrados musica
    function trocaMusica() {
        $('#nomeMusica').text(musicas[idMusica].nome);
        $('#artistaMusica').text(musicas[idMusica].artista);
        $('.musicaAtual').each(function (index) {
            if (musicas[idMusica].arquivo[index] != null) {
                $(this).attr('src', caminhoMusicas + musicas[idMusica].arquivo[index]);
            }
        });
        $('#duracao').text(segundosMinutos(musicas[idMusica].duracao));
        $('.album').prop('src',caminhoMusicas+'imagens/'+musicas[idMusica].nome+'.jpg');
    }

    function PlayPause() {
        if (audio.get(0).paused) {
            $('.big_play_pause img').prop('src', caminhoIcones + 'pause.png');
            audio.get(0).play();
            $('.album').addClass('rotate');
        }
        else {
            $('.big_play_pause img').prop('src', botaoPlay);
            audio.get(0).pause();
            $('.album').removeClass('rotate');
        }
    }

    function proximaMusica() {
        if (idMusica != musicas.length - 1) {
            idMusica++;
            trocaMusica();
            audio.get(0).load();
            $('.big_play_pause img').prop('src', caminhoIcones + 'pause.png');
            audio.get(0).play();
        }
    }

    function voltaMusica() {
        if (idMusica != 0) {
            idMusica--;
            trocaMusica();
            audio.get(0).load();
            $('.big_play_pause img').prop('src', caminhoIcones + 'pause.png');
            audio.get(0).play();
        }
    }

    //barra andamento video
    let tempoAtual = 0;
    let andamento = 0;
    audio.on('timeupdate', function () {
        tempoAtual = audio.get(0).currentTime;
        andamento = (tempoAtual / musicas[idMusica].duracao) * 100;

        $('#tempoAtual').text(segundosMinutos(tempoAtual));
        if (andamento > 100)
            andamento = 100;
        $('.inner_slider_bar').width(andamento + '%');
    });

    function segundosMinutos(segundos){
        return Math.floor(segundos / 60) + ":" + (Math.floor(segundos) % 60 < 10 ? "0" : "") + Math.floor(segundos) % 60;
    };
});

$