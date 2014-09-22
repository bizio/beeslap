<?php

namespace BeeSlap\Tests\Application\Service;
use BeeSlap\Application\Service\Game;

class GameTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     *
     */
    public function testNewGame()
    {
        $game = new Game();
        $swarm = $game->newGame();

        $this->assertInstanceOf('BeeSlap\Application\Dto\Swarm', $swarm);
    }
    
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     *
     */
    public function testRandomSlap()
    {
        $game = new Game();
        $swarm = $game->newGame();
        $swarmAfterRandomSlap = $game->randomSlap();
        array_walk($swarm, function($bee, $i) use($swarmAfterRandomSlap) {
            if($bee['type'] === $swarmAfterRandomSlap[$i]['type']
                && $bee['points'] === $swarmAfterRandomSlap[$i]['points']) {
                    unset($swarmAfterRandomSlap[$i]);
                }
        });

        $this->assertEquals(count($swarmAfterRandomSlap), 1);
        $bee = array_pop($swarmAfterRandomSlap->getArrayCopy());
        $beeClass = 'BeeSlap\Domain\Bee\Model\\' . $bee['type'];
        
        $this->assertEquals($beeClass::STARTING_POINTS - $beeClass::HIT_DAMAGE, $bee['points']);
        
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     *
     */
    public function testGetGameInProgress()
    {
        $game = new Game();
        $swarm = $game->newGame();
        $swarmAfterRandomSlap = $game->randomSlap();
        $gameInProgress = $game->getGameInProgress();
        $this->assertEquals($gameInProgress, $swarmAfterRandomSlap);
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     *
     */
    public function testGameThrowsExceptionWhenAllTheQueensAreDead()
    {
        
        $game = new Game();
        $swarm = $game->newGame();
        $game->killAllQueens();

        $this->setExpectedException('\Exception', 'All bees are dead');
        $game->randomSlap();
    }

}


?>
