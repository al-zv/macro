<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Сохранить новый комментарий с ограничением:
     * не больше одного комментария в минуту от одного имени
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {

        if ($this->checkMinute($request)) {
            return response()->
                json(['error' => 'Не больше одного комментария в минуту от одного имени'], 425);
        } else {
            $validator = Validator::make($request->all(), [
                'author' => 'required|max:50',
                'message' => 'required|max:200',
                'record_id' => 'required',
            ]);
    
            if ($validator->fails()) {
                $responseArr['error'] = $validator->errors();
                return response()->json($responseArr, 400);
            } else {
                $comment = Comment::create($validator->validated());
                return response()->json(['id' => $comment->id], 201);
            }
        }
    }

    /**
     * Получить все комментарии к записи.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getComments(Request $request) {
        $validator = Validator::make($request->all(), [
            'record_id' => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['error'] = $validator->errors();
            return response()->json($responseArr, 400);
        } else {
            $comments = Comment::where('record_id', '=', $validator->validated('record_id'))
                ->select('id', 'message')
                ->latest()
                ->get();
            return response()->json($comments, 201);
        }
    }

    /**
     * Проверка, чтобы было не больше одного комментария в минуту от одного имени.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function checkMinute(Request $request) {
        $current = Carbon::now();
        $minute_minus = $current->subMinutes(1);
        $comments_minute = Comment::where('updated_at', '>', $minute_minus)
            ->where('author', '=', $request->author)
            ->select('updated_at', 'author')
            ->get();
        $result = 'Не определена';
        $result = $comments_minute->isNotEmpty() ? 1 : 0;
        return $result;
    }
}
