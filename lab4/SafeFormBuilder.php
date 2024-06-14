<?php
require_once 'FormBuilder.php';
class SafeFormBuilder extends FormBuilder {
    public function __construct($method = 'post', $action = '', $submitText = 'Submit') {
        parent::__construct($method, $action, $submitText);
    }
    public function addTextField($name, $defaultValue = '', $useGlobalDefault = false) {
        if ($useGlobalDefault && isset($_POST[$name])) {
            parent::addTextField($name, htmlspecialchars($_POST[$name]));
        } else {
            parent::addTextField($name, $defaultValue);
        }
    }

    public function addRadioGroup($name, $options, $selected = null) {

        $selectedValue = isset($_POST[$name]) ? htmlspecialchars($_POST[$name]) : '';

        parent::addRadioGroup($name, $options, $selectedValue);
    }


    public function addSelectField($name, $options, $selected = null) {
        $selectedValue = isset($_POST[$name]) ? htmlspecialchars($_POST[$name]) : '';
        parent::addSelectField($name, $options, $selectedValue);
    }
    public function addImageField(string $name, string $src = '', string $alt = '', $useGlobalDefault = false) {
        if ($useGlobalDefault && isset($_POST[$name])) {
            parent::addImageField($name, htmlspecialchars($_POST[$name]), htmlspecialchars($_POST[$name]), $alt);
        } else {
            parent::addImageField($name, $src, $alt);
        }
    }

    public function addColorField(string $name, string $value = '#000000', $useGlobalDefault = false) {
        if ($useGlobalDefault && isset($_POST[$name])) {
            parent::addColorField($name, htmlspecialchars($_POST[$name]));
        } else {
            parent::addColorField($name, $value);
        }
    }
}