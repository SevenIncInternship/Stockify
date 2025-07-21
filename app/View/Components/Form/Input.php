<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $label;
    public $type;
    public $value;
    public $required;
    public $placeholder;

    public function __construct($name, $label = null, $type = 'text', $value = null, $required = true, $placeholder = null)
    {
        $this->name = $name;
        $this->label = $label ?? ucwords(str_replace('_', ' ', $name));
        $this->type = $type;
        $this->value = $value;
        $this->required = $required;
        $this->placeholder = $placeholder ?? "Masukkan " . strtolower($this->label);
    }

    public function render()
    {
        return view('components.form.input');
    }
}
