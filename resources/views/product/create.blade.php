@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            @foreach ($errors->all() as $e)
                <h3 class="btn btn-danger">{{ $e }}</h3>
            @endforeach
        </div>
        <div class="alert alert h3 text-center">
            Product Create Form
        </div>
        <form action="/product/" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                @foreach ($catinfo as $mcat => $cinfo)
                    <div class="mb-3 border col-6">
                        <h4>{{ $mcat }}</h4>
                        <div>
                            @foreach ($cinfo as $cat)
                                <input type="checkbox" id="c{{ $cat['id'] }}" name="cats[]" value="{{ $cat['id'] }}">
                                <label for="c{{ $cat['id'] }}"><b>{{ $cat['cname'] }}</b></label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="name">Product Name :</label>
                <input type="text" class="form-control upper" pattern="[A-z 0-9]{2,30}" name="name" id="name"
                    placeholder="Enter Product Name" required>
            </div>
            <div class="mb-3">
                <label for="pprice">Product Price :</label>
                <input type="text" class="form-control" pattern="[0-9.]{2,30}" name="pprice" id="pprice"
                    placeholder="Enter Product Price" required>
            </div>
            <div class="mb-3">
                <label for="sprice">Selling Price :</label>
                <input type="text" class="form-control" pattern="[0-9.]{2,30}" name="sprice" id="sprice"
                    placeholder="Enter Selling Price" onchange="getFinalPrice()" onkeyup="getFinalPrice()" required>
            </div>
            <div class="mb-3">
                <label for="discount">Discount :</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">%</span>
                    <input type="number" class="form-control" id="discount" placeholder="Enter Discount" min="0"
                        max="100" aria-label="Enter Discount" aria-describedby="basic-addon1"
                        onchange="getFinalPrice()" onkeyup="getFinalPrice()">
                </div>
            </div>
            <div class="mb-3">
                <label for="fprice">Final Price :</label>
                <input type="text" class="form-control" pattern="[0-9.]{2,30}" name="fprice" readonly id="fprice"
                    placeholder="Final Price" required>
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter Description"></textarea>
            </div>
            <div class="mb-3">
                <div id="main">
                    <div id="d1">
                        <label for="image" class="form-label">Image Upload</label>
                        <input type="file" name="image[]" class="form-control" accept="image/*" id="image">
                    </div>
                </div>
                <input type="hidden" value="1" id="tot">
                <a href="#main" onclick="oneMore()">More</a>
                &nbsp;&nbsp;
                <a href="#main" onclick="del()">Remove</a>
            </div>
            <div class="mb-3">
                <label for="display">Display on Site</label>
                <select name="display" id="display" class="form-select">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div style="text-align: center">
                <button class="btn btn-success" >Save</button>
            </div>
        </form>
    </div>
    <script>
        function getFinalPrice() {
            const sprice = document.getElementById('sprice').value;
            const discount = document.getElementById('discount').value || 0;
            const finalPrice = sprice - (sprice * discount / 100);
            document.getElementById('fprice').value = finalPrice.toFixed(2);
        }

        function oneMore() {
            tot.value = Number(tot.value) + 1;
            let dv = document.createElement('div');
            dv.setAttribute('id', 'd' + tot.value);
            dv.innerHTML =
                ` <label for="image${tot.value}" class="form-label">Image Upload ${tot.value}</label>
                        <input type="file" name="image[]" class="form-control" accept="image/*" id="image${tot.value}">`
            main.appendChild(dv);
        }

        function del() {
            if (Number(tot.value) > 1) {
                let dv = document.getElementById('d' + tot.value);
                tot.value = Number(tot.value) - 1;
                main.removeChild(dv);
            }
            else{
                alert('One Is Required');
            }
        }
    </script>
@endsection
