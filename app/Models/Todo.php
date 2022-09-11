<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todos';
    protected $primaryKey = 'id';
    use SoftDeletes;

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getTimeRemainingAttribute()
    {
        $timeRemaining = '';
        $now = strtotime("now");
        $dueDate = strtotime($this->due_date);
        if ($dueDate < $now) {
            $timeRemaining = 'Expired';
        } else {
            $timeRemaining = 'Expires in: '. $this->__secondsToTime($dueDate - $now);
        }
        return $timeRemaining;
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = date('Y-m-d h:i:s', strtotime($value));
    }

    private function __secondsToTime($seconds)
    {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }
}
