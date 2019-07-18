@extends('templates.admin.master')
@section('main')
    @section('title', 'User')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Danh sách User</h4>                  
                    @if(Session::has('msg'))
                        <p class="category success">
                            {{Session::get('msg')}}
                        </p>
                    @endif
                    <a href="{{route('admin.user.add')}}" class="addtop"><img src="/templates/admin/img/add.png" alt="" /> Thêm</a>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <th>ID</th>
                        <th>User</th>
                        <th>Fullname</th>
                        <th>Level</th>
                        <th>Chức năng</th>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            @php
                                $uid        = $user->id;
                                $username   = $user->username;
                                $fullname   = $user->fullname;
                                $level   = $user->level;
                                if($level==1){
                                    $nameLevel = "Admin";
                                } else {
                                    $nameLevel = "User";
                                }
                                $urlEdit    = route('admin.user.edit', $uid);
                                $urlDel    = route('admin.user.del', $uid);
                            @endphp
                        <tr>
                            <td>{{$uid}}</td>
                            <td>{{$username}}</td>
                            <td>{{$fullname}}</td>
                            <td>{{$nameLevel}}</td>
                            <td>
                                <a href="{{$urlEdit}}"><img src="/templates/admin/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                                <a onclick="return xacnhanxoa('Bạn có chắc muốn xóa')" href="{{$urlDel}}"><img src="/templates/admin/img/del.gif" alt="" /> Xóa</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <div class="text-center">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
