<?php
  session_start();
 
  include('../includes/config.php');
  $uid = $_SESSION['uid'];
  
    if(isset($_GET['status'])) {
        //check payment status
        if($_GET['status'] == 'cancelled') 
        {
            //payment cancelled
            header('location: ../welcome.php');
        }
        elseif ($_GET['status'] == 'successful')
         {
            $txid = $_GET['transaction_id'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS=> 10,
                CURLOPT_TIMEOUT=> 10,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                  "content-type: application/json",
                  "Authorization: Bearer FLWSECK_TEST-a6b76855a340f438261f4a416b3a95ce-X",
                  "cache-control: no-cache"
                ],
              ));
          
              $response = curl_exec($curl);
              
              
              
              $res = json_decode($response);
              if($res->status) 
              {
                $amountPaid = $res->data->charged_amount;
                $amountToPay = $res->data->meta->price;
                $optionSubscribed = $res->data->meta->option;
                $processDate = $res->data->created_at;

                if ($amountPaid >=$amountToPay) 
                {
                  echo 'Payment Successful, please re-login to update your subscriptions';
                  if ($optionSubscribed == 'odd2weekly') {
                     $activation_date = date('Y-m-d H:i:s', strtotime($processDate));
                     $query=mysqli_query($con,"call sp_activateOddTwoWeekly('$activation_date','$uid')");

                  }
                } else {
                  echo 'fraud transaction detected';
                }
                

              } else {
              
                echo 'Cannot process this payment, please try again..!!';
              }
              
        } 
    }


?>