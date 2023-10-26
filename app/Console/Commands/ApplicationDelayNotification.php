<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\User;
use App\Notifications\ApplicationNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ApplicationDelayNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delay:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification when application is running out of 3 days';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $threeDaysAgo = Carbon::now()->subDay(3);
        $delayApplications = Application::with('customerDetail')->where([
            'application_status' => 0,
            'is_delay_notified'  => false,
            ['created_at', '<', $threeDaysAgo]
        ])->get();

        foreach ($delayApplications as $delayApplication) {
            #Notification to FA
            $notificationData = [
                "title" => "Application is pending!",
                "description" => "An application from " .$delayApplication->customerDetail->company_name." is pending! Please look into it. Thank you!",
                'route' => route('application.process', $delayApplication->id),
            ];
            $notifiableUsers = User::where("role_id", 3)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));


            #Notification to SO
            $notificationData = [
                "title" => "Application is pending!",
                "description" => "An application " .$delayApplication->customerDetail->company_name." is pending! Please look into it. Thank you!",
                'route' => route('application.process', $delayApplication->id),
            ];
            $notifiableUsers = User::where("role_id", 6)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));


            #Notification to DIRECTOR
            $notificationData = [
                "title" => "Application is pending!",
                "description" => "An application " .$delayApplication->customerDetail->company_name." is pending! Please look into it. Thank you!",
                'route' => route('application.process', $delayApplication->id),
            ];
            $notifiableUsers = User::where("role_id", 7)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));


            #Notification to MEMBER
            $notificationData = [
                "title" => "Application is pending!",
                "description" => "An application " .$delayApplication->customerDetail->company_name." is pending! Please look into it. Thank you!",
                'route' => route('application.process', $delayApplication->id),
            ];
            $notifiableUsers = User::where("role_id", 8)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));

            #update notification status
            $delayApplication->update(['is_delay_notified' => true]);
        }


        $this->info('Notification have sent successfully');
    }
}
