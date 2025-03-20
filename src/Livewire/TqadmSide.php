<?php

namespace Taq\Tqadmtpl\Livewire;
use Livewire\Component;
use Carbon\Carbon;

class TqadmSide extends Component
{
    public $menus;
    public $routename;

    public function mount(){
        $this->user = \Auth::guard('admin')->user();
        if( !$this->user ) $this->redirect('/');
        $this->routename = \Request::route()->getName();
        if( \Route::has('tqpermission.direct.index') && \Str::startsWith($this->user->userid, 'zunme') || \Str::startsWith($this->user->email, 'zunme')  ){
            $menu = [
                [
                    'label' =>'Role',
                    'icon'=>'fa-regular fa-id-card',
                    'items'=>[
                        [
                            'label'=>'Role',
                            'id'=>'qna',
                            'route'=>'tqpermission.roles.index',
                            'icon'=>'fa-solid fa-r',
                            'target'=>'_role',
                            'can'=>''
                        ],
                        [
                            'label'=>'permissions',
                            'id'=>'contact',
                            'route'=>'tqpermission.permissions.index',
                            'icon'=>'fa-solid fa-p',
                            'target'=>'_role',
                            'can'=>''
                        ],
                        [
                            'label'=>'Direct',
                            'id'=>'contact',
                            'route'=>'tqpermission.direct.index',
                            'icon'=>'fa-solid fa-d',
                            'target'=>'_role',
                            'can'=>''
                        ],
                    ]
                ],
            ];
        }else $menu = [];
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
            $temp = $this->itemcheck( $menu , true);
            if( $temp ) $items[] = $temp; 
        }
        if( count($items)  < 1 ) return false;
        $group['items'] = $items;
        $group['type'] = 'group';
        $group['label'] = !isset($group['label']) || !$group['label']  ? "menu" : $group['label'];
        $group['id'] = 'menu_grp_'.\Str::random(8);
        return (object)$group;
    }
    protected function itemcheck( $item, $is_sub = false){
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
        $item['is_sub'] = $is_sub;
        return (object)($item);
    }
}
