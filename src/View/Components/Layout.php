<?php

namespace Taq\Tqadmtpl\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Layout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('tqadmtpl::components.layout');
    }
}