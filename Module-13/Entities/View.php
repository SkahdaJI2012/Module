<?php

namespace Entities;

use Interfaces\IRender;

abstract class View implements IRender
{
    protected array $variablesArrayProt;
    protected string $templateNameProt;

    function __construct(string $templateName)
    {
        $this->templateNameProt = $templateName;
    }

    function addVariablesToTemplate(array $variables): void
    {
        $this->variablesArrayProt = $variables;
    }
}
