<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disbursement;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;



class DisbursementController extends Controller
{
    protected $paramsErrors =[];

    protected $formNames = [    'Amount'=>'amount',
   'Currency'=> 'currency' ,
    'Transaction type'=>'transactionType',
   'Payment type' => 'paymentType',
  'Disbursement Number' => 'disbursementNumber',
   'Instrument Id' => 'instrumentId',
   'Expiration Date' => 'expirationDate',
   'Network' => 'network',
   'Payee Id' => 'payeeId',
   'Mode' => 'mode',
   'Descriptor' => 'descriptor',
];
  
protected $currencyArr = ["AED", "AFN", "ALL", "AMD", "ANG", "AOA", "ARS", "AUD", "AWG", "AZN", "BAM", "BBD", "BDT", 
"BGN", "BHD", "BIF", "BMD", "BND", "BOB", "BRL", "BSD", "BTN", "BWP", "BYN", "BYR", "BZD", "CAD", "CDF", 
"CHF", "CLF", "CLP", "CNY", "COP", "CRC", "CUC", "CUP", "CVE", "CZK", "DJF", "DKK", "DOP", "DZD", "EGP", 
"ERN", "ETB", "EUR", "FJD", "FKP", "GBP", "GEL", "GHS", "GIP", "GMD", "GNF", "GTQ", "GYD", "HKD", "HNL", 
"HRK", "HTG", "HUF", "IDR", "ILS", "INR", "IQD", "IRR", "ISK", "JMD", "JOD", "JPY", "KES", "KGS", "KHR", 
"KMF", "KPW", "KRW", "KWD", "KYD", "KZT", "LAK", "LBP", "LKR", "LRD", "LSL", "LYD", "MAD", "MDL", "MGA", 
"MKD", "MMK", "MNT", "MOP", "MRO", "MUR", "MVR", "MWK", "MXN", "MXV", "MYR", "MZN", "NAD", "NGN", "NIO", 
"NOK", "NPR", "NZD", "OMR", "PAB", "PEN", "PGK", "PHP", "PKR", "PLN", "PYG", "QAR", "RON", "RSD", "RUB", 
"RWF", "SAR", "SBD", "SCR", "SDG", "SEK", "SGD", "SHP", "SLL", "SOS", "SRD", "SSP", "STD", "SVC", "SYP", 
"SZL", "THB", "TJS", "TMT", "TND", "TOP", "TRY", "TTD", "TWD", "TZS", "UAH", "UGX", "USD", "UYI", "UYU", 
"UZS", "VEF", "VND", "VUV", "WST", "XAF", "XCD", "XOF", "XPF", "XXX", "YER", "ZAR", "ZMW", "ZWL"];

    public function index(){
       $alldata = Disbursement::all();
       //get everything from the DB
    
  
       return view('index', ['alldata'=>$alldata]);
       
    }

    public function create()
    {
        $formNames = $this->formNames;   
       $currencyArr =  $this->currencyArr;
        $paramsErrors = $this->paramsErrors;
        return view('post_disbursement', compact('formNames', 'currencyArr','paramsErrors')); 
    }
    
    public function store(Request $request)
    {
        //validation step 

        //Initializing some variables we will pass to the view
        $formNames = $this->formNames;   
        $currencyArr =  $this->currencyArr;
        $paramsErrors = $this->paramsErrors; // paramsErrors is all errors coming from query parameters or exception
                 
        //Could create validation request but since we have only one form we can validate like this
        $request->validate([
           $this->formNames['Amount'] => 'required|numeric|min:0.1',
           $this->formNames['Currency'] => 'required|string',
           $this->formNames['Transaction type'] => 'required|string',
           $this->formNames['Payment type'] => 'required|string',
           $this->formNames['Payee Id'] => 'required|integer',
           $this->formNames['Expiration Date'] => 'nullable|date_format:Y-m|after:'.date('Y-m'),
// $this->formNames['Instrument Id'] => 'required_if:'.$request->input('disbursementNumber').',==,null',
// $this->formNames['Disbursement Number'] => 'required_if:'.$request->input('instrumentId').',==, null',
// $this->formNames['Network'] => 'required_if:'.$request->input('transactionType').',==, CARD'
                       ]);


              if(is_null( $request->input('instrumentId')) && is_null($request->input('disbursementNumber'))){
                      array_push($paramsErrors,"Instrument Id or Disbursement number required") ;
                  }


           if($request->input('transactionType')  === "CARD" 
              && is_null($request->input('expirationDate')) 
              && is_null($request->input('network'))){
                  //take all errors to display to the view if there are
                 array_push($paramsErrors,"Expiry date and Network required");
   
//    $request->validate([
//     $this->formNames['Expiration Date'] => 'date_format:Y-m|after:'.date('Y-m'),
//     $this->formNames['Network'] => 'required|string'
//    ]);
}

            elseif(count($paramsErrors) == 0){

                 $body = [ ];
                 foreach($this->formNames as $name){
                if(!is_null($request->input($name)) ){
                $body[$name] = $request->input($name);
                            }
                }

    $client = new Client(['base_uri' => 'https://devsec.aptpaydev.com/']);

    try {
       $res = $client->request('POST', '/disbursements/add', [
             'headers' => ['AptPayApiKey'=> env('APTPAY_APIKEY')],
              'body' => json_encode($body),
    ]);
           $resBody = (string)$res->getBody();
           $body["status"] = (json_decode($resBody,true))["status"];
           $model=   Disbursement::create($body);
          return redirect('/');
    
     } catch(ClientException $exception) {
         $responseBody = $exception->getResponse()->getBody(true);
         //echo $responseBody;
         // we want to display all exeptions caught
         foreach( (json_decode((string)$responseBody,true)['errors']) as $key1 => $key2){
             if(gettype($key2)=="string"){
                array_push($paramsErrors,$key2);
                
             }
             else{
           foreach($key2 as $valKey2 => $key3){
            
            if(gettype($key3)=="string"){
                //structure to catch transit ID error
                array_push($paramsErrors,$key3);
                
             }
             else{
                 //structure to catch disbursement number error
              array_push($paramsErrors,$key3[0]);}
           }
            }
         }
     }
}


 return view('post_disbursement', compact('formNames', 'currencyArr','paramsErrors')); 
    }
 
public function SetUpWebhook(){

//if you want to change url webhook


}
  
}
