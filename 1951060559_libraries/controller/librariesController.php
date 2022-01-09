<?php

require_once 'model/librariesModel.php';
class BlooddonorController{
    function index(){
        $lbModal = new BlooddonorModal();
        $lbrs = $lbModal->getAllBD();
        require_once 'view/libraries/index.php';
    }
    function admin(){
        $lbModal = new BlooddonorModal();
        $lbrs = $lbModal->getAllBD();
        require_once 'view/libraries/admin.php';
    }
    function add(){
        $error = '';
        if(isset($_POST['submit'])){
            $lb_hovaten = $_POST['hovaten'];
            $lb_hovaten = $_POST['hovaten'];
            
            if(empty($lb_madg) || empty($lb_hovaten) || empty($_POST['gioitinh'])|| empty($lb_namsinh) || empty($lb_nghenghiep) || empty($lb_ngaycapthe) || empty($lb_ngayhethan) || empty($lb_diachi)){
                $error = 'Thông tin chưa đầy đủ!';
            }else{
                $lb_gioitinh = $_POST['gioitinh'];
                $lbModal = new BlooddonorModal();
                $lbrs = [
                    'madg' => $lb_madg,
                    'hovaten' => $lb_hovaten,
                    'gioitinh' => $bd_sex,
                    'namsinh' => $lb_namsinh,
                    'nghenghiep' => $lb_nghenghiep,
                    'ngaycapthe' => $lb_ngaycapthe,
                    'ngayhethan' => $lb_ngayhethan,
                    'diachi' => $lb_diachi,
                ];
                $isAdd = $lbModal->insert($lbrs);
                if ($isAdd) {
                    $TT=  "Thêm mới thành công";
                }
                else {
                    $TT= "Thêm mới thất bại";
                }
                header("Location: index.php?controller=libraries&action=admin&tt=$TT");
                exit();
            }

        }
        require_once 'view/libraries/add.php';
    }
    function edit(){
        if (!isset($_GET['madg'])) {
            $_SESSION['error'] = "Tham số không hợp lệ";
            header("Location: index.php?controller=libraries&action=admin");
            return;
        }
        if (!is_numeric($_GET['madg'])) {
            $_SESSION['error'] = "mã phải là số";
            header("Location: index.php?controller=libraries&action=admin");
            return;
        }
        $id = $_GET['madg'];
        $lbModal = new BlooddonorModal();
        $lb = $lbModal->getBDById($id);
        $error = '';
        if (isset($_POST['submit'])) {
            $lb_hovaten = $_POST['hovaten'];
            //$bd_sex = $_POST['bd_sex'];
            $lb_namsinh = $_POST['namsinh'];
            $lb_nghenghiep = $_POST['nghenghiep'];
            $lb_ngaycapthe = $_POST['ngaycapthe'];
            $lb_ngayhethan = $_POST['ngayhethan'];
            $lb_diachi = $_POST['diachi'];
            if(empty($lb_madg) || empty($lb_hovaten) || empty($_POST['gioitinh'])|| empty($lb_namsinh) || empty($lb_nghenghiep) || empty($lb_ngaycapthe) || empty($lb_ngayhethan) || empty($lb_diachi)){
                $error = 'Thông tin chưa đầy đủ!';
            }else {
                
                //xử lý update dữ liệu vào hệ thống
                    $lb_gioitinh = $_POST['gioitinh'];
                    $lbrs = [
                        'madg' => $lb_madg,
                        'hovaten' => $lb_hovaten,
                        'gioitinh' => $bd_sex,
                        'namsinh' => $lb_namsinh,
                        'nghenghiep' => $lb_nghenghiep,
                        'ngaycapthe' => $lb_ngaycapthe,
                        'ngayhethan' => $lb_ngayhethan,
                        'diachi' => $lb_diachi,
                    ];
                $isAdd = $lbModal->update($lbrs);

                if ($isAdd) {
                    $TT= "Sửa thành công";
                }
                else {
                    $TT = "Sửa thất bại";
                }
                header("Location: index.php?controller=libraries&action=admin&tt=$TT");
                exit();
            }
        }
        require_once 'view/libraries/edit.php';
    }
    function delete(){
        $id = $_GET['madg'];
        if (!is_numeric($id)) {
            header("Location: index.php?controller=libraries&action=index");
            exit();
        }
        $lbModal = new BlooddonorModal();
        $isDelete = $lbModal->delete($id);
        if ($isDelete) {
            //chuyển hướng về trang liệt kê danh sách
            //tạo session thông báo mesage
            $TT=  "Xóa bản ghi thành công";
        }
        else {
            //báo lỗi
            $TT = "Xóa bản ghi thất bại";
        }
        header("Location: index.php?controller=libraries&action=admin&tt=$TT");
        exit();
    }
}

?>