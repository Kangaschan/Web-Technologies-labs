<?php
require_once "FormBuilder.php";
$safeFormBuilder = new FormBuilder('post', '../lab4/task1.php', 'Send!');
$safeFormBuilder->addTextField('someName', 'Первое задание', true);
$safeFormBuilder->addRadioGroup('someRadioName', ['A', 'B'], false);
$safeFormBuilder->addSelectField('someSelectName', ['1' => 'вариант 1', '2' => 'вариант 2'], true);
$safeFormBuilder->addImageField('someImage', '../citrusy/images/pics02.jpg', 'Image alt text', true);
$safeFormBuilder->addColorField('someColor', '#ffff00', true);
$safeFormBuilder->getForm();

?>
