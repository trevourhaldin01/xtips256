<?php 
    session_start();
    if(isset($_POST['subscribe'])) {
        
        $email = $_SESSION['email'];
        $name = $_SESSION['fname'];
        if($_POST['amount'] && $_POST['selectedOption']) {
        $amount = $_POST['amount'];
        $option = $_POST['selectedOption'];
        
        

        //*prepare por rave request
        $request = [
            'tx_ref' => time(),
            'amount' => $amount,
            'currency' => 'UGX',
            'redirect_url' => 'http://localhost/ums-sp/rave/process.php',
            'customer'=> [
                'email' => $email,
                'name' => $name,

            ],
            'meta' => [
                'price' => $amount,
                'option'=> $option,

            ],
            'customizations' => [
                'title' => 'XTIPS256',
                'description' => 'paying for a XTIPS256 product',
            ]
            

        ];

        //send to flutterwave endpoint
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/payments",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($request),
            CURLOPT_HTTPHEADER => array(
              "Authorization: Bearer FLWSECK_TEST-a6b76855a340f438261f4a416b3a95ce-X",
              "content-type: application/json",
              "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        
       curl_close($curl);

       $res = json_decode($response);
       if($res->status == 'success') {
            $link  = $res->data ->link;
            header('location:'.$link);
       }
       else {
        echo 'we cannot process your payment';
       }
     } else {
        header('location: ../welcome.php');
     }
        


    } else {
       echo 'Unable to process';
    }

?>