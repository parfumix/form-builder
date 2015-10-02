<?php

namespace Parfumix\FormBuilder\Elements;

class Image extends Input {

    /**
     * Render link
     *
     * @return string
     */
    public function render() {
        $result = $this->before;
        $result .= '<image ';
        $result .= $this->renderAttributes();
        $result .= '>';

        $result .= $this->after;

        return $result;
    }
}
