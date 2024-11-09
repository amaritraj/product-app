<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('icon_logo.png') }}" sizes="32x32" type="image/png">
    <title>Product Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">

        <div class="bg-secondary py-2 mb-3 border-0 shadow-lg">
            <h3 class="text-white text-center">মডিউল ২০ এর এসাইনমেন্ট :: Product Management </h3>
        </div>


        <div class="row d-flex justify-content-center">
            <div class="col-md-12 d-flex justify-content-end">
                <a href="{{route('products.index')}}" class="btn btn-dark">Product List</a>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <th>Serial No</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>description</th>
                                <th>price</th>
                                <th>stock</th>
                                <th>image</th>
                                <th>Created at</th>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->product_id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->stock}}</td>
                                    <td>
                                        @if ($product->image != "")
                                            <img width="80" src="{{ asset('uploads/products/' .$product->image) }}" alt="{{$product->product_id}}">
                                        @endif
                                        </td>
                                    <td>{{\Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

