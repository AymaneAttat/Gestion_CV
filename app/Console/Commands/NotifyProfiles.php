<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MailProfile;
use App\Jobs\SendMailJob;
use App\Models\Profile;
use App\Mail\NewEmail;
use Carbon\Carbon;

class NotifyProfiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:profiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to profiles';

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
        //One hour is added to compensate for PHP being one hour faster 
        $now = date("Y-m-d H:i", strtotime(Carbon::now()->addHour()));
        logger($now);

        $emails = MailProfile::get();
        if($emails !== null){
            //Get all messages that their dispatch date is due
            $emails->where('date_string',  $now)->each(function($email) {
                if($email->delivered == 'NO')
                {
                    //$profiles = Profile::all();
                    $ids = explode(",", $email->profile_ids);
                    $profiles = Profile::whereIn('id', $ids)->get();
                    foreach($profiles as $profile) {
                        dispatch(new SendMailJob($profile->email, new NewEmail($profile, $email)));
                    }
                    $email->delivered = 'YES';
                    $email->save();
                    return "Email send successfuly";
                }
            });
        }
    }
}
