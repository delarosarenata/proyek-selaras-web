<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Respondent;
use Illuminate\Support\Str;

class PopulateRespondentTokens extends Command
{
    protected $signature = 'app:populate-respondent-tokens';
    protected $description = 'Generate unique tokens for existing respondents that do not have one.';

    public function handle()
    {
        $respondentsWithoutToken = Respondent::whereNull('unique_token')->get();

        if ($respondentsWithoutToken->isEmpty()) {
            $this->info('All respondents already have a unique token. No action needed.');
            return;
        }

        $this->info('Found ' . $respondentsWithoutToken->count() . ' respondents without a token. Populating now...');

        foreach ($respondentsWithoutToken as $respondent) {
            $respondent->unique_token = Str::uuid();
            $respondent->save();
        }

        $this->info('Successfully generated tokens for all existing respondents.');
        return;
    }
}