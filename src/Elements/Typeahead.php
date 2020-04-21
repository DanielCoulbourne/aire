<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Support\OptionsCollection;
use Illuminate\Container\Container;

class Typeahead extends Element
{
    public $name = 'typeahead';
    
    protected $plugin = 'typeahead';
    
    public function __construct(Aire $aire, Form $form = null)
    {
        $this->view_data['options'] = new OptionsCollection();
        
        parent::__construct($aire, $form);
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
}
