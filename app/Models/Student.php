<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model{

    use SoftDeletes;
    use HasFactory;

    protected $fillable =['name','email','phone','course','profile_img'];

    public function classRoom(){
        return $this->belongsTo(ClassRoom::class);
    }

    public function Courses(){
        return $this->hasMany(Course::class);
    }
}
?>
