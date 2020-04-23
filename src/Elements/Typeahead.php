<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\HasOptions;
use Galahad\Aire\Support\OptionsCollection;
use Illuminate\Container\Container;

class Typeahead extends Element
{
    use HasOptions;
    
    public $name = 'typeahead';
    protected $plugin = 'typeahead';
    
    public function __construct(Aire $aire, Form $form = null)
    {
        parent::__construct($aire, $form);
        
        $this->view_data['multiple'] = false;
        $this->view_data['allow_arbitrary_input'] = false;
    }

    public function render() : string
    {
        return Container::getInstance()
            ->make("galahad.aire.plugin.{$this->plugin}", ['typeahead' => $this])
            ->render();
    }
    
    public function configureJavascript(array $config = []) : self
    {
        $this->view_data['plugin_config'] = $config;
        
        return $this;
    }

    public function multiple(bool $multiple = true) : self
    {
        $this->view_data['multiple'] = $multiple;
        
        return $this;
    }
    
    public function options(array $options) : self
    {
        $this->view_data['options'] = $options;
        
        return $this;
    }
    
    public function loadOptionsFrom(string $ajax_url) : self
    {
        $this->view_data['ajax_url'] = $ajax_url;
        
        return $this;
    }
    
    public function allowArbitraryInput(bool $allow_arbitrary_input = true) : self
    {
        $this->view_data['allow_arbitrary_input'] = $allow_arbitrary_input;
        
        return $this;
    }
    
    public function name($value = null)
    {
        $this->attributes['name'] = $value;
        
        return $this;
    }
}
