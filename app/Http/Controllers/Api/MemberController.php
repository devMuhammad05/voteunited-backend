<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index(): JsonResponse
    {
        $members = Member::withCount('votes')->get();

        return response()->json([
            'members' => $members
        ]);
    }
}
