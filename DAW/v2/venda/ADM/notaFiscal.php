<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Fiscal - Detalhes da Venda</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
    include_once '../../user/ADM/header.php';
    include_once '../../class/DAO/vendasDAO.class.php';

    $objVendaDAO = new Venda_DAO();
    $detalhesVenda = $objVendaDAO->getDetalhes($_GET['id']);

    // Informações principais
    $usuario = $detalhesVenda[0]['usuario'];
    $dataVenda = date("d/m/Y", strtotime($detalhesVenda[0]['data']));
    $status = $detalhesVenda[0]['status'];
    $entrega = $detalhesVenda[0]['local'];
    $subtotal = 0;
    ?>

    <div class="container my-5">
        <div class="card">
            <div class="card-body">
                <div class="container mb-5 mt-3">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-xl-9">
                            <p style="color: #7e8d9f; font-size: 20px;">Nota Fiscal >> <strong>ID: #<?= htmlspecialchars($_GET['id']) ?></strong></p>
                        </div>
                        <div class="col-xl-3 text-end">
                            <button class="btn btn-light text-capitalize border-0" onclick="imprimirDiv()">
                                <i class="fas fa-print text-primary"></i> Imprimir
                            </button>
                        </div>
                        <hr>
                    </div>

                    <div class="text-center mb-3">
                        <p class="pt-0 fs-4">Padel E-commerce</p>
                    </div>

                    <div class="impressao">
                        <div class="row">
                            <div class="col-xl-8">
                                <ul class="list-unstyled">
                                    <li class="text-muted">Para: <span style="color:#5d9fc5;"><?= htmlspecialchars($usuario) ?></span></li>
                                    <li class="text-muted">Entrega: <?= htmlspecialchars($entrega) ?></li>
                                </ul>
                            </div>
                            <div class="col-xl-4">
                                <p class="text-muted">Nota Fiscal</p>
                                <ul class="list-unstyled">
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA;"></i> <strong>ID:</strong> #<?= htmlspecialchars($_GET['id']) ?></li>
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA;"></i> <strong>Data da Venda:</strong> <?= $dataVenda ?></li>
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA;"></i> <strong>Status:</strong> <span class="badge bg-warning text-black"><?= htmlspecialchars($status) ?></span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row my-2 mx-1 justify-content-center">
                            <table class="table table-striped table-borderless">
                                <thead style="background-color:#84B0CA;" class="text-white">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Qtd</th>
                                        <th scope="col">Valor Unit</th>
                                        <th scope="col">Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detalhesVenda as $index => $item):
                                        $quantidade = $item['quantidade'];
                                        $valorUnitario = $item['valor'];
                                        $valorTotalItem = $quantidade * $valorUnitario;
                                        $subtotal += $valorTotalItem;
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $index + 1 ?></th>
                                            <td><?= htmlspecialchars($item['nome']) ?></td>
                                            <td><?= htmlspecialchars($quantidade) ?></td>
                                            <td>R$ <?= number_format($valorUnitario, 2, ',', '.') ?></td>
                                            <td>R$ <?= number_format($valorTotalItem, 2, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xl-8"></div>
                            <div class="col-xl-4">
                                <ul class="list-unstyled">
                                    <li class="text-muted"><span class="text-black me-4">Subtotal:</span> R$ <?= number_format($subtotal, 2, ',', '.') ?></li>
                                    <li class="text-muted"><span class="text-black me-4">Total:</span><strong style="font-size: 25px;"> R$ <?= number_format($subtotal, 2, ',', '.') ?></strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>
    <script>
        function imprimirDiv() {
            // Seleciona o conteúdo da div com a classe 'impressao'
            var conteudoImpressao = document.querySelector('.impressao').innerHTML;

            // Cria uma nova janela para impressão
            var janelaImpressao = window.open('', '', 'height=600,width=800');

            // Preenche o conteúdo da nova janela com o conteúdo da div selecionada
            janelaImpressao.document.write('<html><head><title>Impressão</title>');
            janelaImpressao.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">');
            janelaImpressao.document.write('</head><body>');
            janelaImpressao.document.write(conteudoImpressao);
            janelaImpressao.document.write('</body></html>');

            // Aguarda o conteúdo carregar para iniciar a impressão
            janelaImpressao.document.close();
            janelaImpressao.print();
        }
    </script>

</body>

</html>