<?php
@include_once '../venda.class.php';
class Venda_DAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new PDO("mysql:host=localhost;dbname=padel", "root", "");
    }

    public function inserir(Venda $venda)
    {
        $sql = $this->conexao->prepare("INSERT INTO venda (entrega, data, pagamento, status, Usuario_idUsuario) 
        VALUES (:entrega, NOW(), :pagamento, 'Pendente', :Usuario_idUsuario)");
        $sql->bindValue(":entrega", $venda->getEntrega());
        $sql->bindValue(":pagamento", $venda->getPagamento());
        $sql->bindValue(":Usuario_idUsuario", $venda->getUsuarioIdUsuario());
        $sql->execute();
        return $this->conexao->lastInsertId();
    }

    public function inserirItems($produtos)
    {
        try {
            $this->conexao->beginTransaction();
            
            $values = [];
            $params = [];
            $valorTotal = 0;

            foreach ($produtos as $prod) {
                $values[] = "(?, ?, ?, ?)";
                $params[] = $prod->getVendaIdVenda();
                $params[] = $prod->getProdutoIdProduto();
                $params[] = $prod->getQuantidade();
                $params[] = $prod->getValorUnit();
                $valorTotal += $prod->getValorUnit() * $prod->getQuantidade();
            }

            $valuesString = implode(", ", $values);
            $sql = $this->conexao->prepare("INSERT INTO venda_has_produto (Venda_idVenda, Produto_idProduto, Quantidade, Valor_Unit) VALUES " . $valuesString);

            foreach ($params as $key => $param) {
                $sql->bindValue($key + 1, $param);
            }

            $sql->execute();

            $firstProduct = reset($produtos);
            $sql = $this->conexao->prepare("UPDATE venda SET valor_Total = :valor_Total WHERE idVenda = :idVenda");
            $sql->bindValue(":idVenda", $firstProduct->getVendaIdVenda());
            $sql->bindValue(":valor_Total", $valorTotal);
            $sql->execute();

            $this->conexao->commit();
        } catch (Exception $e) {
            $this->conexao->rollBack();
            throw $e;
        }
    }
}
?>
