<?php
class XmlIsPKException extends Exception{
    public function errorMessage()
    {
        // 错误信息
        $errorMsg = '错误行号 '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> xml的isPK属性填写错误';
        return $errorMsg;
    }
}

?>