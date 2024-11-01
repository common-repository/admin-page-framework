<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

class AdminPageFramework_ExportOptions extends AdminPageFramework_CustomSubmitFields {
    public $sClassName;
    public $sFileName;
    public $sFormatType;
    public $bIsDataSet;
    public function __construct($aPostExport, $sClassName)
    {
        parent::__construct($aPostExport);
        $this->sClassName = $sClassName;
        $this->sFileName = $this->getSubmitValueByType($aPostExport, $this->sInputID, 'file_name');
        $this->sFormatType = $this->getSubmitValueByType($aPostExport, $this->sInputID, 'format');
        $this->bIsDataSet = $this->getSubmitValueByType($aPostExport, $this->sInputID, 'transient');
    }
    public function getTransientIfSet($vData)
    {
        if ($this->bIsDataSet) {
            $_tmp = $this->getTransient(md5("{$this->sClassName}_{$this->sInputID}"));
            if ($_tmp !== false) {
                $vData = $_tmp;
            }
        }
        return $vData;
    }
    public function getFileName()
    {
        return $this->sFileName;
    }
    public function getFormat()
    {
        return $this->sFormatType;
    }
    public function doExport($vData, $sFormatType=null, array $aHeader=array())
    {
        $sFormatType = isset($sFormatType) ? $sFormatType : $this->sFormatType;
        $this->_outputHTTPHeader($aHeader);
        $this->_outputDataByType($vData, $sFormatType);
        exit;
    }
    private function _outputHTTPHeader(array $aHeader, $sKey='')
    {
        foreach ($aHeader as $_sKey => $_asValue) {
            if (is_array($_asValue)) {
                $this->_outputHTTPHeader($_asValue, $_sKey);
                continue;
            }
            $_sKey = $this->getAOrB($sKey, $sKey, $_sKey);
            header("{$_sKey}: {$_asValue}");
        }
    }
    private function _outputDataByType($vData, $sFormatType)
    {
        switch (strtolower($sFormatType)) { case 'text': if (in_array(gettype($vData), array( 'array', 'object' ))) {
            echo AdminPageFramework_Debug::get($vData, null, false);
        } echo $vData; return; case 'json': echo json_encode(( array ) $vData); return ; case 'array': default: echo serialize(( array ) $vData); return; }
    }
}
