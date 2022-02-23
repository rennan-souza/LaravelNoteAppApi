<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class NoteController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:api');
    }

    public function register(NoteRequest $request)
    {

        $verifyExistNote = Note::where('user_id', Auth::user()->id)
            ->where('title', $request['title'])
            ->first();

        if ($verifyExistNote) {
            return response()->json(['errors' => 'Você já possuí uma nota com esse título.'], 422);
        }

        $note = new Note();
        $note->title = $request['title'];
        $note->content = $request['content'];
        $note->user_id = Auth::user()->id;
        $note->save();

        return response()->json($note, 201);
    }

    public function findById($id)
    {
        return Note::where('user_id', Auth::user()->id)->findOrFail($id);
    }

    public function findAll(Request $request)
    {
        if (!$request['search']) {
            return Note::where('user_id', Auth::user()->id)
                ->paginate(3);
        }

        return Note::where('user_id', Auth::user()->id)
            ->where('title', 'like', '%' . $request['search'] . '%')
            ->paginate(3);
    }

    public function update(NoteRequest $request, $id)
    {
        $note = Note::where('user_id', Auth::user()->id)->findOrFail($id);

        if ($note['title'] != $request['title']) {

            $verifyExistNote = Note::where('user_id', Auth::user()->id)
                ->where('title', $request['title'])
                ->first();

            if ($verifyExistNote) {
                return response()->json(['errors' => 'Você já possuí uma nota com esse título.'], 422);
            }

        }

        $note->title = $request['title'];
        $note->content = $request['content'];
        $note->user_id = Auth::user()->id;
        $note->save();

        return response()->json('', 204);
    }

    public function delete($id)
    {
        Note::where('user_id', Auth::user()->id)->findOrFail($id)->delete();
    }
}
