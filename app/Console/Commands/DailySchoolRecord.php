<?php

namespace App\Console\Commands;

use App\Models\School;
use App\Models\User;
use App\Notifications\DailySchoolReportNotification;
use Illuminate\Console\Command;

class DailySchoolRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:school';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This commande sent daily email to all system users if new school record exist';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schools=School::whereDate('created_at',today()->subDay());;
        if ($schools->exists()){
           $all_schools = $schools->get();
            foreach (User::all() as $user){
                $user->notify(new DailySchoolReportNotification($all_schools));
            }
        }
        return 0;
    }
}
