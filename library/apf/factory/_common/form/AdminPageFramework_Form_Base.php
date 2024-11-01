<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

abstract class AdminPageFramework_Form_Base extends AdminPageFramework_Form_Utility {
    public $oSubmitNotice;
    public $oFieldError;
    public $oLastInputs;
    public static $_aResources = array( 'internal_styles' => array(), 'internal_styles_ie' => array(), 'internal_scripts' => array(), 'src_styles' => array(), 'src_scripts' => array(), 'register' => array( 'styles' => array(), 'scripts' => array(), ), );
    public $aCallbacks;
    public $aSectionsets;
    public $aFieldsets;
    public $oMsg;
    public function isSection($sID)
    {
        if ($this->isNumericInteger($sID)) {
            return false;
        }
        if (! array_key_exists($sID, $this->aSectionsets)) {
            return false;
        }
        if (! array_key_exists($sID, $this->aFieldsets)) {
            return false;
        }
        $_bIsSection = false;
        foreach ($this->aFieldsets as $_sSectionID => $_aFields) {
            if ($_sSectionID == $sID) {
                $_bIsSection = true;
            }
            if (array_key_exists($sID, $_aFields)) {
                return false;
            }
        }
        return $_bIsSection;
    }
    public function canUserView($sCapability)
    {
        if (! $sCapability) {
            return true;
        }
        return ( boolean ) current_user_can($sCapability);
    }
    public function isInThePage()
    {
        return $this->callBack($this->aCallbacks[ 'is_in_the_page' ], true);
    }
    public function __toString()
    {
        return $this->getObjectInfo($this);
    }
    public function replyToGetSelf()
    {
        return $this;
    }
}
