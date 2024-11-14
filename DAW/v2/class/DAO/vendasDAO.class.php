<?php
@include_once '../venda.class.php';

class Venda_DAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new PDO("mysql:host=localhost;dbname=padel", "root", "");
    }

    public function inserirVendaComItens(Venda $venda, $produtos)
    {
        try {
            $this->conexao->beginTransaction();

            // Inserir a venda
            $sql = $this->conexao->prepare("INSERT INTO venda (entrega, data, pagamento, status, Usuario_idUsuario) 
                                            VALUES (:entrega, NOW(), :pagamento, 'Pendente', :Usuario_idUsuario)");
            $sql->bindValue(":entrega", $venda->getEntrega());
            $sql->bindValue(":pagamento", $venda->getPagamento());
            $sql->bindValue(":Usuario_idUsuario", $venda->getUsuarioIdUsuario());
            $sql->execute();
            $vendaId = $this->conexao->lastInsertId();

            // Inserir itens da venda
            $values = [];
            $params = [];
            $valorTotal = 0;

            foreach ($produtos as $prod) {
                // Verificar estoque disponível
                $sql = $this->conexao->prepare("SELECT qtd_estoque FROM produto WHERE idProduto = :idProduto");
                $sql->bindValue(":idProduto", $prod->getProdutoIdProduto());
                $sql->execute();
                $estoque = $sql->fetchColumn();

                if ($estoque < $prod->getQuantidade()) {
                    throw new Exception("Estoque insuficiente para o produto ID: " . $prod->getProdutoIdProduto());
                }

                $values[] = "(?, ?, ?, ?)";
                $params[] = $vendaId;
                $params[] = $prod->getProdutoIdProduto();
                $params[] = $prod->getQuantidade();
                $params[] = $prod->getValorUnit();
                $valorTotal += $prod->getValorUnit() * $prod->getQuantidade();

                // Atualizar quantidade de estoque
                $sql = $this->conexao->prepare("UPDATE produto SET qtd_estoque = qtd_estoque - :quantidade WHERE idProduto = :idProduto");
                $sql->bindValue(":quantidade", $prod->getQuantidade());
                $sql->bindValue(":idProduto", $prod->getProdutoIdProduto());
                $sql->execute();
            }

            $valuesString = implode(", ", $values);
            $sql = $this->conexao->prepare("INSERT INTO venda_has_produto (Venda_idVenda, Produto_idProduto, Quantidade, Valor_Unit) VALUES " . $valuesString);

            foreach ($params as $key => $param) {
                $sql->bindValue($key + 1, $param);
            }

            $sql->execute();

            $sql = $this->conexao->prepare("UPDATE venda SET valor_Total = :valor_Total WHERE idVenda = :idVenda");
            $sql->bindValue(":idVenda", $vendaId);
            $sql->bindValue(":valor_Total", $valorTotal);
            $sql->execute();
            $this->conexao->commit();
            return $vendaId;
        } catch (Exception $e) {
            $this->conexao->rollBack();
            return false;
        }
    }
    public function getDetalhes($idVenda){
        $sql = $this->conexao->prepare("
        select v.data as data, u.usuario as usuario, 
        v.status as status, 
        v.entrega as local,
        p.imagem as imagem, p.nome as nome, 
        vhp.Valor_Unit as valor, vhp.Quantidade as quantidade, 
        v.valor_Total as valorTotal
        from usuario u inner join venda v
            on u.idUsuario = v.Usuario_idUsuario
            inner join venda_has_produto vhp
                on v.idVenda = vhp.Venda_idVenda
                inner join produto p
                    on vhp.Produto_idProduto = p.idProduto
        where v.idVenda = :idVenda");
        $sql->bindValue(":idVenda",$idVenda);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function listar($complemento = ""){
        $sql = $this->conexao->prepare("SELECT venda.*, usuario.usuario as usuario FROM venda INNER JOIN usuario
            ON venda.Usuario_idUsuario = usuario.idUsuario ".$complemento);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function retornarUnico($idVenda){
        $sql = $this->conexao->prepare("SELECT * FROM venda where idVenda = :idVenda");
        $sql->bindValue(':idVenda',$idVenda);
        $sql->execute();
        return $sql->fetch();
    }

    public function editarStatus(Venda $venda){
        $sql = $this->conexao->prepare("update venda set status = :status where idVenda = :idVenda");
        $sql->bindValue(":idVenda",$venda->getIdVenda());
        $sql->bindValue(":status",$venda->getStatus());
        $sql->execute();
    }
}