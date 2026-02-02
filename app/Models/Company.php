<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'address',
        'postal_code',
        'city',
        'industry',
        'description',
        'notes',
    ];

    public function search(Request $request)
    {
        // 入力からの会社名を取得
        $name = $request->input('name');

        // クエリビルダのインスタンスを作成
        $query = Company::query();

        try {
            // 名前フィルタがあれば、クエリに追加
            if ($name) {
                $query->where('name', 'LIKE', "%$name%");
            }

            // クエリを実行して結果を取得
            $companies = $query->get();

            // 結果が存在しない場合
            if ($companies->isEmpty()) {
                return response()->json(['message' => '該当する顧客が見つかりませんでした。'], 404);
            }

            // 結果をJSON形式で返す
            return response()->json($companies);

        } catch (\Exception $e) {
            // 例外が発生した場合の処理
            return response()->json(['error' => 'エラーが発生しました: ' . $e->getMessage()], 500);
        }
    }
}
