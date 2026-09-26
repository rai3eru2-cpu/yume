<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    /**
     * 規約に準拠：商品一覧の検索処理をModel内に定義（ローカルスコープ）
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $filters 入力された検索ワード
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, array $filters) {
        // 商品名の部分一致検索（入力がある場合のみ実行）
        if (isset($filters['search']) && $filters['search'] !== '') {
            $query->where('product_name', 'LIKE', '%' . $filters['search'] . '%');
        }

        // メーカー名の完全一致検索（セレクトボックスが選択されている場合のみ実行）
        if (isset($filters['company_id']) && $filters['company_id'] !== '') {
            $query->where('company_id', $filters['company_id']);
        }

        return $query;
    }
}