<?php

namespace App\Console\Commands;

use App\Models\Books;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteAfter extends Command
{
    
    protected $signature = 'app:delete-after';

    protected $description = 'Permanently Delete SoftDeleted Books after 30 days';

    public function handle()
    {
        $deleteDate=Carbon::now()->subRealMinutes(5);

        Books::where('deleted_at','<',$deleteDate)->forceDelete();

        $this->Info('Outdated Books deleted successfully.');
    }
}
