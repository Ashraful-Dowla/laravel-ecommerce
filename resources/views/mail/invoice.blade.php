<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>
    <h1>Succesfully Order Placed</h1>
    <strong>Order Id(Tracking Id): {{ $order['order_id'] }} </strong><br />
    <strong>Order Date: {{ $order['date'] }} </strong><br />
    <strong>Total Amount: {{ $order['total'] }} </strong><br />
    <strong>Total Amount(after discount): {{ $order['after_discount'] }} </strong><br />
    <hr>
    <strong>Name: {{ $order['c_name'] }} </strong><br />
    <strong>Phone: {{ $order['c_phone'] }} </strong><br />
    <strong>Address: {{ $order['c_address'] }} </strong><br />
</body>

</html>
