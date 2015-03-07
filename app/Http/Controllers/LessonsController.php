<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lesson;
use Input;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LessonsController extends Controller {


	public function __construct()
    {
        //$this->middleware('auth', ['only' => ['create', 'store','edit','destroy']]);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$lesson=Lesson::all();
		return response()->json(['data' => $this->transformCollection($lesson)],200);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$title = $request->input('title');
		$body = $request->input('body');
		$all = $request->input('all');

		if (!$title|| !$body) {
			return response()->json(['error' => "Parameters failed for validation"],422);
		}
		Lesson::Create(Input::all());
		return response()->json(['message' => "Lesson succesfully created"],201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$lesson=Lesson::find($id);
		if (!$lesson) {
			$message = array('message' =>'no lessons found',
							'code'=>202 );
		}
		else{
			$message= response()->json(['data' => $this->transform($lesson)],200);
		}
		return $message;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	private function transformCollection($lessons)
	{	
		return array_map([$this,'transform'], $lessons->toArray());
		
	}
	private function transform($lesson)
	{
			return
			[
				'title'	=>$lesson['title'],
				'body'	=>$lesson['body'],
				'active'=>(boolean)$lesson['some_bool']
			];
			 	
	}
}
