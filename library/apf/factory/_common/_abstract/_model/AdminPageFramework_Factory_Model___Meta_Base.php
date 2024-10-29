<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

abstract class AdminPageFramework_Factory_Model___Meta_Base extends AdminPageFramework_FrameworkUtility {
    protected $osCallable = 'get_post_meta';
    public $iObjectID = 0;
    public $aFieldsets = array();
    public function __construct()
    {
        $_aParameters = func_get_args() + array( $this->iObjectID, $this->aFieldsets, );
        $this->iObjectID = absint($_aParameters[ 0 ]);
        $this->aFieldsets = $_aParameters[ 1 ];
    }
    public function get()
    {
        if (! $this->iObjectID) {
            return array();
        }
        return $this->_getSavedDataFromFieldsets($this->iObjectID, $this->aFieldsets);
    }
    private function _getSavedDataFromFieldsets($iObjectID, $aFieldsets)
    {
        $_aMetaKeys = $this->_getMetaKeys($iObjectID);
        $_aMetaData = array();
        foreach ($aFieldsets as $_sSectionID => $_aFieldsets) {
            if ('_default' == $_sSectionID) {
                foreach ($_aFieldsets as $_aFieldset) {
                    if (! in_array($_aFieldset[ 'field_id' ], $_aMetaKeys)) {
                        continue;
                    }
                    $_aMetaData[ $_aFieldset[ 'field_id' ] ] = call_user_func_array($this->osCallable, array( $iObjectID, $_aFieldset[ 'field_id' ], true ));
                }
            }
            if (! in_array($_sSectionID, $_aMetaKeys)) {
                continue;
            }
            $_aMetaData[ $_sSectionID ] = call_user_func_array($this->osCallable, array( $iObjectID, $_sSectionID, true ));
        }
        return $_aMetaData;
    }
    protected function _getMetaKeys($iObjectID)
    {
        return array_keys($this->getAsArray(call_user_func_array($this->osCallable, array( $iObjectID ))));
    }
}