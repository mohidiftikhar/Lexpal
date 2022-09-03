<?php

namespace App\Console\Commands;

use App\Jobs\SendLicenseChangeEmail;
use App\Repositories\license\LicenseInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Log;

class LicenseCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    use DispatchesJobs;

    protected $signature = 'cron:License';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $licenseRepository;
    public function __construct(LicenseInterface $licenseRepository)
    {
        parent::__construct();
        $this->licenseRepository = $licenseRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $licenses = $this->licenseRepository->findByFields(['status'=>'active',['expiry_date','<', Carbon::now()->format('Y-m-d')]]);
        if($licenses){
            foreach ($licenses as $license){
                $this->licenseRepository->update($license->id, ['status'=> 'inactive']);
            }
        }
    }
}
