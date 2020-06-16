<?php

namespace App\Http\Controllers;
use App\Jobs\ProcessQrCode;
use Illuminate\Http\Request;
use QrCode;
use SimpleSoftwareIO\QrCode\Generator;

class QrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // test 1500 url at a time


                // $content =range(0,1500);
                // foreach ($content as $value){
                //     $name="new{$value}"; 
                //     $url= "value{$value}";
                //     $color='0, 0, 0';
                //     $backgroundcolor='255, 255, 255';
                //     ProcessQrCode::dispatch($name, $url,$color,$backgroundcolor);
                // }
  

    $name='new 222'; 
    $url= 'https://bitly.com/pages/why-bitly/bitly-101';
    $color='0, 0, 0';
    $backgroundcolor='255, 255, 255';

    
    ProcessQrCode::dispatch($name, $url,$color,$backgroundcolor);
        return view('welcome');
    
    }

  
}