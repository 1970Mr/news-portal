<?php

namespace Modules\ContactUs\App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Modules\Seen\App\Traits\HasSeen;

class UserMessage extends Model
{
    use HasSeen;
    use Searchable;

    public const SEEN = 'seen';

    public const UNSEEN = 'unseen';

    public const USER_MESSAGE_STATUS = [
        self::SEEN,
        self::UNSEEN,
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ];
    }
}
