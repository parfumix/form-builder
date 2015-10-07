<?php

namespace Parfumix\FormBuilder;

use Parfumix\FormBuilder\Elements\Button;

/**
 * Create form
 *
 * @param $params
 * @return Form
 */
function create_form(array $params = array()) {
    return (new Form($params));
}

/**
 * Open form
 *
 * @param $form
 * @return mixed
 */
function open_form($form) {
    return $form->openForm();
}

/**
 * Render all the form .
 *
 * @param $form
 * @param bool $open
 * @return mixed
 */
function render($form, $open = true) {
    return $form->render(null, $open);
}

/**
 * Render elements .
 *
 * @param $elements
 * @param $form
 * @return mixed
 */
function render_elements($elements, $form) {
    return $form->renderElements($elements);
}

/**
 * Render element
 *
 * @param $element
 * @param $form
 * @param array $attributes
 * @return mixed
 */
function render_element($element, $form, $attributes = array()) {
    $element->addAttributes($attributes);

    return $form->renderElement($element);
}

/**
 * Has form groups ?
 *
 * @param $form
 * @return bool
 */
function has_groups($form) {
    return $form->getGroups();
}

/**
 * Render group .
 *
 * @param $group
 * @param $form
 */
function render_group($group, $form) {
    return $form->render($group, false);
}

/**
 * Render specific fields .
 *
 * @param $fields
 * @param $form
 * @return mixed
 */
function render_fields($fields, $form) {
    if(! is_array($fields))
        $fields = (array)$fields;

    $elements = $form->getElements($fields);

    return $form->renderElements($elements);
}

/**
 * Render button .
 *
 * @param array $attributes
 * @return string
 */
function render_button(array $attributes = array()) {
    return (new Button($attributes))
        ->render();
}

/**
 * Close form .
 *
 * @param $form
 * @return mixed
 */
function close_form($form) {
    return $form->closeForm();
}

/**
 * Get instance form element .
 *
 * @param $alias
 * @param array $attributes
 * @throws ElementException
 */
function get_element($alias, $attributes = array()) {
    $aliases = config('form-builder')['fields'];

    $alias = strtolower($alias);

   if( ! isset($aliases[$alias]) )
       throw new ElementException(_('Invalid element type.'));

    $class = $aliases[$alias];

    if(! class_exists($class))
        throw new ElementException(_('Cannot found element.'));

    return (new $class($attributes));
}


/**
 * Get instance of element custom .
 *
 * @param array $attributes
 * @return mixed
 * @throws ElementException
 */
function element_custom($attributes = array()) {
    return get_element('custom', $attributes);
}

function element_link($label, $attributes = array()) {
    return get_element('link', ['label' => $label] + $attributes);
}

function element_text($label, $attributes = array()) {
    return get_element('text', ['label' => $label] + $attributes);
}

function element_button($label, $attributes = array()) {
    return get_element('button', ['label' => $label] + $attributes);
}

function element_checkbox($label, $attributes = array()) {
    return get_element('checkbox', ['label' => $label] + $attributes);
}

function element_date($label, $attributes = array()) {
    return get_element('date', ['label' => $label] + $attributes);
}

function element_radio($label, $attributes = array()) {
    return get_element('radio', ['label' => $label] + $attributes);
}

function element_email($label, $attributes = array()) {
    return get_element('email', ['label' => $label] + $attributes);
}

function element_file($label, $attributes = array()) {
    return get_element('file', ['label' => $label] + $attributes);
}

function element_hidden($label, $attributes = array()) {
    return get_element('hidden', ['label' => $label] + $attributes);
}

function element_password($label, $attributes = array()) {
    return get_element('password', ['label' => $label] + $attributes);
}

function element_select($label, $attributes = array()) {
    return get_element('select', ['label' => $label] + $attributes);
}

function element_image($label, $attributes = array()) {
    return get_element('image', ['label' => $label] + $attributes);
}

function element_textarea($label, $attributes = array()) {
    return get_element('textarea', ['label' => $label] + $attributes);
}

function element_fieldset($label, array $elements, $attributes = array()) {
    $element = get_element('fieldset', ['label' => $label] + $attributes);
    $element->elements($elements);

    return $element;
}