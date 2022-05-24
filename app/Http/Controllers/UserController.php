<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterPost;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * 表示用
     */
     public function index()
     {
         return view('user.register');
     }
    
    
    /**
     * 会員の新規登録
     */
     public function register(UserRegisterPost $request)
     {
         //validate済みのデータの取得
         $datum=$request->validated();
         
         //パスワードをハッシュ化
         $datum['password']=Hash::make($datum['password']);
//var_dump($datum); exit;

         // user_id の追加
         $datum['user_id'] = Auth::id();

         //テーブルへのINSERT
         try{
           $r=UserModel::Create($datum);
         }catch(\Throwable $e){
           //XXX本当はログに書く等の処理をする。今回は一端「出力する」だけ
           echo $e->getMessage();
           exit;
         }
         
         //ユーザー登録成功
         $request->session()->flash('user_register_success',true);
         
         //
         return redirect('/');
     }
}