<?php

namespace Taq\Tqadmtpl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TqMemo extends Model
{
    use SoftDeletes;
	protected $fillable = ['write_user_id','memo','etc','type'];
	protected $casts = [
		'etc'=>'array',
	];
	public function writeuser(){
		return $this->belongsTo(\App\Models\User::class, 'write_user_id', 'id');
	}
	public function tqmemotag()
    {
        return $this->morphTo();
    }
    /*
    ** add model 
    public function memos()
    {
        return $this->morphMany(Taq\Tqadmtpl\Models\TqMemo::class, 'tqmemotag');
    }
        model->memos()->create([...])
        $tqmemo = ...
        model->memos()->attach( $tqmemo )
    */
}
