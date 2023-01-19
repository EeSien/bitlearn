<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Question::orderBy('id', 'DESC')->paginate(5);
        return view('questions.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'selection1' => 'required',
            'answer' => 'required',
        ]);

        $selection = [];

        if ($request->selection1 !== null) {
            array_push($selection, trim($request->selection1));
        }
        if ($request->selection2 !== null) {
            array_push($selection, trim($request->selection2));
        }
        if ($request->selection3 !== null) {
            array_push($selection, trim($request->selection3));
        }
        if ($request->selection4 !== null) {
            array_push($selection, trim($request->selection4));
        }

        $question = new Question();
        $question->question = $request->question;
        $question->selection = json_encode($selection);
        $question->answer = trim($request->answer);
        $question->save();

        return redirect()->route('questions.index')
            ->with('success', 'Question created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        $question->selection = json_decode($question->selection);
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        $question->selection = json_decode($question->selection);
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'question' => 'required',
            'selection1' => 'required',
            'answer' => 'required',
        ]);

        $selection = [];

        if ($request->selection1 !== null) {
            array_push($selection, trim($request->selection1));
        }
        if ($request->selection2 !== null) {
            array_push($selection, trim($request->selection2));
        }
        if ($request->selection3 !== null) {
            array_push($selection, trim($request->selection3));
        }
        if ($request->selection4 !== null) {
            array_push($selection, trim($request->selection4));
        }
        $question = Question::find($id);
        $question->question = $request->question;
        $question->selection = json_encode($selection);
        $question->answer = trim($request->answer);
        $question->save();

        return redirect()->route('questions.index')
            ->with('success', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::find($id)->delete();
        return redirect()->route('questions.index')
            ->with('success', 'Question deleted successfully');
    }
}
