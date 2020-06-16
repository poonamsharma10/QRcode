<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use QrCode;
use SimpleSoftwareIO\QrCode\Generator;

class ProcessQrCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $name; 
    protected $imgUrl; 
    protected $url;
    protected $color;
    protected $backgroundcolor;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name ,$url,$color,$backgroundcolor)
    {
        $this->name=$name;
        $this->imgUrl="./storage/app/public/qrcodes/{$name}.svg";
        $this->url=$url;
        $this->color=$color;
        $this->backgroundcolor=$backgroundcolor;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        QrCode::color(0,0,0)->backgroundColor(255, 255, 255)->format('svg')->generate($this->url,$this->imgUrl);
    }
}
