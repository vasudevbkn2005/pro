@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert alert h3 text-center">
            Category Form
        </div>
        @if ($sms = Session::get('success'))
            <div class="alert alert-success text-center">
                <h5> {{ $sms }}</h5>
            </div>
        @endif
         @if ($sms = Session::get('delete'))
            <div class="alert alert-danger text-center">
                <h5> {{ $sms }}</h5>
            </div>
        @endif
        <div>
            <a href="/category/create" class="btn btn-success">New Category</a>
        </div>
        <form action="/category/mdel" method="POST">
            @csrf
            @method('delete')
            <table id="example" class="table">
                <thead class="table-primary">
                    <tr>
                        <th>S.No</th>
                        <th>Sub Category</th>
                        <th>Main Category</th>
                        <th>Description</th>
                        <th>Display</th>
                        <th>Edit</th>
                        <th>
                            <button id="delbtn" class="btn btn-danger"
                                onclick="return confirm('Do You Want To Selctor Record Deleted')"
                                disabled>Delete(s)</button>
                            <input type="checkbox" id="allchk"> Select All
                        </th>
                    </tr>
                </thead>
        </form>
        <tbody>
            @foreach ($data as $info)
                @php
                    $cls = 'text-primary';
                    if ($info['display'] == 'no') {
                        $cls = 'text-muted';
                    }
                @endphp
                <tr id="r_{{ $info['id'] }}">
                    <td>{{ $loop->iteration }}</td>
                    <td class="{{ $cls }}">{{ $info['cname'] }}</td>
                    <td class="{{ $cls }}">{{ $info['mname'] }}</td>
                    <td class="{{ $cls }}">{{ $info['des'] }}</td>
                    <td class="{{ $cls }}">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                                id="display"{{ $info['display'] == 'yes' ? 'checked' : '' }}
                                onclick="changedisplay('{{ $info['id'] }}',this)">
                        </div>
                    </td>
                    <td><a href="/category/{{ $info['id'] }}/edit" class="btn btn-warning">Edit</a></td>
                    <td>
                        <input type="checkbox" class="delchk" onclick="checkele(this)" value="{{ $info['id'] }}"
                            name="delid[]">
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    <script>
        function changedisplay(id, dis) {
            let tr = document.getElementById('r_' + id);
            let displays = dis.checked ? 'yes' : 'no';
            let i = 0;
            for (let x of tr.children) {
                if (dis.checked) {
                    if (i != 0)
                        x.className = "text-primary";
                } else {
                    if (i != 0)
                        x.className = "text-muted";

                }
                i++;
            }
            $.ajax({
                url: '/category/updatedisplay/' + displays + "/" + id,
                type: 'get',
                success: function(r) {
                    // alert('Success');
                },
                error: function(r) {
                    alert("Error");
                }
            })

        }
    </script>
@endsection
