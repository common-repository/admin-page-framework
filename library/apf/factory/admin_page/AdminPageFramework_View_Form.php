<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

abstract class AdminPageFramework_View_Form extends AdminPageFramework_Model_Form {
    public function _replyToGetSectionName()
    {
        $_aParams = func_get_args() + array( null, null, );
        $sNameAttribute = $_aParams[ 0 ];
        $aSectionset = $_aParams[ 1 ];
        $_aSectionPath = $aSectionset[ '_section_path_array' ];
        $_aDimensionalKeys = array( $this->oProp->sOptionKey );
        foreach ($_aSectionPath as $_sDimension) {
            $_aDimensionalKeys[] = '[' . $_sDimension . ']';
        }
        if (isset($aSectionset[ '_index' ])) {
            $_aDimensionalKeys[] = '[' . $aSectionset[ '_index' ] . ']';
        }
        return implode('', $_aDimensionalKeys);
    }
    public function _replyToGetFieldNameAttribute()
    {
        $_aParams = func_get_args() + array( null, null, );
        $sNameAttribute = $_aParams[ 0 ];
        $aFieldset = $_aParams[ 1 ];
        $_aDimensionalKeys = array( $this->oProp->sOptionKey );
        if ($this->isSectionSet($aFieldset)) {
            $_aSectionPath = $aFieldset[ '_section_path_array' ];
            foreach ($_aSectionPath as $_sDimension) {
                $_aDimensionalKeys[] = '[' . $_sDimension . ']';
            }
            if (isset($aFieldset[ '_section_index' ])) {
                $_aDimensionalKeys[] = '[' . $aFieldset[ '_section_index' ] . ']';
            }
        }
        foreach ($aFieldset[ '_field_path_array' ] as $_sPathPart) {
            $_aDimensionalKeys[] = '[' . $_sPathPart . ']';
        }
        return implode('', $_aDimensionalKeys);
    }
    public function _replyToGetFlatFieldName()
    {
        $_aParams = func_get_args() + array( null, null, );
        $sNameAttribute = $_aParams[ 0 ];
        $aFieldset = $_aParams[ 1 ];
        $_aDimensionalKeys = array( $this->oProp->sOptionKey );
        if ($this->isSectionSet($aFieldset)) {
            foreach ($aFieldset[ '_section_path_array' ] as $_sDimension) {
                $_aDimensionalKeys[] = $_sDimension;
            }
            if (isset($aFieldset[ '_section_index' ])) {
                $_aDimensionalKeys[] = $aFieldset[ '_section_index' ];
            }
        }
        $_aDimensionalKeys = array_merge($_aDimensionalKeys, $aFieldset[ '_field_path_array' ]);
        return implode('|', $_aDimensionalKeys);
    }
    public function _replyToGetInputNameAttribute()
    {
        $_aParams = func_get_args() + array( null, null, null );
        $sNameAttribute = $_aParams[ 0 ];
        $aField = $_aParams[ 1 ];
        $sKey = ( string ) $_aParams[ 2 ];
        $sKey = $this->oUtil->getAOrB('0' !== $sKey && empty($sKey), '', "[{$sKey}]");
        $_sNamePrefix = $this->_replyToGetFieldNameAttribute('', $aField);
        return $_sNamePrefix . $sKey;
    }
    public function _replyToGetFlatInputName()
    {
        $_aParams = func_get_args() + array( null, null, null );
        $sFlatNameAttribute = $_aParams[ 0 ];
        $aField = $_aParams[ 1 ];
        $_sKey = ( string ) $_aParams[ 2 ];
        $_sKey = $this->oUtil->getAOrB('0' !== $_sKey && empty($_sKey), '', "|" . $_sKey);
        return $this->_replyToGetFlatFieldName('', $aField) . $_sKey;
    }
}
