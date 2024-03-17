<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAksesibilitasImage extends Model
{
    use HasFactory;
    protected $connection = 'pgsql';

    protected $table = 'survey.tbl_photo_survey_aksesibilitas';

    protected $guarded = ['id'];

    public $timestamps = false;
}
