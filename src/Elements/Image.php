<?php

namespace Parfumix\FormBuilder\Elements;

class Image extends Input {

    protected $attributes = array(
        'type' => 'image',
    );

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
