<?php

namespace App\Http\Controllers\Api;

use App\Models\Vote;
use App\Enums\VoteType;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVoteRequest;

class DownvoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreVoteRequest $request): JsonResponse
    {
        $data = $request->validated();

        $memberId = $data['member_id'];
        $ip = $data['ip'];

        $existingVote = Vote::where('member_id', $memberId)
            ->where('ip_address', $ip)
            ->first();

        if ($existingVote) {
            if ($existingVote->type === VoteType::Downvote) {
                return response()->json(['message' => 'You already downvoted this member.'], 409);
            }

            $existingVote->update([
                'type' => VoteType::Downvote
            ]);

            return response()->json(['message' => 'Vote changed to downvote.'], 200);
        }

        Vote::create([
            'member_id' => $memberId,
            'ip_address' => $ip,
            'type' => VoteType::Downvote
        ]);

        return response()->json(['message' => 'Downvote registered successfully.'], 201);
    }
}
