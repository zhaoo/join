<?php
namespace app\admin\controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use app\admin\model\SysinfoModel;

class Email extends Base
{
    public function index(){
        if(request()->isAjax()){
            $param = input('param.');
            $sysinfoModel = new SysinfoModel();
            $sysinfo = $sysinfoModel->getSysinfo();
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = $sysinfo['mail_host'];
                $mail->SMTPAuth = true;
                $mail->Username = $sysinfo['mail_username'];
                $mail->Password = $sysinfo['mail_password'];
                $mail->SMTPSecure = 'ssl';
                $mail->Port = $sysinfo['mail_port'];
                $mail->setFrom($sysinfo['mail_from_address'],$param['send_name']);
                $mail->addAddress($param['save']);
                $mail->isHTML(true);
                $mail->Subject = $param['subject'];
                $mail->Body = '发件人昵称：'.$param['send_name'].'</br>'.'发件人邮箱：'.$param['send_email'].'</br>'.'内容：'.$param['body'];
                // $mail->addAddress('23275429@qq.com', 'George.Haung');
                // $mail->addReplyTo('admin@sandboxcn.com', 'SandBoxCn');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');
                // $mail->addAttachment('/var/tmp/file.tar.gz');
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
                // $mail->AltBody = 'xxxxxx';
                $mail->send();
                return json(msg(1, '', '发送成功'));
            } catch (Exception $e) {
                return json(msg(-1, '', '发送失败'));
            }
        }
    }
}