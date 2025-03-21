<?php

namespace Taq\Tqadmtpl\Livewire;
use Livewire\Component;
use Carbon\Carbon;
use Taq\Tqadmtpl\Classes\TqMenuClass;

class TqadmSidePersist extends Component
{
    public $menus;
    public $routename;
    public $min_width, $max_width;
    public $current_id='';
    public $parent_id='';

    public function mount($min_width='', $max_width=''){
        $ret = (new TqMenuClass)->get();
        if( $ret === false ) $this->redirect('/');
        $this->user = $ret['user'];
        $this->routename = $ret['routename'];
        $this->current_id = $ret['current_id'];
        $this->parent_id = $ret['parent_id'];
        $this->menus = $ret['menus'];
        $this->min_width=$min_width;
        $this->max_width=$max_width;
    }
    public function render()
    {
        $top_label = config('tqadmtpl.menu_label.label','Admin');
        $top_link = config('tqadmtpl.menu_label.link','/djemals');
        $top_label_f =  mb_substr( $top_label, 0, 1);
        $top_label_l =  mb_substr( $top_label, 1); 
        $data=[
            'toplabel'=>compact(['top_link','top_label_f','top_label_l','top_label']),
            'group_menu_icon_change'=>config('tqadmtpl.group_menu_icon_change'),
            'default_text_color'=>config('tqadmtpl.default_text_color'),
            'border_b'=>true
        ];

        return view('tqadmtpl::livewire.side-persist',$data);
    }
    public function chageroute( $id, $parent_id ){
        $this->current_id = $id;
        $this->parent_id = $parent_id;
    }
}
