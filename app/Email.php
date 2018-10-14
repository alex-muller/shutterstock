<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Email
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $file_id
 * @property string $email
 * @property int $status
 * @property string $status_message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereStatusMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUpdatedAt($value)
 */
class Email extends Model
{
    //
}
