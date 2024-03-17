<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAksesibilitas extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'survey.tbl_survey_aksesibilitas';

    protected $guarded = [];

    // protected $fillable = array('*');

    public $timestamps = false;

    public function image()
    {
        return $this->hasMany(SurveyAksesibilitasImage::class, 'survey_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
