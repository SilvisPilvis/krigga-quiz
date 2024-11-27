<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    function create(Request $request)
    {
        $question = new Question();
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string|min:1',
            'game_id' => 'required|exists:games,id',
        ]);
        $question->fill($validated);
        if ($question->save()) {
            return response()->json(['message' => 'Question created successfully'], 201);
        } else {
            return response()->json(['message' => 'Error creating question'], 500);
        }
    }
}
