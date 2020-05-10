<?php

namespace App\Http\Controllers;

use App\User;
use App\Charts\MyChart;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Stichoza\GoogleTranslate\GoogleTranslate;


class PaquetesController extends Controller
{
    public function charts(){
        
        
        $chart = new MyChart();

       

        return view("paquetes.chart",["chart" => $chart->my_chart() ]);
        
        
        return  "chart";
    }


    public function image(){

        // create empty canvas with background color
            $img = Image::canvas(100, 100, '#ddd');

            // draw an empty rectangle border
            $img->rectangle(10, 10, 190, 190);

            // draw filled red rectangle
            $img->rectangle(5, 5, 195, 195, function ($draw) {
                $draw->background('#ff0000');
            });

            // draw transparent rectangle with 2px border
            $img->rectangle(5, 5, 195, 195, function ($draw) {
                $draw->background('rgba(255, 255, 255, 0.5)');
                $draw->border(2, '#000');
            });
        /*$img = Image::make('shallan.jpg');
        $img->resize(320,240, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert('marcaagua.jpg');*/
        $img->save('thumbnail.jpg');
    }


    public function qr_qenerate(){
        //QrCode::format('png')->size(100)->color(255,0,0)->generate('Make me into a special QrCode!', '../public/qrcodes/qrcode.png');
        QrCode::format('png')->size(100)->color(255,0,0)->merge('http://www.desarrollolibre.net/assets/img/logo.png', .3, true)->generate('Make me into a special QrCode!', '../public/qrcodes/qrcode.png');

    }

    public function translate(){
        $tr = new GoogleTranslate('fr');
        $tr->setSource('es');
        $tr->setTarget('en');
        echo $tr->translate('Hola mundo maravilloso'); 
    }

    public function stripe_create_customer(){
        $user = User::find(1);
        $stripeCustomer = $user->createAsStripeCustomer();
        dd($stripeCustomer);
    }

    public function stripe_payment_method_register(){
        $user = User::find(1);
        return view('paquetes.stripe_payment_method_register', [
            'intent' =>  $user->createSetupIntent()
        ]);
       
    }


    public function stripe_payment_method_create(){
        $user = User::find(1);
        $user->addPaymentMethod('pm_1GfjIUGFkoHHabUIboHzcaTp');
       
    }

    public function stripe_payment_method(){
        $user = User::find(1);
        dd($user->paymentMethods());

    }

    public function stripe_create_only_pay_form(){
        $user = User::find(1);
        return view('paquetes.stripe_create_only_pay_form');
    }

    public function stripe_create_only_pay(){
        $user = User::find(1);
        $stripeCharge = $user->charge(100, "pm_1GfjIUGFkoHHabUIboHzcaTp");
        dd($stripeCharge);
    }

    public function stripe_create_suscription(){

        $user = User::find(1);
        $paymentMethod = $user->defaultPaymentMethod();
        $user->newSubscription('default', 'prod_HEYYMXmi6GTG5Z')->create($paymentMethod->id);

    }
}
