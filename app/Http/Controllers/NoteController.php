<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function getNotes() {
        $noteTable = new Note();
        $user = Auth::user();
        error_log($user);
        $notes = $noteTable->where("userId", "=", $user->id)->get();
        return view("notes", ["name" => $user->name, "notes" => $notes]);
    }

    public function storeNote() {
        $noteTable = new Note();
        $user = Auth::user();
        $noteTable->insert([
            "userId" => $user->id,
            "title" => request("title"),
            "noteDesc" => request("noteDesc")
        ]);
        return redirect("/notes");
    }


    public function deleteNote() {
        $noteTable = new Note();
        $note = $noteTable->where("noteId", "=", request("id"))->delete();
        return redirect("/notes");
    }

    public function updateNote() {
        $noteTable = new Note();
        $noteTable->where("noteId", "=", request("id"))
                    ->update([
                        "title" => request("title"),
                        "noteDesc" => request("note")
                    ]);
        return redirect("/notes");
    }
}
