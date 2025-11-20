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

    public function show(int $id): JsonResponse
    {
        $member = Member::with('votes')->find($id);

        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        return response()->json($member);
    }
}
