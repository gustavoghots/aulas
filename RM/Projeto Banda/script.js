function chamarMusicas() {
    // Função para processar os arquivos de música
    function processarArquivos(arquivos) {
        let musicas = [];

        arquivos.forEach(function (nomeArquivo) {
            // Criar um elemento de vídeo
            let video = document.createElement('video');

            // Definir o atributo src para o nome do arquivo
            video.src = 'http://localhost/aulas/RM/Projeto%20Banda/bancoImagens/musicas/' + nomeArquivo;

            // Adicionar evento de carregamento para obter a duração do vídeo
            video.addEventListener('loadedmetadata', function() {
                let duracao = video.duration;

                let partes = nomeArquivo.split('_');
                let nome = partes[0];
                let artista = partes[1].split('.')[0];

                let novaMusica = {
                    nome: nome,
                    artista: artista,
                    duracao: duracao, // Adicionar a duração à música
                    arquivo: [nomeArquivo]
                };
                musicas.push(novaMusica);

                // Escrever os dados processados no arquivo musicas.json
                escreverNoArquivo(musicas);
            });

            // Carregar o vídeo para obter a duração
            video.load();
        });
    }

    // Função para escrever os dados no arquivo musicas.json
    function escreverNoArquivo(dados) {
        let jsonData = JSON.stringify(dados);
        console.log(jsonData);
    
        $.ajax({
            url: 'http://localhost/aulas/RM/Projeto%20Banda/musicas.json',
            type: 'POST',
            contentType: 'application/json',
            data: jsonData,
            success: function (response) {
                console.log('Resposta do servidor:', response);
                console.log('Dados gravados com sucesso no arquivo musicas.json');
            },
            error: function (xhr, status, error) {
                console.error('Erro ao gravar dados no arquivo musicas.json:', error);
            }
        });
    }
    

    // Chamada AJAX para obter a lista de arquivos de música
    $.ajax({
        url: 'http://localhost/aulas/RM/Projeto%20Banda/bancoImagens/musicas',
        dataType: 'html', // Espera uma resposta HTML
        success: function (data) {
            // Criar um DOM temporário
            let tempDOM = $('<div>').html(data);
    
            // Extrair os nomes dos arquivos
            let fileLinks = tempDOM.find('a[href]').map(function() {
                return $(this).text();
            }).get();
    
            // Remover os primeiros 5 elementos que são os cabeçalhos da tabela
            fileLinks = fileLinks.slice(5);
    
            processarArquivos(fileLinks);
        },
        error: function (xhr, status, error) {
            console.error('Erro ao obter lista de arquivos:', error);
        }
    });
}
