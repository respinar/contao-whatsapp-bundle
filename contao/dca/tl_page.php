<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->addLegend(
        "whatsapp_legend",
        "protected_legend",
        PaletteManipulator::POSITION_BEFORE
    )
    ->addField(
        [
            "whatsappTitle",
            "whatsappDisabled",
            "whatsappNumber",
            "whatsappMessage",
        ],
        "whatsapp_legend",
        PaletteManipulator::POSITION_APPEND
    )
    ->applyToPalette("regular", "tl_page");

// Define fields
$GLOBALS["TL_DCA"]["tl_page"]["fields"]["whatsappDisabled"] = [
    "exclude" => true,
    "inputType" => "checkbox",
    "eval" => ["tl_class" => "w50 m12"],
    "sql" => "char(1) NOT NULL default ''",
];

$GLOBALS["TL_DCA"]["tl_page"]["fields"]["whatsappTitle"] = [
    "exclude" => true,
    "inputType" => "text",
    "eval" => ["maxlength" => 255, "tl_class" => "w50"],
    "sql" => "varchar(255) NOT NULL default ''",
];

$GLOBALS["TL_DCA"]["tl_page"]["fields"]["whatsappNumber"] = [
    "exclude" => true,
    "inputType" => "text",
    "eval" => ["rgxp" => "phone", "maxlength" => 20, "tl_class" => "w50"],
    "sql" => "varchar(20) NOT NULL default ''",
];

$GLOBALS["TL_DCA"]["tl_page"]["fields"]["whatsappMessage"] = [
    "exclude" => true,
    "inputType" => "text",
    "eval" => ["maxlength" => 255, "tl_class" => "w50"],
    "sql" => "varchar(255) NOT NULL default ''",
];
