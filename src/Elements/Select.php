<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\HasJsonValue;
use Galahad\Aire\Elements\Concerns\AutoId;
use Galahad\Aire\Elements\Concerns\HasOptions;
use Galahad\Aire\Elements\Concerns\HasValue;
use Galahad\Aire\Elements\Concerns\MapsValueToJsonValue;

class Select extends \Galahad\Aire\DTD\Select implements HasJsonValue
{
    use HasValue, HasOptions, AutoId, MapsValueToJsonValue;
    
    public function __construct(Aire $aire, $options, Form $form = null)
    {
        parent::__construct($aire, $form);
        
        $this->setOptions($options);
        
        $this->attributes->registerMutator('name', function ($name) {
            return $this->attributes->get('multiple', false)
                ? preg_replace('/\[\]$/', '', $name).'[]'
                : $name;
        });
        
        $this->registerAutoId();
    }

    public function withJavascript($config = [])
    {
        if (! class_exists(InterNACHI\AireSelect::class)) {
            throw new \Exception("To use the `Select::withJavascript()` method, please run `composer install internachi/aire-select`", 1);
        }
        
        return new InterNACHI\AireSelect($this, $config);
    }
}
