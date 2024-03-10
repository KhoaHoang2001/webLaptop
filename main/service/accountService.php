<?php

require_once '../../../../config.php';
require_once(ROOT.'\src\main\dao\accountDAO.php');
require_once(ROOT.'\src\main\model\accountDTO.php');

class accountService {
    private $accountDAO;
    function __construct() {
        $this->accountDAO = new accountDAO();
    }
    public function findById($id) {
        $result = $this->accountDAO->findById($id);
        return $result;
    }
    public function findAll() {
        $result = $this->accountDAO->findAll();
        return $result;
    }
    public function findByUserName($username){
        return $this->accountDAO->findByUserName($username);
    }
    public function save($accountDTO) {
        $result = $this->accountDAO->save($accountDTO);
        return $result;
    }

    public function updateAccount($accountDTO) {
        return $this->accountDAO->updateAccount($accountDTO);
    }

    public function deleteAccount($id) {
       return $this->accountDAO->deleteAccount($id);
    }

    public function findByUserNameAndPassword($username, $password) {
        return $this->accountDAO->findByUserNameAndPassword($username, $password);
    }

    public function findRoleByUserNameAndPassword($username, $password) {
        return $this->accountDAO->findRoleByUserNameAndPassword($username, $password);
    }

    public function findRoleByUserId($id) {
        return $this->accountDAO->findRoleByUserId($id);
    }

    public function updateIdNhomQuyen($id_nhom_quyen) {
        $result = $this->accountDAO->updateIdNhomQuyen($id_nhom_quyen);
        return $result>=0;
    }
}

?>
