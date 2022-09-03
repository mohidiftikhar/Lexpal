<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionDataTable;
use App\Http\Requests\QuestionRequest;
use App\Repositories\questions\QuestionInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $questionRepository;
    public function __construct(QuestionInterface $questionRepository){
        $this->questionRepository = $questionRepository;
    }
    public function index(QuestionDataTable $dataTable){
        return $dataTable->render('question.index');
    }
    public function create(){
        return view('question.create');
    }
    public function store(QuestionRequest $request)
    {
        $store = $this->questionRepository->create($request->all());
        if ($store) {
            return redirect()->route('question.index')->with('success', 'Question added successfully');
        } else {
            return redirect()->route('question.create')->withErrors('Something went wrong');
        }
    }
        public function edit($id){
            $question = $this->questionRepository->findById($id);
            if ($question){
                return view('question.edit', compact('question'));
            }
            else{
                return redirect()->route('question.index')->withErrors('Something went wrong');
            }
        }
        public function update(QuestionRequest $request, $id)
        {
                $question = $this->questionRepository->update($id, $request->all());

                if($question){
                    return redirect()->route('question.index')->with('success', 'Question updated successfully');
                }
                else{
                    return redirect()->route('question.index')->withErrors('Something went wrong');
                }
        }
        public function destroy($id){
        $question = $this->questionRepository->delete($id);
            if($question){
                return redirect()->route('question.index')->with('success', 'Question deleted successfully');
            }
            else{
                return redirect()->route('question.index')->withErrors('Something went wrong');
            }
        }
}
