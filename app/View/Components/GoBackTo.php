<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GoBackTo extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $href;
    public $pageName;

    public function __construct($href='/', $pageName='')
    {
        //
        $this->href = $href;
        $this->pageName = $pageName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.go-back-to');
    }
}
