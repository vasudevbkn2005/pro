@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert alert h3 text-center">
            Category Create Form
        </div>
        <form action="/category/" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <lable for="mname">Main Category</lable>
                <input type="mname" class="form-control upper" onkeyup="this.value=capitalizefirstLetter(this.value)"
                    pattern="[A-z 0-9]{2,30}" name="mname" id="mname"  placeholder="Enter Main Category" required>
                {{-- <detalist id="mainnames">
                    @foreach ($mcats as $mcat)
                        <option value="{{$mcat['mname']}}"></option>
                    @endforeach
                </detalist> --}}
            </div>
            <div class="mb-3">
                <lable for="cname">Category</lable>
                <input type="cname" class="form-control upper" autocomplete="off" pattern="[A-z 0-9]{2,30}" name="cname" id="cname"
                    placeholder="Enter Category" required>
            </div>
            <div class="input-group mb-3" >
                <label class="input-group-text" for="inputGroupFile02">Upload Category Image</label>
                <input type="file" class="form-control" name="image" accept="image/*" id="inputGroupFile02">
            </div>
            <div class="mb-3">
                <lable for="des">Description</lable>
                <textarea name="des" id="des" class="form-control" placeholder="Enter Description"></textarea>
            </div>
            <div class="mb-3">
                <lable for="display">Display on Site</lable>
                <select name="display" id="display" class="form-select">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <divc> 
            <button class="btn btn-success">Save</button>
            </div>
    </div>
    </form>
@endsection
