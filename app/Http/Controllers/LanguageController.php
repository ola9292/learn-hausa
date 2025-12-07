<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LanguageController extends Controller
{
    public function home()
    {
        return Inertia::render('Landing');
    }
    public function start()
    {
        return Inertia::render('Index');
    }
    public function prompt(Request $request)
    {
        $prompt = $request->get('prompt');

        $exists = Lesson::where('user_id', auth()->user()->id)
                            ->where('prompt', $prompt)
                            ->first();

        if($exists){
            return response()->json([
                'lesson' => null,
                'prompt' => $prompt,
                'exists' => true
            ]);
        };

        $sys_prompt = '
        You are a helpful Hausa tutor. 
        The user will ask for something. No matter what they ask, ALWAYS return a JSON response 
        in this EXACT structure:
        
        {
          "title": "",
          "vocabulary": [
            {
              "phrase": "",
              "translation": ""
            }
          ],
          "examples": [
            {
              "hausa": "",
              "english": ""
            }
          ],
          "explanation": ""
        }
        
        Never include anything outside the JSON. Never write text before or after it.
        If the user request cannot be fulfilled, return a JSON with empty arrays.';
        
        //$prompt = "Teach me 5 basic Hausa greetings with English translations.";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini', // or gpt-4o, gpt-4.1, etc.
            'messages' => [
                ['role' => 'system', 'content' => $sys_prompt],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);
      
       
        // Get the text response from GPT
        $answer = $response->json()['choices'][0]['message']['content'];

        Lesson::create([
            'user_id' => auth()->user()->id,
            'prompt' => $prompt,
            'reply' => $answer
        ]);

        return response()->json([
            'lesson' => $answer,
            'prompt' => $prompt,
            'exists' => false
        ]);

    }
    public function past_lessons()
    {

        $past_lessons = Lesson::where('user_id', auth()->user()->id)->get();

        return Inertia::render('PastLessons', [
            'past_lessons' => $past_lessons
        ]);
    }
    public function past_lesson($id)
    {

        $lesson = Lesson::where('id',$id)->first();

        return Inertia::render('PastLesson', [
            'lesson' => $lesson
        ]);
    }
}
