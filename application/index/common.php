<?php
// 统一返回操作
function msg($code, $data, $msg) {
    return compact('code', 'data', 'msg');
}