$(document).ready(function() {
  $.ajax({
    url: 'dados.json',
    dataType: 'json',
    success: function(data) {
      var pessoas = data.pessoas;
      var conteudo = '<h2>Pessoas:</h2><ul>';
      
      $.each(pessoas, function(index, pessoa) {
        conteudo += '<li>Nome: ' + pessoa.nome + ', Idade: ' + pessoa.idade + ', Cidade: ' + pessoa.cidade + '</li>';
      });

      conteudo += '</ul>';
      $('#conteudo').html(conteudo);
    },
    error: function() {
      $('#conteudo').html('<p>Ocorreu um erro ao carregar o arquivo JSON.</p>');
    }
  });
});
