<?php
require_once 'config/db.php';
class BlooddonorModal{
    private $lb_madg;
    private $lb_hovaten;
    private $lb_gioitinh;
    private $lb_namsinh;
    private $lb_nghenghiep;
    private $lb_ngaycapthe;
    private $lb_ngayhethan;
    private $lb_diachi;
    public function getAllBD(){
        $conn = $this->connectDb();
        $sql = "SELECT * FROM docgia";
        $result = mysqli_query($conn, $sql);
        $arr_lb = [];
        if(mysqli_num_rows($result)>0){
            $arr_bd = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return $arr_bd;
    }
    public function insert($param = []) {
        $connection = $this->connectDb();
        //tạo và thực thi truy vấn
        $queryInsert = "INSERT INTO docgia(madg, hovaten, gioitinh, namsinh, nghenghiep, ngaycapthe, ngayhethan, diachi)
        VALUES ('{$param['madg']}', '{$param['hovaten']}', '{$param['gioitinh']}', '{$param['namsinh']}', '{$param['nghenghiep']}', '{$param['ngaycapthe']},{$param['ngayhethan']},{$param['diachi']}')";
        $isInsert = mysqli_query($connection, $queryInsert);
        $this->closeDb($connection);

        return $isInsert;
    }
    public function connectDb() {
        $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (!$connection) {
            die("Không thể kết nối. Lỗi: " .mysqli_connect_error());
        }

        return $connection;
    }
    public function closeDb($connection = null) {
        mysqli_close($connection);
    }
    public function getBDById($bd_id = null) {
        $connection = $this->connectDb();
        $querySelect = "SELECT * FROM docgia WHERE madg={$lb_madg}";
        $results = mysqli_query($connection, $querySelect);
        $bdArr = [];
        if (mysqli_num_rows($results) > 0) {
            $lbr = mysqli_fetch_all($results, MYSQLI_ASSOC);
            $bdArr = $lbr[0];
        }
        $this->closeDb($connection);

        return $bdArr;
    }
    public function update($lb = []) {
        $connection = $this->connectDb();
        $queryUpdate = "UPDATE docgia
        SET hovaten = '{$lb['hovaten']}',gioitinh = '{$lb['gioitinh']}',namsinh = '{$lb['namsinh']}',nghenghiep = '{$lb['nghenghiep']}',
        ngaycapthe = '{$lb['ngaycapthe']}', ngayhethan = '{$lb['ngayhethan']}',diachi = '{$lb['diachi']}',  WHERE madg = {$bd['madg']}";
        $isUpdate = mysqli_query($connection, $queryUpdate);
        $this->closeDb($connection);

        return $isUpdate;
    }
    public function delete($ma = null) {
        $connection = $this->connectDb();

        $queryDelete = "DELETE FROM docgia WHERE madg = {$ma}";
        $isDelete = mysqli_query($connection, $queryDelete);

        $this->closeDb($connection);

        return $isDelete;
    }
}

?>