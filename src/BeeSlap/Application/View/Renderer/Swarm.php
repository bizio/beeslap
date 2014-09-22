<?php

namespace BeeSlap\Application\View\Renderer;
use BeeSlap\Application\Dto\Swarm as SwarmDto;

class Swarm 
{

    protected $_swarm;

    protected $_error;

    public function __construct(SwarmDto $swarm)
    {
        $this->_swarm = $swarm;
    }
    
    public function render()
    {

        $gamearea = '<div class="well row">';

        foreach($this->_swarm as $bee) {
            $points = $bee['points'] > 0 ? $bee['points'] : 'DEAD';
            $gamearea .= sprintf(
                '<div class="col-md-2"><h2><span class="label label-primary">%s</span><span class="badge">%s</span></h2></div>', 
                $bee['type'], 
                $points
            );
        }
        $gamearea .= '</div>';

        return $gamearea;
    }

}

?>
