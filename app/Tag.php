<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    public const DEFAULTS = [
        'インターネット・コンピュータ',
        'エンターテイメント',
        '生活・文化',
        '社会・経済',
        '健康と医療',
        'ペット',
        'グルメ',
        '住まい',
        '花・ガーデニング',
        '育児',
        '旅行・観光',
        '写真',
        '手芸・ハンドクラフト',
        'スポーツ',
        'アウトドア',
        '美容・ビューティー',
        'ファッション',
        '恋愛・結婚',
        '趣味・ホビー',
        'ゲーム',
        '乗り物',
        '芸術・人文',
        '学問・雑談',
        '日記・雑談',
        'ニュース',
        '地域情報'
    ];

    protected $guarded = [];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class);
    }
}
