<?php

namespace Parfumix\FormBuilder\Elements;

class Fieldset extends Input {

    /**
     * @var array
     */
    protected $elements = [];

    /**
     * Set elements .
     *
     * @param array $elements
     * @return $this
     */
    public function elements(array $elements) {
        $this->elements = $elements;

        return $this;
    }

    /**
     * Get elements .
     *
     * @return array
     */
    public function getElements() {
        return $this->elements;
    }

    /**
     * Render fieldset .
     *
     * @return string
     */
    public function render() {
        $html = "<fieldset>";
        $html .= "<legend>".$this->getAttribute('label')."</legend>";

        $elements = $this->getElements();
        array_walk($elements, function($element) use(& $html) {
            if( $element->isAllowed() )
                $html .= $element->render();
        });

        $html .= "</fieldset>";

        return $html;
    }
}
