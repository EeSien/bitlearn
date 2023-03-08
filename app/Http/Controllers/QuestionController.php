<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $languages = ['cn' => 'Chinese', 'en' => 'English'];

    public function index(Request $request)
    {
        $datas = Question::orderBy('id', 'ASC')->paginate(5);
        return view('questions.index')
            ->with([
                'datas' => $datas,
                'i' => ($request->input('page', 1) - 1) * 5,
                'languages' => $this->languages
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create')->with([
            'languages' => $this->languages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_array = [];
        $validate_message = [];

        foreach ($this->languages as $key => $language) {
            $validate_array['question_' . $key] = 'required';
            $validate_array['selection1_' . $key] = 'required';
            $validate_array['selection2_' . $key] = 'required';
            $validate_array['answer_' . $key] = 'required';
            $validate_message['question_' . $key . '.required'] = 'The question for ' . $language . ' is required';
            $validate_message['selection1_' . $key . '.required'] = 'The selection 1 for ' . $language . ' is required';
            $validate_message['selection2_' . $key . '.required'] = 'The selection 2 for ' . $language . ' is required';
            $validate_message['answer_' . $key . '.required'] = 'The answer for ' . $language . ' is required';
        }

        $this->validate($request, $validate_array, $validate_message);

        if ((strlen(trim($request->{'selection3_cn'})) > 0 && strlen(trim($request->{'selection3_en'})) == 0) ||
            (strlen(trim($request->{'selection3_en'})) > 0 && strlen(trim($request->{'selection3_cn'})) == 0)) {
            return Redirect::back()->withErrors(['msg' => 'Selection 3 must have all input of languages'])->withInput();
        }
        if ((strlen(trim($request->{'selection4_cn'})) > 0 && strlen(trim($request->{'selection4_en'})) == 0) ||
            (strlen(trim($request->{'selection4_en'})) > 0 && strlen(trim($request->{'selection4_cn'})) == 0)) {
            return Redirect::back()->withErrors(['msg' => 'Selection 4 must have all input of languages'])->withInput();
        }

        $questions = $selections = $answers = [];

        foreach ($this->languages as $key => $language) {
            $questions[$key] = trim($request->{'question_' . $key});
            $selections['selection1_' . $key] = trim($request->{'selection1_' . $key});
            $selections['selection2_' . $key] = trim($request->{'selection2_' . $key});
            if (trim($request->{'selection3_' . $key}) != null) {
                $selections['selection3_' . $key] = trim($request->{'selection3_' . $key});
            }
            if (trim($request->{'selection4_' . $key}) != null) {
                $selections['selection4_' . $key] = trim($request->{'selection4_' . $key});
            }
            $answers[$key] = trim($request->{'answer_' . $key});
        }

        $new_question = new Question();
        $new_question->question = json_encode($questions);
        $new_question->selection = json_encode($selections);
        $new_question->answer = json_encode($answers);
        $new_question->save();

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
        $question->question = json_decode($question->question);
        $question->selection = json_decode($question->selection);
        $question->answer = json_decode($question->answer);
        return view('questions.show')->with([
            'question' => $question,
            'language' => $this->languages
        ]);
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
        $question->question = json_decode($question->question);
        $question->selection = json_decode($question->selection);
        $question->answer = json_decode($question->answer);
        return view('questions.edit')->with([
            'question' => $question,
            'languages' => $this->languages
        ]);;
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
        $validate_array = [];
        $validate_message = [];
        foreach ($this->languages as $key => $language) {
            $validate_array['question_' . $key] = 'required';
            $validate_array['selection1_' . $key] = 'required';
            $validate_array['selection2_' . $key] = 'required';
            $validate_array['answer_' . $key] = 'required';
            $validate_message['question_' . $key . '.required'] = 'The question for ' . $language . ' is required';
            $validate_message['selection1_' . $key . '.required'] = 'The selection 1 for ' . $language . ' is required';
            $validate_message['selection2_' . $key . '.required'] = 'The selection 2 for ' . $language . ' is required';
            $validate_message['answer_' . $key . '.required'] = 'The answer for ' . $language . ' is required';
        }

        $this->validate($request, $validate_array, $validate_message);

        if ((strlen(trim($request->{'selection3_cn'})) > 0 && strlen(trim($request->{'selection3_en'})) == 0) ||
            (strlen(trim($request->{'selection3_en'})) > 0 && strlen(trim($request->{'selection3_cn'})) == 0)) {
            return Redirect::back()->withErrors(['msg' => 'Selection 3 must have all input of languages'])->withInput();
        }
        if ((strlen(trim($request->{'selection4_cn'})) > 0 && strlen(trim($request->{'selection4_en'})) == 0) ||
            (strlen(trim($request->{'selection4_en'})) > 0 && strlen(trim($request->{'selection4_cn'})) == 0)) {
            return Redirect::back()->withErrors(['msg' => 'Selection 4 must have all input of languages'])->withInput();
        }

        $questions = $selections = $answers = [];

        foreach ($this->languages as $key => $language) {
            $questions[$key] = trim($request->{'question_' . $key});
            $selections['selection1_' . $key] = trim($request->{'selection1_' . $key});
            $selections['selection2_' . $key] = trim($request->{'selection2_' . $key});
            if (trim($request->{'selection3_' . $key}) != null) {
                $selections['selection3_' . $key] = trim($request->{'selection3_' . $key});
            }
            if (trim($request->{'selection4_' . $key}) != null) {
                $selections['selection4_' . $key] = trim($request->{'selection4_' . $key});
            }
            $answers[$key] = trim($request->{'answer_' . $key});
        }

        $question = Question::find($id);
        $question->question = json_encode($questions);
        $question->selection = json_encode($selections);
        $question->answer = json_encode($answers);
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
