<?php

namespace BeeSlap\Application\View\Renderer;

/**
 *
 * Error message html renderer
 *
 * @author Fabrizio Manunta <fabrizio@karalisweblabs.com>
 */
class Error 
{

    /**
     *
     * @var string $_error
     */
    protected $_error;

    /**
     *
     * Sets error message
     * @param string $message
     */
    public function setError($message)
    {
        $this->_error = $message;
    }

    /**
     *
     * Renders html
     * @return string
     */
    public function render()
    {

        $error = '';
        if(strlen($this->_error) > 0) {
            $error .= '<div class="row"><div class="col-md-12">';
            $error .= sprintf('<div class="alert alert-danger" role="alert">%s</div>', $this->_error);
            $error .= '</div></div>';
        }

        return $error;
    }

}

?>
