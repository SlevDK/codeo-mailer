<?php

namespace App\Models\Database;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topic extends Model
{
    /** @var string Model's table */
    protected $table = 'database_topics';

    /** @var array Guarded props */
    protected $guarded = ['id'];

    /** @var array Props that can be mass assigment */
    protected $fillable = [
        'user_id', 'name', 'data'
    ];

    /** @var array Model dates */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Topic owner
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * OwnedBy {user_id} scope
     *
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeOwnBy($query, $id)
    {
        return $query->where('user_id', $id);
    }

    /**
     * Create new topic
     *
     * @param array $modelData
     * @return Topic
     */
    public static function initTopic(array $modelData)
    {
        $modelData['user_id']   = auth('api')->id();
        $modelData['data']      = '[]';

        $model = self::create($modelData);

        return $model;
    }
}
