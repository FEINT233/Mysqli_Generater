<?php
class XmlNullException extends Exception{
    public function errorMessage()
    {
        // 错误信息
        $errorMsg = '错误行号 '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> xml的有属性为空';
        return $errorMsg;
    }
}

?>