<?php
function my_website_on_order_placed( $orderid ) {

    if( ! $orderid ) return;

    $order = new WC_Order( $orderid );
    $coupons = $order->get_coupon_codes();
    if( $coupons ) {
        foreach( $coupons as $coupon ) {
            if( $coupon = 'test123' ) { // replace with your coupon name

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: REPLACE WITH YOUR OWN DATA <REPLACE@WITHYOUR.EMAIL>' . "\r\n";

                ob_start();
                ?>
                <p>Hi there,</p>
                <p>Your coupon {COUPON_NAME} has been used on our website.</p> <!-- Replace {COUPON_NAME} with your own coupon name -->
                <p>Best,<br/>The website team</p>
                <?php
                $body = ob_get_clean(); //Change above with your own markup

                $subject = 'You coupon has been used on our website'; //Change with your own wording

                $recipients = array(
                    'mail@mail.com', //First email
                    'mail@mail2.com' //Second email
                );

                foreach( $recipients as $email ) {
                    wp_mail($email, $subject, $body, $headers);
                }

            }
        }
    }
}
?>
