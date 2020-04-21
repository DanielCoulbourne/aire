<?php

namespace Galahad\Aire\Elements;

use Illuminate\Container\Container;

class TypeaheadChoices extends Element
{
    public $name = 'typeahead-choices';
    
    public function __construct(Typeahead $typeahead)
    {
        $this->view_data = $typeahead->getViewData();
        $this->aire = $typeahead->aire;
        $this->attributes = $typeahead->attributes;
    }
}
