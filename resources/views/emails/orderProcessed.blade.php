<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<h1>Order Details</h1>


<p>  Foreign currency purchased : {{ $quote->currency->name  }} </p>

<p>  Amount Purchased : {{ $quote->purchased_amount_foreign_currency }}</p>


<p>  USD Amount Paid : {{ $quote->paid_amount_usd }}</p>



</body>
</html>