<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $modalId;
    public $modalHeader;
    public $modalTitle;
    public $modalBody;
    public $modalFooter;
    public $closeBtn;

    public function __construct($modalId='', $modalHeader=true, $modalTitle='', $modalBody='', $modalFooter=true, $closeBtn='Close')
    {
        //
        $this->modalId = $modalId;
        $this->modalHeader = $modalHeader;
        $this->modalTitle = $modalTitle;
        $this->modalBody = $modalBody;
        $this->modalFooter = $modalFooter;
        $this->closeBtn = $closeBtn;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
