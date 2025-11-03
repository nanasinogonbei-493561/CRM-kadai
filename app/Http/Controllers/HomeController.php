<?php

namespace App\Http\Controllers;

use function Laravel\Prompts\search;

class HomeController extends Controller 
{
    public function index(Request $request)
    {// Request　を　＄requestに代入する
         /* テーブルから全てのレコードを取得する */
        
         /* キーワードから検索処理 */
         // 任意の変数に受け取った送信された情報を代入します
         // htmlのinputタグにはname属性に対して'keyword'と設定されているため
         // $keywordへ$requestの中から、nameが'keyword'のinputを代入します
         
            $keyword = $request->input('keyword');
         if(!empty($keyword)) { //もしも、$keywordの中身が空ではない場合に検索処理実行
             $companies->where('company_name', 'LIKE', "%{$keyword}%")
             ->orwhereHas('company', function ($query) use ($keyword) {
                 $query->where('company_name', 'LIKE', "%{$keyword}%");
             })->get();
        
         }

        /* ページネーション */
        // レコードが例えば100件あった場合、一気に表示するとスクロールが面倒なので
        // 分割して表示することをページネーションと呼びます
    
        // 以下は5件ずつ表示する設定を組んでいます
        // $postsは任意の変数名ですが、利用する場合はhtml側と同じ変数名にする必要があります。
        $posts = $companies->paginate(5);

        // index.braid.phpを開き直し、view（HTML）で利用する変数postsに対して
        // コントローラーで作成した$postsを渡します
        return view('company.index', ['posts' => $posts]);

        dd($posts);

            $keyword = $request->input('keyword');
         if(!empty($keyword)) { //もしも、$keywordの中身が空ではない場合に検索処理実行
             $contacts->where('contact_name', 'LIKE', "%{$keyword}%")
             ->orwhereHas('contact', function ($query) use ($keyword) {
                 $query->where('contact_name', 'LIKE', "%{$keyword}%");
             })->get();
        
         }

        $posts = $contact->paginate(5);
        return view('contact.index', ['posts' => $posts]);

        //dd($posts);
    }
}
