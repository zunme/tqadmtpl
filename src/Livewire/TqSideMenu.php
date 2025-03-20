<?php

namespace Taq\Tqadmtpl\Livewire;
use Livewire\Component;
use Carbon\Carbon;
use Taq\Tqadmtpl\Classes\TqMenuClass;
use Auth;
//other version
class TqSideMenu extends Component
{
    public $menus;
    public $routename;
    protected $user;
    public $current_id='';
    public $parent_id='';
    public function mount(){
        $ret = (new TqMenuClass)->get(Auth::guard('admin')->user());
        $this->menus = $ret['menus'];
        $this->routename = $ret['routename'];
        $this->user = $ret['user'];
        $this->current_id = $ret['current_id'];
        $this->parent_id = $ret['parent_id'];
    }
    public function render()
    {
        return view('tqadmtpl::livewire.sidemenuv2');
    }
}