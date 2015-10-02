<?php

namespace Parfumix\FormBuilder\Elements;

class Select extends Input {

    private $options;
    private $selected;

    public function value($option) {
        $this->selected = $option;
        return $this;
    }

    public function select($option) {
        $this->selected = $option;
        return $this;
    }

    protected function setDataOptions($options) {
        $this->options = $options;
    }

    public function options($options) {
        $this->setDataOptions($options);
        return $this;
    }

    public function render() {
        $result = $this->before;

        $result .= '<select';
        $result .= $this->renderAttributes();
        $result .= '>';
        $result .= $this->renderOptions();
        $result .= '</select>';

        $result .= $this->after;

        return $result;
    }

    protected function renderOptions() {
        $result = '';

        foreach ($this->options as $value => $label) {
            if (is_array($label) && isset($label['group'])) {
                $result .= $this->renderOptGroup($value, $label);
                continue;
            }
            $result .= $this->renderOption($value, $label);
        }

        return $result;
    }

    protected function renderOptGroup($label, $options) {
        $result = "<optgroup label=\"{$label}\">";
        foreach ($options as $value => $label) {
            $result .= $this->renderOption($value, $label);
        }
        $result .= "</optgroup>";
        return $result;
    }

    protected function renderOption($value, $label) {
        if(is_array($label)) {
            $attributes = $label;
            $label      = isset($label['label']) ? $label['label'] : $value;
        }

        $hidden = isset($attributes['hidden']) ? 'hidden' : null;
        $disabled = isset($attributes['disabled']) ? 'disabled' : null;

        $option = '<option '.$hidden.' '.$disabled.' ';
        $option .= 'value="' . $value . '"';
        $option .= $this->isSelected($value) ? ' selected' : '';
        $option .= '>';
        $option .= $label;
        $option .= '</option>';
        return $option;
    }

    protected function isSelected($value) {
        return in_array($value, (array)$this->selected);
    }

    public function addOption($value, $label) {
        $this->options[$value] = $label;
        return $this;
    }

    public function defaultValue($value) {
        if (isset($this->selected)) {
            return $this;
        }

        $this->select($value);
        return $this;
    }

    public function multiple() {
        $name = $this->attributes['name'];
        if (substr($name, -2) != '[]') {
            $name .= '[]';
        }

        $this->setName($name);
        $this->setAttribute('multiple', 'multiple');
        return $this;
    }
}
