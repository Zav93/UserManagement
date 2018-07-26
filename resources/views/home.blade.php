@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                    @if(Auth::user()->is_admin)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            @foreach($users as $key => $user)
                                <tbody>
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            <label class="switch">
                                                <input id="update_status_{{ $user->id }}" type="checkbox" onclick="updateStatus({{ $user->id }})" name="status" {{ $user->active && !is_null($user->active) ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="users/{{ $user->id }}/edit">
                                                <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                            </a>
                                            <form class="custom-delete-btn" action="users/{{ $user->id }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    {!!  $users->links() !!}
                @else
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                     Welcome   {{ Auth::user()->first_name }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

<script>
//    function updateStatus(userId) {
//        console.log(555555);
//        $('#update_status_' + userId).click(function(e) {
//            var value;
//            console.log(this.checked);
//            if(this.checked == true) {
//                value = 1
//            } else {
//                value = 0;
//            }
//            console.log(value + 33333);
//            $.ajax({
//                type: "GET",
//                url: "users/updateStatus",
//                data: { "active": value },
//                async: false,
//                success: function (data) {
//                    alert(data);
//                },
//                error: function (data) {
//                    alert("fail");
//                }
//            });
//        });
//
//    }
function updateStatus(userId) {
    var checkbox = document.getElementById('update_status_' + userId);
    var value;

    if (checkbox.checked == true)
        value = '1';
    else
        value = '0';

    $.ajax({
        type: "POST",
        url: "users/status",
        data: { active: value, user_id: userId },
        success: function (data) {
            alert('Status updated');
        },
        error: function (data) {
            alert("something went wrong");
        }
    });
}
</script>
