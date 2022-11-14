<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{

    /**
     * Получить список записей и последние 3 комментария к каждой записи
     * 
     * @return \Illuminate\Http\Response
     */

    public function show() {  
        $records = Record::get();
        $records->each(function($record, $key) {
            $record['comments'] = $record->comments()
                ->orderBy('updated_at', 'desc')
                ->limit(3)
                ->get();               
        });
        return response()->json($records, 200);
    }

    /**
     * Получить запись
     * 
     * @return \Illuminate\Http\Response
     */

    public function showById($id) {
        return response()->json(Record::find($id), 200);
    }

    /**
     * Сохранить новую запись в блоге.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'author' => 'required|max:50',
            'message' => 'required|max:5000',
        ]);
        if ($validator->fails()) {
            $responseArr['error'] = $validator->errors();
            return response()->json($responseArr, 400);
        } else {
            $record = Record::create($validator->validated());
            return response()->json(['id' => $record->id], 201);
        }
    }
}


