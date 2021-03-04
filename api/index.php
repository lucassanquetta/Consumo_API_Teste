<?php

require_once 'config/config.php';
require_once 'modules/api.php';

$pokedex = new API(API_KEY);
$pokemon = $pokedex->request('charizard');
$moves = $pokedex->request_moves($pokemon);
// foreach ($pokemon['abilities'] as $ataques) {
//     var_dump($ataques['ability']['name']);
// } exit;
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
                <p>Pokemon: <?php echo(strtoupper($pokemon['name'])); ?></p>

                <?php if ($pokedex->is_error() == false) : ?>
                    <p>Nome: <span class="badge badge-pill badge-primary"><?php echo(strtoupper($pokemon['name'])); ?></span></p>
                <?php else: ?>
                    <p>Nome: <span class="badge badge-pill badge-danger">Servico indisponivel</span></p>
                <?php endif; ?>

                <?php if ($pokedex->is_error() == false) : ?>
                    <p>Tipo: <?php foreach ($pokemon['types'] as $ataques) { ?>
                        <span class="badge badge-pill badge-primary">
                        <?php echo(strtoupper($ataques['type']['name'])); ?>
                        </span>
                    <?php } ?></p>
                <?php else: ?>
                    <p>Tipo: <span class="badge badge-pill badge-danger">Servico indisponivel</span></p>
                <?php endif; ?>
                
                <?php if ($pokedex->is_error() == false) : ?>
                    <p>Ataques: <br>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Aprende no Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($moves as $ataques) { ?>
                                <tr>
                                    <td>
                                        <?php echo(strtoupper($ataques['move']['name'])); ?>
                                    </td>
                                    <td>
                                        <?php echo ($ataques['version_group_details'][0]['level_learned_at'] == 0 ?
                                                        "Necessita de Machine" :
                                                        $ataques['version_group_details'][0]['level_learned_at']); ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </p>
                    <?php else: ?>
                        <p>Ataques: <span class="badge badge-pill badge-danger">Servico indisponivel</span></p>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>