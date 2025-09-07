<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TargetGroupController extends Controller
{
    public function active(Request $request)
    {
        $request->validate([
            'target_group_id' => ['required', Rule::exists('target_groups', 'id')],
        ]);

        $request->session()->put('active_target_group', $request->input('target_group_id'));

        return redirect()->back();
    }

    public function deleteActive(Request $request)
    {
        $request->session()->forget('active_target_group');

        return redirect()->back();
    }
}
