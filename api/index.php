<?php

require_once 'config/config.php';
require_once 'modules/api.php';

$pokemon = new API(API_KEY);
$ditto = $pokemon->request('ditto');
//  var_dump($ditto['types'][0]['type']['name']); exit;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>API Teste</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>Tipo Pokemon Ditto</p>
                <?php if ($pokemon->is_error() == false) : ?>
                    <p>Tipo: <span class="badge badge-pill badge-primary"><?php echo(strtoupper($ditto['types'][0]['type']['name'])); ?></span></p>
                <?php else: ?>
                    <p>Tipo <span class="badge badge-pill badge-danger">Servico indisponivel</span></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>