<?php

namespace Parfumix\FormBuilder;

use Countable;
use Parfumix\FormBuilder\Elements\Element;
use Flysap\Support\Traits\ElementsGroup;
use Flysap\Support\Traits\ElementsTrait;
use Illuminate\Contracts\Support\Arrayable;
use Iterator;

/**
 * Class Form
 * @package Flysap\FormBuilder
 */
class Form extends Element implements Arrayable, Iterator, Countable {

    use ElementsTrait, ElementsGroup;

    /**#@+
     * Method type constants
     */
    const METHOD_GET = 'get';
    const METHOD_POST = 'post';

    /**#@+
     * Encoding type constants
     */
    const ENCTYPE_URLENCODED = 'application/x-www-form-urlencoded';
    const ENCTYPE_MULTIPART = 'multipart/form-data';


    public function __construct(array $options = array()) {
        $this->setOptions($options);
    }

    /**
     * Render all attributes .
     *
     * @param string $group
     * @param bool $form
     * @return string
     */
    public function render($group = null, $form = true) {
        $result = '';

        if( $form )
            $result .= $this->openForm();

        if( $this->hasGroup($group) )
            $elements = $this->getGroup($group)
                ->getElements();
        else
            $elements = $this->getElements();

        $result .= $this->renderElements($elements);

        if( $form )
            $result .= $this->closeForm();

        return $result;
    }


    /**
     * Render specific elements .
     *
     * @param $elements
     * @return string
     */
    public function renderElements($elements) {
        $result = '';

        array_walk($elements, function ($element) use (& $result) {
            $result .= $this->renderElement($element);
        });

        return $result;
    }

    /**
     * Render element .
     *
     * @param $element
     * @return mixed
     */
    public function renderElement($element) {
        if( $element->isAllowed() )
            return $element->render();
    }


    /**
     * Open form .
     *
     * @return string
     */
    public function openForm() {
        $result = '<form';
        $result .= $this->renderAttributes();
        $result .= '>';

        return $result;
    }

    /**
     * Close form .
     *
     * @return string
     */
    public function closeForm() {
        return '</form>';
    }

    public function post() {
        $this->method(self::METHOD_POST);

        return $this;
    }

    public function get() {
        $this->method(self::METHOD_GET);

        return $this;
    }

    public function action($action) {
        $this->setAttribute('action', $action);

        return $this;
    }

    public function method($method = self::METHOD_GET) {
        return $this->setAttribute('method', $method);
    }

    public function encoding($type = self::ENCTYPE_MULTIPART) {
        $this->setAttribute('enctype', $type);

        return $this;
    }

    public function elements(array $elements) {
        $this->setElements($elements, true);

        return $this;
    }


    /**
     * Is valid form ?
     *
     * @param array $params
     * @return bool
     */
    public function isValid($params = array()) {
        $elements = $this->getElements();

        $isValid  = true;

        foreach ($elements as $element) {
            $name = $element->getAttribute('name');

            if( $value = $params[$name] )
                $element->value($value);

            if( ! $element->isValid() ) {
                $isValid = false;

                break;
            }
        }

        return $isValid;
    }

    public function toArray() {
        return $this->getElements();
    }

    public function current() {
        return current($this->elements);
    }

    public function next() {
        return next($this->elements);
    }

    public function key() {
        return key($this->elements);
    }

    public function rewind() {
        // TODO: Implement rewind() method.
    }

    public function count() {
        return count($this->elements);
    }

    public function valid() {
        return true;
    }
}