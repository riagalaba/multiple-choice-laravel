<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    public function getChoicesByQuestionId($questionId) 
    {
        $choices = \DB::table('choices')
                    ->where('question_id', '=', $questionId)
                    ->inRandomOrder()
                    ->get();
        return $choices;
    }
}
