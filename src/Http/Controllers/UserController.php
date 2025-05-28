<?php

namespace Taq\Tqadmtpl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Taq\Tqhelper\Models\TqPointLog;

//todo test
//use Taq\Tqhelper\Classes\TqPointClass;

class UserController extends Controller
{
    public function index (Request $request){
        $data = User::
        select('*')
        ->withCount(['memos'])
        //->where('userid','<>','zunme')
        ;
        if( $request->search_type && $request->search_str ) $data->where( $request->search_type ,'like','%'.$request->search_str.'%' );
        $data->orderBy('id','desc');
        return $data->paginate( 1 );
    }
    public function show (Request $request, $id){
        try{
            return User::
                select('*')
                ->with(['memos.writeuser'=>function ($q){ $q->select('id','email','name');}])
                ->find($id);
        }catch( ModelNotFoundException $e){
            abort(400, '유저정보를 찾을 수 없습니다.');
        }catch( Exception $e){
            abort( 422, $e->getMEssage());
        }
    }
    public function updateInfo(Request $request, $id){
        $req = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'tel' => ['required', 'numeric'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
            'personality' => 'required|in:P,C',
		],[
        ],[
			'userid'=>'아이디','password'=>'비밀번호','tel'=>'전화번호','name'=>'이름'
		]);   
        try{
            $user = User::findOrFail($id);
            $user->update( $req);
        } catch( ModelNotFoundException $e){
            throw new Exception('회원정보를 찾을 수 없습니다.');
        } catch( Exception $e){
            throw new Exception('저장 중 오류가 발생하였습니다');
        }
        return $user;
    }
    public function updatePassword(Request $request, $id){
        $req = $request->validate([
            'password' => ['required', 'string', 'max:30'],
		],[
        ],[
			'password'=>'비밀번호'
		]);        

        try{
            $user = User::findOrFail($id);
            $user->password = \Hash::make( $request->password);
            $user->save();
        } catch( ModelNotFoundException $e){
            throw new Exception('회원정보를 찾을 수 없습니다.');
        } catch( Exception $e){
            throw new Exception('저장 중 오류가 발생하였습니다');
        }
        return $user;
    }
    public function updatePoint(Request $request, $id){
        $admin = \Auth::guard('admin')->user();

        $req = $request->validate([
            'memo' => ['required', 'string'],
            'addpoint'=>['required', 'integer'],
		],[
        ],[
			'memo'=>'사유',
            'addpoint'=>'추가(삭제)할 포인트',
		]);   
        $data =[];
        if( $request->addpoint < 0 ) $point_type="deletelog";
        else if ( $request->addpoint > 0 ) $point_type="given";
        else abort(422, '올바른 포인트를 적어주세요');
        $point_type_label = $point_type=="given" ? '추가' : '차감';

        $user = User::findOrFail($id);
        $point_abs = abs($request->addpoint);
        $memo = '[포인트 '.$point_type_label.'] '. $request->addpoint.'P'.PHP_EOL.
        '[ADMIN ID : '.$admin->userid.']'.PHP_EOL.
        '[기존포인트 : '.$user->point.']'.PHP_EOL.
        '[사유]'. $request->memo;

        abort_if($user->point + $request->addpoint < 0 , 422, '회원이 가진 포인트('.number_format($user->point) .') 이상 차감은 불가능합니다.');

        \DB::beginTransaction();
        $before_point = $user->point ?? "0";
        try{
            if( $request->addpoint > 0 ) $user->increment( 'point', $point_abs);
            else $user->decrement( 'point', $point_abs);
            $user->pointlog()->create([
                'log_type'=>$point_type ,
                'point_type'=>'admin',
                'sender_id'=>$admin->id,
                'point'=>$request->addpoint,
                'desc'=>$request->memo,
                'etc'=>[
                    'beofre_point'=>$before_point,
                    'after_point'=>$user->point,
                ]
            ]);
            $user->memos()->create([
                'write_user_id'=>\Auth::user()->id,
                'memo'=> $memo,
            ]);
            \DB::commit();
        }catch( Exception $e){
            \DB::rollBack();
            throw new Exception($e);
            throw new Exception('포인트 처리중 오류가 발생하였습니다. 관리자에게 문의해주세요');
        }
        return User::with('memos')->findOrFail($id);
    }
    public function saveMemo(Request $request, $id){
        $req = $request->validate([
            'memo' => ['required', 'string'],
		],[
        ],[
			'memo'=>'메모내용'
		]);  

        $authuser = \Auth::guard('admin')->user();
        try{
            $user = User::find($id);
            $user->memos()->create([
                'write_user_id'=>$authuser->id,
                'type'=>'memo',
                'memo'=>$request->memo,
            ]);
        }catch( ModelNotFoundException $e){
            abort(400, '유저정보를 찾을 수 없습니다.');
        }catch( Exception $e){
            abort( 422, $e->getMEssage());
        }
        $user = User::with(['memos.writeuser'=>function ($q){ $q->select('id','email','name');}])->find($id);
        return $user->memos;
    }
}