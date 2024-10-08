@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert alert h3 text-center">
            Category Edit Form
        </div>
        <form action="/category/{{$info['id']}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <lable for="mname"> Main Category</lable>
                <input type="mname" class="form-control upper"  onkeyup="this.value=capitalizefirstLetter(this.value)"
                    pattern="[A-z 0-9]{2,30}" name="mname" id="mname" placeholder="Enter Main Category"
                    value="{{ $info['mname'] }}" required>
                {{-- <detalist id="mainnames">
                    @foreach ($mcats as $mcat)
                        <option value="{{$mcat['mname']}}"></option>
                    @endforeach
                </detalist> --}}
            </div>
            <div class="mb-3">
                <lable for="cname">Category</lable>
                <input type="cname" class="form-control upper"  pattern="[A-z 0-9]{2,30}" name="cname" id="cname"
                    placeholder="Enter Category" value="{{ $info['cname'] }}" required>
            </div>
            @if ($info['image'])
                <div class="mb-3">
                    <div class="form-control">
                        <img src="/images/{{$info['image']}}"  height="200">
                    </div>
                    <label >Uploaded Image</label>
                </div>
            @endif
            <div class="input-group mb-3">
                <label class="input-group-text"   for="inputGroupFile02" >Upload</label>
                <input type="file" class="form-control" name="image"  accept="image/*" id="inputGroupFile02">
            </div>
            <div class="mb-3">
                <lable for="des">Description</lable>
                <textarea name="des" id="des" class="form-control" placeholder="Enter Description">{{ $info['des'] }}</textarea>
            </div>
            <div class="mb-3">
                <lable for="display">Display on Site</lable>
                <select name="display" id="display"  class="form-select">
                    <option value="yes">Yes</option>
                    <option value="no"{{ $info['display'] == 'no' ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <button class="btn btn-success">Save</button>
    </div>
    </form>
@endsection
