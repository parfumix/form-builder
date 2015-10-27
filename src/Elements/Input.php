<?php

namespace Parfumix\FormBuilder\Elements;

use Flysap\Support\Traits\ElementPermissions;
use Illuminate\Validation\Validator;

abstract class Input extends Element {

    use ElementPermissions;

    /**
     * @var
     */
    protected $rules;

    /**
     * @var
     */
    protected $before;

    /**
     * @var
     */
    protected $after;

    /**
     * @var
     */
    protected $label;

    /**
     * Render element .
     *
     * @return string
     */
    public function render() {
        $result = $this->before;

        if( $this->hasLabel() )
            $result .= '<label>' . $this->getLabel() . '</label>';

        $result .= '<input';
        $result .= $this->renderAttributes();
        $result .= '>';

        $result .= $this->after;

        return $result;
    }

    /**
     * Set label .
     *
     * @param $name
     * @return $this
     */
    public function label($name) {
        $this->label = $name;

        return $this;
    }

    /**
     * Check if has label .
     *
     * @return bool
     */
    public function hasLabel() {
        return !empty($this->label);
    }

    /**
     * Get label .
     *
     * @return mixed
     */
    public function getLabel() {
        return $this->label;
    }


    /**
     * Adding before html
     *
     * @param $value
     * @return $this
     */
    public function before($value) {
        $this->before = $value;

        return $this;
    }

    /**
     * Adding after html .
     *
     * @param $value
     * @return $this
     */
    public function after($value) {
        $this->after = $value;

        return $this;
    }


    /**
     * @param $value
     * @return $this
     */
    public function value($value) {
        $this->setAttribute('value', $value);

        return $this;
    }

    /**
     * Set name
     *
     * @param $value
     * @return $this
     */
    public function name($value) {
        $this->setAttribute('name', $value);

        return $this;
    }


    /**
     * Check if has rules .
     *
     * @return bool
     */
    public function hasRules() {
        if( $this->rules )
            return true;

        return false;
    }

    /**
     * Set rules .
     *
     * @param $rules
     * @return $this
     */
    public function rules($rules) {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Is valid element
     *
     * @return bool
     */
    public function isValid() {
        if(! $this->hasRules())
            return true;

        return;

        $this->validator = Validator::make($this->getAttribute('value'), $this->rules);

        if( $this->validator->fails() )
            return false;

        return true;
    }


    /**
     * @return mixed
     */
    public function getErrors() {
        return $this->validator->errors();
    }

}
