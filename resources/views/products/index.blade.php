<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products Page</title>
</head>

<body>
    <h1>All Products Page</h1>

    <div>

        @foreach($products as $product)
            <h3>{{$product['title']}}</h3>
        @endforeach

    </div>
</body>

</html>