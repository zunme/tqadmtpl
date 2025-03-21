<?php
namespace Taq\Tqadmtpl\Classes;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Exception;


class TqMenuClass{
    protected $user;
    protected $routename;
    protected $current_id, $parent_id;

    public function __construct(){
        $this->routename = \Request::route()->getName();
        return $this;
    }
    public function get( $user = null ){
        $this->user = $user ?? \Auth::guard('admin')->user();
        $arr = array();
        if( !$this->user ) return false;
        if( \Route::has('tqpermission.direct.index') && \Str::startsWith($this->user->userid, 'zunme') || \Str::startsWith($this->user->email, 'zunme')  ){
            $addmenu = [
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
        }else $addmenu = null;
        $menus = config('tqadmtpl.menus');
        if($addmenu) $menus = array_merge( $menus, $addmenu);
        foreach ( $menus as $menu){
            if( isset($menu['items']) ) {
                $data = $this->checkgroup( $menu);
            }else {
                $data = $this->checkitem( $menu);
            }
            if( $data != false ) $arr[] = $data;
        }
        return [
            'menus'=>$arr,
            'user'=>$this->user, 
            'routename'=>$this->routename,
            'current_id'=>$this->current_id, 
            'parent_id'=>$this->parent_id
        ];
    }
    protected function checkgroup( $menu){
        $items = [];
        $groupid = 'menu_colasp_'.\Str::random(8);
        $selected = false;

        foreach( $menu['items'] as $submenu ){
            $data = $this->checkitem($submenu , $groupid);
            if( $data != false ) $items[] = $data;
            if( optional($data)->selected ) $selected = true;
        }
        if( count($items) < 1 ) return false;

        return  (object)[
            'hassub'=>true, 
            'type'=>'group',
            'icon'=>isset($menu['icon']) && $menu['icon'] ? $menu['icon'] :'fa-regular fa-circle', 
            'label'=>isset($menu['label']) && $menu['label'] ? $menu['label'] :'',
            'selected'=>$selected,
            'id' => $groupid,
            'parent_id'=>null,
            'sub'=>$items
        ];
    }
    protected function checkitem( $item , $parent_id=null){
        if( !isset($item['id'])) return false;
        $access = !isset($item['can']) || !$item['can'] ? true : $this->user->can( $item['can']);
        if( !$access ) return false;
        $menu_id = 'menu_item_'.\Str::random(8);
        $selected = ($this->routename == (isset($item['route']) && $item['route'] ? $item['route'] : '---'));
        if( $selected ) {
            $this->current_id = $menu_id;
            $this->parent_id = $parent_id;
        }

        return (object) [
            'hassub'=>false,
            'type'=>'item',
            'selected' => $selected,
            'label'=>isset($item['label']) && $item['label'] ? $item['label'] :'',
            'id'=>$menu_id,
            'link'=>isset($item['route']) && $item['route'] ? route($item['route'],[],false) : (isset($item['link']) ? $item['link'] : false ),
            'icon'=>isset($item['icon']) ? $item['icon'] :'fa-regular fa-circle-dot',
            'parent_id'=>$parent_id,
            'target' => isset($item['target']) && $item['target'] ? $item['target'] :'',
        ];
    }
}