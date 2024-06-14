<?php

require_once 'SafeFormBuilder.php';

$safeFormBuilder = new SafeFormBuilder('post', '../lab4/task2.php', 'Send!');
$safeFormBuilder->addTextField('someName', 'Второе задание', true);
$safeFormBuilder->addRadioGroup('someRadioName', ['A', 'B'], true);
$safeFormBuilder->addSelectField('someSelectName', ['1' => 'Вариант 1', '2' => 'Вариант 2'], true);
$safeFormBuilder->addImageField('someImage', '../citrusy/images/pics02.jpg', 'Image alt text', true);
$safeFormBuilder->addColorField('someColor', '#ff0000', true);
$safeFormBuilder->getForm();
?>
