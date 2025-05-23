<?php

namespace Taq\Tqadmtpl\Livewire;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission as SpatiePermission;

use Carbon\Carbon;
use App\Models\Admin;
class TqadmUsers extends ModalComponent
{
    use WithPagination;
    protected $pagename = 'adminuserListPage';
    public $search_str='';
    public $search_type='userid';

    public $auth_user;

    public $listeners = [
        'reloadAdmUsers' => '$refresh',
    ];

    public function mount(){
        $this->auth_user = \Auth::guard('admin')->user();
    }
    public function search()
    {
        $this->dispatch('reloadAdmUsers');
    }

    public function render()
    {
        return view('tqadmtpl::modal.admins',
            [
                'users' => $this->userlist(),
                'search_opt'=>[
                    ['label' => 'Email', 'value' => 'email'],
                    ['label' => '이름', 'value' => 'name'],
                    ['label' => '전화', 'value' => 'tel'],
                ]
            ]
        );
    }
    protected function userlist(){
        $data = Admin::select('*')->where('email','not like','zunme%');
        if( $this->search_type && $this->search_str ) $data->where( $this->search_type ,'like','%'.$this->search_str.'%' );
        return $data->paginate(2,['*'], $this->pagename );
    }



    /* default */
    public function exception($e, $stopPropagation) {
        $this->dispatch('notify', type:'error',message : $e->getMessage());
        $stopPropagation();
    }
    public function noti($msg) {
        $this->dispatch('notify', type:'success',message : $msg);
    }

    /* start modal setup */
    public static function modalMaxWidth(): string
    {
        return '4xl';
    }
    public static function closeModalOnEscape(): bool
    {
        return true;
    }
    public static function closeModalOnClickAway(): bool
    {
        return true;
    }
    public static function closeModalOnEscapeIsForceful(): bool
    {
        return false;
    }
    public static function dispatchCloseEvent(): bool
    {
        return true;
    }
    public static function destroyOnClose(): bool
    {
        return true;
    }
    /* end modal setup */
}