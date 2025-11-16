<?php

namespace App\Console\Commands;

use App\Models\Member;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'members:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch members from Congress API and store locally';


    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Fetching members from API...');

        $response = Http::get('https://api.congress.gov/v3/member', [
            'api_key' => config('services.congress.api_key'),
            'format'  => 'json',
            'limit'  => 50,
            // 'limit'   => 250
        ]);

        if (!$response->successful()) {
            $this->error('Failed to fetch data');
            return 1;
        }

        $members = $response->json('members', []);

        foreach ($members as $member) {
            Member::updateOrCreate(
                ['external_id' => $member['bioguideId']],
                [
                    'name' => $member['name'],
                    'party' => $member['partyName'] ?? null,
                    'state' => $member['state'] ?? null,
                    'district' => $member['district'] ?? null,
                    'image_url' => $member['depiction']['imageUrl'] ?? null,
                    'image_attribution' => $member['depiction']['attribution'] ?? null,
                    'terms' => $member['terms']['item'] ?? null,
                    'source_url' => $member['url'] ?? null,
                    // 'external_updated_at' => $member['updateDate'] ?? null,
                ]
            );
        }

        $this->info('Members synced successfully!');

        return 0;
    }
}
