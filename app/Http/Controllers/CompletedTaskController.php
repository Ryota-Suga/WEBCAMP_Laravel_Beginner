<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompletedTask as CompletedTaskModel;
use Illuminate\Support\Facades\Auth;

class CompletedTaskController extends Controller
{
    /**
     * タスク一覧ページを表示する
     * 
     * @return \Illuminate\View\View
     */
     public function list()
     {
        //1Page辺りの表示アイテム数を設定
        $per_page=15;
        
        //一覧の取得
        $list=$this->getListBuilder()
                   ->paginate($per_page);
                 //->get();
      /*$sql=$this->getListBuilder()
                  ->toSql();
      //echo "<pre>\n"; var_dump($sql,$list);exit;
      var_dump($sql);
      */
      
        //
        return view('task.completed_list',['list'=>$list]);
     }
    /**
     * 一覧用のIlluminate\Database\Eloquest\Builder インスタンスの取得
     */
     protected function getListBuilder()
     {
        return CompletedTaskModel::where('user_id',Auth::id())
                                 ->orderBy('priority','DESC')
                                 ->orderBy('period')
                                 ->orderBy('created_at');
     }
}