<?php

namespace Parfumix\FormBuilder\Elements;

class Custom extends Input {

    /**
     * Render ..
     *
     * @return mixed
     */
    public function render() {
       return $this->getAttribute('value');
    }
}
