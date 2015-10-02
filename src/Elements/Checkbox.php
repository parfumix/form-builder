<?php

namespace Parfumix\FormBuilder\Elements;

class Checkbox extends Input {

    protected $attributes = array(
        'type' => 'checkbox',
        'onClick' => '$(this).attr(\'value\', this.checked ? 1 : 0)'
    );

    private $checked;

    /**
     * Mark as.
     *
     * @param $value
     * @return $this
     */
    public function value($value) {
        if( $value ) {
            $this->check();
            parent::value('1');
        } else {
            $this->uncheck();
            parent::value('0');
        }

        return $this;
    }

    /**
     * Render element .
     *
     * @return string
     */
    public function render() {
        $result = $this->before;

        if( $this->hasLabel() )
            $result .= '<label>';

        $result .= '<input';
        $result .= $this->renderAttributes();
        $result .= '>';

        if( $this->hasLabel() )
            $result .=  $this->getLabel() .'</label>';

        $result .= $this->after;

        return $result;
    }

    public function defaultToChecked() {
        if (! isset($this->checked)) {
            $this->check();
        }

        return $this;
    }

    public function defaultToUnchecked() {
        if (! isset($this->checked)) {
            $this->uncheck();
        }

        return $this;
    }

    public function defaultCheckedState($state) {
        $state ? $this->defaultToChecked() : $this->defaultToUnchecked();
        return $this;
    }

    public function check() {
        $this->setChecked(true);

        return $this;
    }

    public function uncheck() {
        $this->setChecked(false);

        return $this;
    }

    protected function setChecked($checked = true) {
        $this->checked = $checked;
        $this->removeAttribute('checked');

        if ($checked) {
            $this->setAttribute('checked', 'checked');
        }
    }
}
