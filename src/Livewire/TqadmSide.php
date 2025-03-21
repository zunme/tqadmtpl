<?php

namespace Taq\Tqadmtpl\Livewire;
use Livewire\Component;
use Carbon\Carbon;

class TqadmSide extends Component
{
    public $menus;
    public $routename;
    public $min_width, $max_width;

    public function mount($min_width='', $max_width=''){
        $this->user = \Auth::guard('admin')->user();
        if( !$this->user ) $this->redirect('/');
        $this->routename = \Request::route()->getName();
        if( \Route::has('tqpermission.direct.index') && \Str::startsWith($this->user->userid, 'zunme') || \Str::startsWith($this->user->email, 'zunme')  ){
            $menu = [
                [
                    'label' =>'Role',
                    'icon'=>'fa-solid fa-shield-halved',
                    'items'=>[
                        [
                            'label'=>'Role',
                            'id'=>'qna',
                            'route'=>'tqpermission.roles.index',
                            'icon'=>'fa-solid fa-r',
                            'target'=>'',
                            'can'=>''
                        ],
                        [
                            'label'=>'permissions',
                            'id'=>'contact',
                            'route'=>'tqpermission.permissions.index',
                            'icon'=>'fa-solid fa-p',
                            'target'=>'',
                            'can'=>''
                        ],
                        [
                            'label'=>'Direct',
                            'id'=>'contact',
                            'route'=>'tqpermission.direct.index',
                            'icon'=>'fa-solid fa-d',
                            'target'=>'',
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
        ];

        return view('tqadmtpl::livewire.side',$data);
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
        $isActive = false;

        foreach( $group['items'] as $menu ){
            $temp = $this->itemcheck( $menu , true);
            if( $temp ) {
                $items[] = $temp; 
                if($temp->isActive) $isActive = true;
            }
        }
        if( count($items)  < 1 ) return false;
        $group['items'] = $items;
        $group['type'] = 'group';
        $group['label'] = !isset($group['label']) || !$group['label']  ? "menu" : $group['label'];
        $group['id'] = 'menu_grp_'.\Str::random(8);
        $group['isActive'] = $isActive;

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
        if( !isset($item['link']) || !$item['link'] ){
            $item['link'] = isset($item['route']) && $item['route'] ?  route($item['route']) : '';
        }
        $item['target'] = isset($item['target']) && $item['target'] ?  $item['target'] : '';
        $item['is_sub'] = $is_sub;
        return (object)($item);
    }
}
