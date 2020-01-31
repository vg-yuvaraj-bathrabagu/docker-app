<?php
/**
 * Lookup values used around the application, until a better design pattern can be found
 */

namespace App\Helper;


trait LookupValues
{

    /**
     * File formats for templates
     */
    public function getFileTemplateFormats() {
        return ["<Select One>" => "", "Text" => "Text", "Parquet" => "Parquet", "ORC" => "ORC", "JSON" => "JSON"];
    }

    public function getTemplateCreationTypes() {
        return ["Core" => "Core","User" => "User"];
    }

    public function getDelimiters() {
        return ["Comma (,)" => ","];
    }

    public function getTemplateDataTypes() {
        return [ "String" => "String", "Double" => "Double", "Date" => "Date", "Int" => "Int"];
    }

}