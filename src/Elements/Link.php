<?php

namespace Parfumix\FormBuilder\Elements;

class Link extends Input {

    /**
     * Render link
     *
     * @return string
     */
    public function render() {
        $result = $this->before;
        $result .= '<a ';
        $result .= $this->renderAttributes();
        $result .= '>';
        $result .= $this->getAttribute('title');
        $result .= '</a>';

        $result .= $this->after;

        return $result;
    }
}
