<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $results = auth()->user()->results;

        return response()->json([
            'success' => true,
            'data' => $results,
        ]);
    }

    public function show($id)
    {
        $result = auth()->user()->results()->find($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Result not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $result->toArray()
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'game_id' => 'required',
            'score' => 'required'
        ]);

        $result = new Result();
        $result->game_id = $request->game_id;
        $result->score = $request->score;
        $result->grade = $request->grade;
        $result->user_id = Auth::user()->id;

        if (auth()->user()->results()->save($result))
            return response()->json([
                'success' => true,
                'data' => $result->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Result not added'
            ], 500);
    }

    /*public function update(Request $request, $id)
    {
        $result = auth()->user()->results()->find($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Result not found'
            ], 400);
        }

        $updated = $result->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Result can not be updated'
            ], 500);
    }
*/
    public function destroy($id)
    {
        $result = auth()->user()->results()->find($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Result not found'
            ], 400);
        }

        if ($result->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Result can not be deleted'
            ], 500);
        }
    }
}
