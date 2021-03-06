<?php

namespace App\Http\Controllers;
use App\Jobs\ProcessQrCode;
use Illuminate\Http\Request;
// use QrCode;
use SimpleSoftwareIO\QrCode\Generator;
use App\Qrcode;
use App\Items;
use Carbon\Carbon; 
use Log;
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
                //     $color='#000000';
                //     $backgroundcolor='#ffffff';
                //     ProcessQrCode::dispatch($name, $url,$color,$backgroundcolor);
                // }
  

    $name='new 222'; 
    $url= 'https://bitly.com/pages/why-bitly/bitly-101';
    $color='#000000';
    $backgroundcolor='#ffffff';

    
    ProcessQrCode::dispatch($name, $url,$color,$backgroundcolor);
        return view('component.Qrcode');
    
    }


    public function chart($slug){
        $today = Carbon::now(); 
        switch ($slug) {
            case 'day':
                $result = Qrcode::whereDate('created_at', Carbon::today())->get();
                break;
            case 'week':
                $result = Qrcode::whereDate('created_at','>', Carbon::now()->subDays(7))->get();
                break;
            case 'month':
                $dateToday=Carbon::now()->format('dd');
                $result = Qrcode::whereDate('created_at','>', Carbon::now()->subDays($dateToday))->get();
                break;
            case 'year':
                $result = Qrcode::whereDate('created_at','>', Carbon::now()->startOfYear())->get();
                break;
            case 'hour':
                Log::info( Carbon::now()->subHour());
                $result = Qrcode::where('created_at','>=', Carbon::now()->subHour())->get();
                break;
            default:
        }
        return response()->json($result);
        return view('welcome', [
            'data' => json($result)
        ]);
  
    }

    public function comparison($firstdate,$seconddate){
        Log::info($firstdate);
        Log::info($seconddate);
        $today = Carbon::now();
        $firstResult = Qrcode::whereDate('created_at','>', $firstdate)->get();
        $secondResult = Qrcode::where('created_at', '<=', $firstdate)->where('created_at', '>=', $seconddate)->get();
    //    $secondResult = Qrcode::whereBetween('created_at', [$today , $firstdate])->get();
        $result=['first'=>$firstResult,
        'second'=>$secondResult];
        return response()->json($result);
        // return view('component.Trend', [
        //     'data' => json($result)
        // ]);
  
    }

    public function items(){
        $result = Items::all();
        return response()->json($result);


    }
}