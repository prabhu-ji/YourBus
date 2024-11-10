<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use Notification;
use App\Models\Booking;
use App\Models\PaymentData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }
    public function index()
    {
        return view('paywithpaypal');
    }
    public function payWithpaypal(Request $request)
    {
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $return_url = '/all-busbooking?pickup_point='.$request->pickup_point.'&dropping_point='.$request->dropping_point.'&departure_date='.$request->departure_date;
        // $redirect_urls->setReturnUrl(url($return_url)) /** Specify return URL **/
        //     ->setCancelUrl(url($return_url));
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('/'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        // dd($payment->create($this->_api_context));exit;
        try {

            $payment =  $payment->create($this->_api_context);
            // return $payment;

            $user = session()->get('user_id');
            
            $booking = new Booking();
            $booking->pickup_point = $request->input('pickup_point');
            $booking->dropping_point = $request->input('dropping_point');
            $booking->seats = $request->input('seat');
            $booking->journey_date = $request->input('departure_date');
            $booking->total_amount = $request->input('amount');
            $booking->user_id = $user;
            $booking->payment_status = '0';
            $booking->trip_id = $request->input('trip_id'); 
            $booking->save();
            

            $user = new PaymentData();
            $user->amount = $request->input('amount');
            $user->payment_id = $payment->id;
            $user->payment_done = '0';
            $user->booking_id = $booking->id;
            $user->save();

            Session::put('booking', $booking->id);


        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return Redirect::to('/payment-failed');

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/payment-failed');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        Session::put('error', 'Unknown error occurred');
        return Redirect::to('/payment-failed');

    }

    public function getPaymentStatus()
    {
        
        $request=request();//try get from method
        // return $request;
        $payment_id = Session::get('paypal_payment_id');
        if($payment_id != ''){
            /** Get the payment ID before session clear **/
            
            /** clear the session payment ID **/
            Session::forget('paypal_payment_id');
            //if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            if (empty($request->PayerID) || empty($request->token)) {

                Session::put('error', 'Payment failed');
                return Redirect::to('/payment-failed');

            }

            $payment = Payment::get($payment_id, $this->_api_context);
            $execution = new PaymentExecution();
            //$execution->setPayerId(Input::get('PayerID'));
            $execution->setPayerId($request->PayerID);

            /**Execute the payment **/
            $result = $payment->execute($execution, $this->_api_context);

            if ($result->getState() == 'approved') {


                Booking::where('id',session()->get('booking'))->update([
                    'payment_status' => '1'
                ]);

                PaymentData::where('booking_id',session()->get('booking'))->update([
                    'payment_done' => '1'
                ]);


                Session::put('success', 'Payment success');
                //add update record for cart
                return view('success');  //back to product page
            }

            Session::put('error', 'Payment failed');
            return Redirect::to('/payment-failed'); 

        }else{
            return Redirect::to('/payment-failed'); 
        }
    }

    public function payment_failed(){
        return view('failed');
    }

}