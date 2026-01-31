<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toggle extends Component
{
    public $model;
    public $label;
    public $id;

    /**
     * Create a new component instance.
     */
    public function __construct($model, $label = '', $id = null)
    {
        $this->model = $model;
        $this->label = $label;
        $this->id = $id ?? 'toggle-' . $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.toggle');
    }
}