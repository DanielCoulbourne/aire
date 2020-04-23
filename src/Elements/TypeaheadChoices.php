<?php

namespace Galahad\Aire\Elements;

use Illuminate\Support\Str;

class TypeaheadChoices extends Element
{
    public $name = 'typeahead-choices';

    public function __construct(Typeahead $typeahead)
    {
        $this->view_data = $typeahead->getViewData();
        $this->aire = $typeahead->aire;
        $this->attributes = $typeahead->attributes;
        $this->view_data['options'] = isset($typeahead->view_data['options']) ? collect($typeahead->view_data['options'])->map(function ($choice) {
            return [
                'value' => Str::slug($choice),
                'label' => $choice,
            ];
        })->toJson() : false;
    }
}
