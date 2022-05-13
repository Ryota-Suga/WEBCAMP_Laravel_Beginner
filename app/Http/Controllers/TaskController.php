<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRegisterRequest;
use App\Models\Task as TaskModel;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * タスク一覧ページを表示する
     * 
     * @return \Illuminate\View\View
     */
     public function list()
     {
         return view('task.list');
     }
     
    /**
     * タスクの新規登録
     */
     public function register(TaskRegisterRequest $request)
     {
         //validate済みのデータの取得
         $datum=$request->validated();
         //
         //$user=Auth::user();
         //$id=Auth::id();
         //var_dump($datum,$user,$id); exit;
         
         //user_idの追加
         $datum['user_id']=Auth::id();
         
         //テーブルへのINSERT
         try{
           $r=TaskModel::Create($datum);
         }catch(\Throwable $e){
           //XXX本当はログに書く等の処理をする。今回は一端「出力する」だけ
           echo $e->getMessage();
           exit;
         }
         
         //タスク登録成功
         $request->session()->flash('front.task_register_success',true);
         
         //
         return redirect('/task/list');
     }
}