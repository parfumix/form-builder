<?php

namespace Parfumix\FormBuilder\Elements;

class TextArea extends Input {

    protected $attributes = array(
        'rows' => 10,
        'cols' => 50,
    );

    protected $value;

    public function render() {
        $result = $this->before;

        if( $this->hasLabel() )
            $result .= '<label>' . $this->getLabel();

        $result .= '<textarea';
        $result .= $this->renderAttributes();
        $result .= '>';
        $result .= $this->value;
        $result .= '</textarea>';

        if( $this->hasLabel() )
            $result .= '</label>';

        $result .= $this->after;

        return $result;
    }

    public function rows($rows) {
        $this->setAttribute('rows', $rows);
        return $this;
    }

    public function cols($cols) {
        $this->setAttribute('cols', $cols);
        return $this;
    }

    public function value($value) {
        $this->value = $value;
        return $this;
    }

    public function placeholder($placeholder) {
        $this->setAttribute('placeholder', $placeholder);
        return $this;
    }

    public function defaultValue($value) {
        if (! $this->hasValue()) {
            $this->value($value);
        }

        return $this;
    }

    protected function hasValue() {
        return isset($this->value);
    }
}
