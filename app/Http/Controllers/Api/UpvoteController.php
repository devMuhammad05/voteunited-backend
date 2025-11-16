<?php

namespace App\Http\Controllers\Api;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class UpvoteController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'ip' => 'required|ip',
        ]);

        $memberId = $data['member_id'];
        $ip = $data['ip'];

        $existingVote = Vote::where('member_id', $memberId)
            ->where('ip_address', $ip)
            ->first();

        if ($existingVote) {
            return response()->json(['message' => 'You have already voted for this member.'], 409);
        }

        Vote::create([
            'member_id' => $memberId,
            'ip_address' => $ip,
        ]);


        return response()->json(['message' => 'Vote registered successfully.']);
    }
}
