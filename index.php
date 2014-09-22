<?php

// set to 0 to suppress error
error_reporting(-1);

// composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

try {

    $gameService = new BeeSlap\Application\Service\Game();
    $errorRenderer = new BeeSlap\Application\View\Renderer\Error();

    if(array_key_exists('hit', $_POST)) {
        $swarm = $gameService->randomSlap();
    } elseif (array_key_exists('reset', $_POST)) {
        $swarm = $gameService->newGame();
    } else {
        $swarm = $gameService->getGameInProgress();
        if(null === $swarm) {
            $swarm = $gameService->newGame();
        }
    }

    $swarmRenderer = new BeeSlap\Application\View\Renderer\Swarm($swarm);

} catch (\Exception $e) {
    $swarmRenderer = new BeeSlap\Application\View\Renderer\Swarm(new BeeSlap\Application\Dto\Swarm());
    $errorRenderer->setError($e->getMessage());    
}

$html =<<<HTML
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bee Slap!</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
</head>

<body>
    <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Bee Slap</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Bee Slap</a>
            </div>
        </div><!--/.container-fluid -->
    </div>
    <div class="container-fluid">
        {$errorRenderer->render()}
        {$swarmRenderer->render()}
        <div class="row">
            <div class="col-md-12">
                <form role="form" method="POST">
                    <div class="form-group">
                        <button type="submit" class="btn btn-default" name="hit">Hit</button>
                        <button type="submit" class="btn btn-default" name="reset">Reset game</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

HTML;

echo $html;

?>
