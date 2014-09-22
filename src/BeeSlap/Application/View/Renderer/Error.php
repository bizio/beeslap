<?php

namespace BeeSlap\Application\View\Renderer;

class Error 
{

    protected $_error;

    public function setError($message)
    {
        $this->_error = $message;
    }

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
