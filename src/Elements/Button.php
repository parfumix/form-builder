<?php

namespace Parfumix\FormBuilder\Elements;

class Button extends Input {

    /**
     * @var array
     */
    protected $attributes = array(
        'type' => 'button',
    );

    /**
     * @var
     */
    protected $value;

    public function render() {
        $result = '<button';
        $result .= $this->renderAttributes();
        $result .= '>';
        $result .= $this->value;
        $result .= '</button>';

        return $result;
    }

    public function value($value) {
        $this->value = $value;
    }
}
