<?php

namespace Taq\Tqadmtpl\Livewire;
use Livewire\Component;
use Carbon\Carbon;

class TqadmSide extends Component
{
    public $menus;
    public $routename;

    public function mount(){
        $this->user = \Auth::guard('web')->user();
        $this->routename = \Request::route()->getName();
        $menu = [

        ];
        $menu = array_merge( config('tqadmtpl.menus'), $menu);
        $menu = $this->checkmenu( $menu );
        if( !$menu ) $this->menus = [];
        else $this->menus = $menu;
    }

    public function render()
    {
        return view('tqadmtpl::livewire.side');
    }

    protected function checkmenu($menus){
        $tempmenu = [];

        foreach( $menus as $menu ){
            if( isset($menu['items'])){
                $temp = $this->groupcheck( $menu);
                if( $temp ) $tempmenu[] = $temp; 
            }else{
                $temp = $this->itemcheck( $menu);
                if( $temp ) $tempmenu[] = $temp; 
            }
        };
        return $tempmenu;
    }
    protected function groupcheck( $group){
        $items = [];
        foreach( $group['items'] as $menu ){
            $temp = $this->itemcheck( $menu);
            if( $temp ) $items[] = $temp; 
        }
        if( count($items)  < 1 ) return false;
        $group['items'] = $items;
        $group['type'] = 'group';
        $group['label'] = !isset($group['label']) || !$group['label']  ? "menu" : $group['label'];
        $group['id'] = 'menu_grp_'.\Str::random(8);
        return (object)$group;
    }
    protected function itemcheck( $item){
        if( !isset($item['id'])) return false;
        if( $item['id']=='test'){
            $access =true;
        }else $access = $item['can'] == '' ? true : $this->user->can( $item['can']);
        if( !$access) return false;
        $item['access'] = true;
        $item['isActive'] = ($this->routename == (isset($item['route']) ? $item['route'] : '---'));
        //dump( (isset($item['route']) ? $item['route'] : '---') );
        $item['id'] = 'menu_item_'.\Str::random(8);
        $item['type'] = 'item';
        $item['link'] = isset($item['route']) && $item['route'] ?  route($item['route']) : '#';
        
        return (object)($item);
    }
}
