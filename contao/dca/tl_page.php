<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->addLegend("whatsapp_legend", "protected_legend", PaletteManipulator::POSITION_BEFORE)
    ->addField(["whatsappTitle", "whatsappDisabled", "whatsappNumber", "whatsappMessage"], "whatsapp_legend", PaletteManipulator::POSITION_APPEND)
    ->applyToPalette("regular", "tl_page")
    ->applyToPalette('root', 'tl_page')
    ->applyToPalette('rootfallback', 'tl_page');

// Define fields
$GLOBALS["TL_DCA"]["tl_page"]["fields"]["whatsappDisabled"] = [
    "exclude" => true,
    "inputType" => "checkbox",
    "eval" => ["tl_class" => "w50 m12"],
    "sql" => ['type' => 'boolean', 'default' => false],
];

$GLOBALS["TL_DCA"]["tl_page"]["fields"]["whatsappTitle"] = [
    "exclude" => true,
    "inputType" => "text",
    "eval" => ["maxlength" => 255, "tl_class" => "w50"],
    "sql" => ['type' => 'string', 'length' => 255, 'default' => ''],
];

$GLOBALS["TL_DCA"]["tl_page"]["fields"]["whatsappNumber"] = [
    "exclude" => true,
    "inputType" => "text",
    "eval" => ["rgxp" => "phone", "maxlength" => 20, "tl_class" => "w50"],
    "sql" => ['type' => 'string', 'length' => 20, 'default' => ''],
];

$GLOBALS["TL_DCA"]["tl_page"]["fields"]["whatsappMessage"] = [
    "exclude" => true,
    "inputType" => "text",
    "eval" => ["maxlength" => 255, "tl_class" => "w50"],
    "sql" => ['type' => 'string', 'length' => 255, 'default' => ''],
];
