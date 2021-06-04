<?php 
  require('stripe-php-master/init.php');

  $publishableKey = "pk_test_51HMs0BFJL6UcB80pi6h5wm6gdwBFkPh3hfKqLDPzRhZv2di7pHe8FpAxkA5DfOCaKEZ1h5DvCY6ORXrmsjBXcaRe00eScGfEVI";

  $secretKey = "sk_test_51HMs0BFJL6UcB80pKQqaG4ejAnJmCJ5a4lxLM6nGq8gAnJr9IiFfnJOFAEIxkAZQhUKmvCQd9uiWxgJI65fjMPmp00aN2C9BZD";


// using namespace to set  the key
\Stripe\Stripe::setApiKey($secretKey);


?>