<?php
namespace app\admin\controller;
use think\Response;
use think\Image;
use app\admin\model\UserModel;
use app\admin\model\CollegeModel;
use app\admin\model\SysinfoModel;

class Profile extends Base
{
    //public 绝对路径， 用于用户提交相对路径时追加
    private $public_path = ROOT_PATH.'public';
    //相对路径，用于返回前端
    private $head_return_path = '/upload/images/head';
    //绝对路径，用于存储地址
    private $head_save_path = ROOT_PATH.'public/upload/images/head';

    // 个人资料
    public function index() {
        if ($this->request->isAJax()) {
            $param = $this->request->param();
            if (empty($param)) {
                return json(msg(-1, url('admin/index/index'), 'not found user'));
            }
            if (!empty($param['user_name'])) {
                unset($param['user_name']);
            }
            $user_model = new UserModel();
            $flag = $user_model->updateStatus($param, session('id'));
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $userModel = new UserModel();
        $collegeModel = new collegeModel();
        $user_data = $userModel->getOneUser(session('id'));
        if (is_null($user_data)) {
            return json(msg(-1, url('admin/index/index'), 'not found user'));
        }
        $sysinfoModel = new SysinfoModel();
        $sysinfo = $sysinfoModel->getSysinfo();
        $function = explode(',',$sysinfo['user_function']);
        $this->assign([
            'user_data' => $user_data,
            'college' => $collegeModel->getAllCol(),
            'public' => config('public_status'),
            'function' => $function,
        ]);
        return $this->fetch();
    }

    //获取专业
    public function getMajor() {
        $id=input('id');
        $collegeModel = new CollegeModel();
        $college = $collegeModel->getOneCollege($id);
        return $college['major'];
    }

    //上传二维码
    public function qrcode() {
        if(request()->isAjax()){
            $file = request()->file('file');
            $info = $file->validate(['ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'upload/images/wechat');
            if($info){
                $src =  '/upload/images/wechat' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            }else{
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    // 修改密码
    public function passwdEdit() {
        if ($this->request->isAjax()) {
            $param = $this->request->param();
            if (empty($param)) {
                return json(msg(-1, '', 'not found user'));
            }
            if ($param['new_password'] !== $param['re_new_password']) {
                return json(msg(-2, '', '两次输入的密码不相同'));
            }
            $user_model = new UserModel();
            $user_data = $user_model->getOneUser(session('id'));
            if (is_null($user_data)) {
                return json(msg(-1, '', 'not found user'));
            }
            if ($user_data['password'] !== md5($param['old_password']. config('salt'))) {
                return json(msg(-3, '', '旧密码错误'));
            }
            if ($user_data['password'] === md5($param['new_password']. config('salt'))) {
                return json(msg(-4, '', '新密码不能和旧密码相同'));
            }
            $param['password'] = md5($param['new_password']. config('salt'));
            $flag = $user_model->updateStatus($param, session('id'));
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        return $this->fetch();
    }

    // 上传头像
    public function uploadHeade()
    {
        if (!$this->request->isAjax()) {
            return Response('not supported', 500);
        }
        //获取文件并检查，注意这里使用croppic插件的特定json返回。
        $file = $this->request->file('img');
        if (empty($file) && !$file->checkImg()) {
            return json(['status' => 'error', 'message' => 'not found image']);
        }
        //获取文件后缀名
        $image_type = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);
        $save_name = $this->getImageName($image_type);
        $info = $file->move($this->head_save_path, $save_name);
        if (false === $info) {
            return json(['status' => 'error', 'message' => $file->error]);
        }else {
            //返回图像信息
            $image = Image::open($this->head_save_path. '/'. $save_name);
            return json([
                'status' => 'success',
                'url' => $this->head_return_path. '/'. $save_name,
                "width" => $image->width(),
				"height" => $image->height()
            ]);
        }
    }

    // 裁剪头像
    public function cropHeade()
    {
        if (!$this->request->isAjax()) {
            return Response('not supported', 500);
        }
        $param = $this->request->param();
        if (empty($param) || empty($param['imgUrl'])) {
            return json(['status' => 'error', 'message' => 'not found image']);
        }
        //抛出符合croppic插件规范的异常，防止前端js错误
        try {
            $image = Image::open($this->public_path. $param['imgUrl']);
            $save_name = $this->getImageName($image->type());

            //预处理裁剪
            //这步相当于将图像缩放
            $image->crop(
                (int)$param['imgInitW'],    //裁剪区域宽度
                (int)$param['imgInitH'],    //裁剪区域高度
                (int)0,                     //裁剪区域x坐标
                (int)0,                     //裁剪区域y坐标
                (int)$param['imgW'],        //图像保存宽度
                (int)$param['imgH']         //图像保存高度
            );
            //如果存在旋转参数
            if(!empty($param['rotation'])){
                //这里旋转生成的新图像会被GD库自动填充黑边
                $image->rotate((int)$param['rotation']);
                //获取裁剪坐标差
                $dx = $image->width() - $param['imgW'];
                $dy = $image->height() - $param['imgH'];
                //裁剪出预选定区域
                $image->crop(
                    (int)$param['imgW'],    //裁剪区域宽度
                    (int)$param['imgH'],    //裁剪区域高度
                    (int)$dx / 2,           //裁剪区域x坐标
                    (int)$dy / 2           //裁剪区域y坐标
                );
            }
            //裁剪图像
            $image->crop(
                (int)$param['cropW'],    //裁剪区域宽度
                (int)$param['cropH'],    //裁剪区域高度
                (int)$param['imgX1'],    //裁剪区域x坐标
                (int)$param['imgY1']    //裁剪区域y坐标
            );
            //保存图像
            $image->save($this->head_save_path. '/'. $save_name);
            $user_model = new UserModel();
            $head_url = $this->head_return_path.'/'.$save_name;
            $profile_error = '/static/common/croppic/img/error.jpg';
            $flag = $user_model->headSave($head_url, session('id'));
            if ($flag['code'] == 1)
                return json(['status' => 'success', 'url' => $head_url]);
            else
                return json(['status' => 'success', 'url' => $profile_error]);
        } catch (\think\image\Exception $e) {
            return json(['status' => 'success', 'url' => $profile_error]);
        }
    }

    // 获取图像名称(固定长度32)
    private function getImageName($image_type)
    {
        $str = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
        $name = substr(str_shuffle($str), mt_rand(0, 30), 32);
        return $name. '.'. $image_type;
    }
}
