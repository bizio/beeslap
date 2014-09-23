<?php

namespace BeeSlap\Application\View\Renderer;
use BeeSlap\Application\Dto\Swarm as SwarmDto;

/**
 *
 * Swarm html renderer   
 *
 * @author Fabrizio Manunta <fabrizio@karalisweblabs.com>
 */
class Swarm 
{

    /**
     *
     * @var BeeSlap\Application\Dto\Swarm $_swarm
     */
    protected $_swarm;

    /**
     *
     * Initialize the renderer
     *
     * @param BeeSlap\Application\Dto\Swarm $swarm
     */
    public function __construct(SwarmDto $swarm)
    {
        $this->_swarm = $swarm;
    }
    
    /**
     *
     * Renders bees
     *
     * @return string
     */
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
