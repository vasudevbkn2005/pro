@extends('layouts.app')
@section('content')
    <style>
        .zoom-effect {
            transition: transform 0.3s ease;
        }

        .zoom-effect:hover {
            transform: scale(1.1);
        }
    </style>
    <div class="container" style="background-color:#eee">
        <div class="row border" >
            @foreach ($data as $mcat => $info)
                <div class="col-4 mb-3 mt-3">
                    <div style="background-color: #fff;border-radius: 3px;min-height: 200px;box-shadow: #666">
                        <h4 style="font-weight: bolder;padding: 5px;border-bottom: 1px solid #eee" class="text-center">
                            {{ $mcat }}
                        </h4>
                        <div class="row">
                            @foreach ($info as $cat)
                                <div class="col-6 zoom-effect" style="cursor: pointer"
                                    onclick="location.href='/product/productdisplay/{{ $cat['id'] }}'">
                                    <div class="card mb-3">
                                        <div class="body">
                                            <img src="/images/{{ $cat['image'] ?? 'imagenotfound.jpg' }}" height="200px"
                                                width="193px" alt="Category Image" class="card-aig-fix">
                                            <div class="title h5 text-center">
                                                {{ $cat['cname'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
