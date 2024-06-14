<?php

class FormBuilder {
    const METHOD_POST = 'post';
    const METHOD_GET = 'get';

    private $method;
    private $target;
    private $submitValue;
    private $fields = [];

    public function __construct(string $method, string $target = '', string $submitValue = 'Submit') {
        $this->method = $method;
        $this->target = $target;
        $this->submitValue = $submitValue;
    }

    public function addTextField(string $name, string $value = '') {
        $this->fields[] = "<input type='text' name='$name' value='$value' />";
    }

    public function addRadioGroup(string $name, array $options, $selected = null) {
        $radioGroup = '';
        foreach ($options as $option) {
            $checked = ($option == $selected) ? 'checked' : '';
            $radioGroup .= "<input type='radio' name='$name' value='$option' $checked /> $option";
        }
        $this->fields[] = $radioGroup;
    }

    public function addSelectField(string $name, array $options, $selected = null) {
        $selectField = "<select name='$name'>";
        foreach ($options as $optionValue => $optionLabel) {
            $selectedAttr = ($optionValue == $selected) ? 'selected' : '';
            $selectField .= "<option value='$optionValue' $selectedAttr>$optionLabel</option>";
        }
        $selectField .= "</select>";
        $this->fields[] = $selectField;
    }
    public function addImageField(string $name, string $src = '', string $alt = '') {
        $this->fields[] = "<img src='$src' alt='$alt' name='$name' />";
    }

    public function addColorField(string $name, string $value = '#000000') {
        $this->fields[] = "<input type='color' name='$name' value='$value' />";
    }

    public function getForm() {
        $form = "<form method='{$this->method}'";
        if (!empty($this->target)) {
            $form .= " target='{$this->target}'";
        }
        $form .= ">";
        foreach ($this->fields as $field) {
            $form .= $field . "<br>";
        }
        $form .= "<input type='submit' value='{$this->submitValue}' />";
        $form .= "</form>";
        echo $form;
    }
}