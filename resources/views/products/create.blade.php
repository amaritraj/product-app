<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-2">
                                <label for="" class="form-label">Product ID</label>
                                <input type="text" name="product_id" value="{{old('product_id')}}" class="@error('product_id') is-invalid @enderror form-control">
                                @error('product_id')
                                    <p class="invalid-feedback"> {{$message}} </p>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class="@error('name') is-invalid @enderror form-control">
                                @error('name')
                                    <p class="invalid-feedback"> {{$message}} </p>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Product Description</label>
                                <textarea name="description" class="form-control" id="" rows="3">{{old('description')}}</textarea>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Product Price</label>
                                <input type="text" name="price" value="{{old('price')}}" class="@error('price') is-invalid @enderror form-control">
                                @error('price')
                                    <p class="invalid-feedback"> {{$message}} </p>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Product Stock</label>
                                <input type="text" name="stock" value="{{old('stock')}}" class="form-control">
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Upload image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
