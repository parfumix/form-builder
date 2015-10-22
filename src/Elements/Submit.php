<?php

namespace Parfumix\FormBuilder\Elements;

class Submit extends Input {

    /**
     * @var array
     */
    protected $attributes = array(
        'type' => 'submit',
    );

    /**
     * @var
     */
    protected $value;

    public function render() {
        $result = '<input';
        $result .= $this->renderAttributes();
        $result .= '>';

        return $result;
    }
}
