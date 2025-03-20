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
        $data = [
            'min_width' => config('tqadmtpl.size.min_width'),
            'max_width' => config('tqadmtpl.size.max_width'),
        
            'min_sidebar' => config('tqadmtpl.size.min_sidebar'),
            'max_sidebar' => config('tqadmtpl.size.minmax_sidebar_width'),
        
            'min_main' => config('tqadmtpl.size.min_main'),
            'max_main' => config('tqadmtpl.size.max_main'),
        ];
        return view('tqadmtpl::components.layout', $data );
    }
}