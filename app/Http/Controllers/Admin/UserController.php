<?php

namespace App\Http\Controllers\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(User $muser){
		$this->muser = $muser;
	}
    public function index(){
    	$users = $this->muser->getList();
        return view('admin.user.index', compact('users'));
    }

    public function getAdd(){
        return view('admin.user.add');
    }

    public function postAdd(Request $request){
        $request->validate(
            [
                'username' => 'required|min:3|max:32',
                'password' => 'required',
                'fullname' => 'required|min:6|max:32',
            ],
            [
                'username.required'=>'Yều cầu nhập tên truy cập',
                'username.min'=>'Yều cầu nhập lớn hơn 3 ký tự',
                'username.max'=>'Yều cầu nhập nhơ hơn 32 ký tự',
                'password.required'=>'Yều cầu nhập mật khẩu',
                'fullname.required'=>'Yều cầu nhập tên đầy đủ',
                'fullname.min'=>'Yều cầu nhập lớn hơn 6 ký tự',
                'fullname.max'=>'Yều cầu nhập nhơ hơn 32 ký tự',
            ]
        );
        $username = trim($request->username);
        $password = trim($request->password);
        $fullname = trim($request->fullname);
        $level = $request->level;
        $item = [
        	'username' => $username,
        	'password' => bcrypt($password),
        	'fullname' => $fullname,
        	'level' => $level,
        ];
        $result = $this->muser->addItem($item);
        if($result) {
        	return redirect()
        		->route('admin.user.index')
        		->with('msg', 'Thêm thành công');
        } else {
        	return redirect()
        		->route('admin.user.index')
        		->with('msg', 'Lỗi');
        }
    }
    public function del($id) {
    	$result = $this->muser->delItem($id);
    	if($result) {
        	return redirect()
        		->route('admin.user.index')
        		->with('msg', 'Xóa thành công');
        } else {
        	return redirect()
        		->route('admin.user.index')
        		->with('msg', 'Lỗi');
        }
    }
    public function getEdit($id) {
    	$user = $this->muser->getItem($id);
    	$users = $this->muser->getListOption($id);
    	return view('admin.user.edit', compact('id', 'user','users'));
    }
    public function postEdit(Request $request, $id){
        $request->validate(
            [
                'username' => 'required|min:3|max:32',
                'fullname' => 'required|min:6|max:32',
            ],
            [
                'username.required'=>'Yều cầu nhập tên truy cập',
                'username.min'=>'Yều cầu nhập lớn hơn 3 ký tự',
                'username.max'=>'Yều cầu nhập nhơ hơn 32 ký tự',
                'fullname.required'=>'Yều cầu nhập tên đầy đủ',
                'fullname.min'=>'Yều cầu nhập lớn hơn 6 ký tự',
                'fullname.max'=>'Yều cầu nhập nhơ hơn 32 ký tự',
            ]
        );
        $username = trim($request->username);
        $password = trim($request->password);
        $fullname = trim($request->fullname);
        $level = $request->level;
        $item = [
        	'username' => $username,
        	'fullname' => $fullname,
        	'level' => $level,
        ];
        if($password!='') {
	        $item = [
	        	'username' => $username,
	        	'password' => bcrypt($password),
	        	'fullname' => $fullname,
	        	'level' => $level,
	        ];
        }
        $result = $this->muser->editItem($id, $item);
        if($result) {
        	return redirect()
        		->route('admin.user.index')
        		->with('msg', 'Sửa thành công');
        } else {
        	return redirect()
        		->route('admin.user.index')
        		->with('msg', 'Lỗi');
        }
    }
}
