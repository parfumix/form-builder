<?php

namespace Parfumix\FormBuilder\Elements;

use Flysap\Support\Traits\ElementAttributes;

abstract class Element {

    use ElementAttributes;

    public function __construct(array $options = array()) {
        $this->setOptions($options);
    }

    /**
     * Set options from array .
     *
     * @param array $options
     */
    protected function setOptions(array $options) {
        array_walk($options, function ($value, $key) {
            if( method_exists($this, $key) )
                $this->{$key}($value);
            else
                $this->setAttribute($key, $value);
        });
    }

    /**
     * Add class ..
     *
     * @param $class
     * @return $this
     */
    public function addClass($class) {
        if (isset($this->attributes['class'])) {
            $class = $this->attributes['class'] . ' ' . $class;
        }

        $this->setAttribute('class', $class);
        return $this;
    }

    public function removeClass($class) {
        if (! isset($this->attributes['class'])) {
            return $this;
        }

        $class = trim(str_replace($class, '', $this->attributes['class']));
        if ($class == '') {
            $this->removeAttribute('class');
            return $this;
        }

        $this->setAttribute('class', $class);
        return $this;
    }

    public function id($id) {
        $this->setId($id);

        return $this;
    }

    protected function setId($id) {
        $this->setAttribute('id', $id);
    }

    abstract public function render();

    public function __toString() {
        return $this->render();
    }

    protected function renderAttributes() {
        $result = '';

        foreach ($this->getAttributes() as $attribute => $value) {
            $result .= " {$attribute}=\"{$value}\"";
        }

        return $result;
    }

    public function __call($method, $params) {
        $params = count($params) ? $params : array($method);
        $params = array_merge(array($method), $params);
        call_user_func_array(array($this, 'attribute'), $params);

        return $this;
    }
}
