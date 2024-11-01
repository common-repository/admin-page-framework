<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

abstract class AdminPageFramework_Controller extends AdminPageFramework_View {
    public function load()
    {}
    public function setUp()
    {}
    public function addHelpTab($aHelpTab)
    {
        $this->oHelpPane->_addHelpTab($aHelpTab);
    }
    public function enqueueStyles()
    {
        $_aParams = func_get_args() + array( array(), '', '', array() );
        return $this->oResource->_enqueueResourcesByType($_aParams[ 0 ], array( 'sPageSlug' => $_aParams[ 1 ], 'sTabSlug' => $_aParams[ 2 ], ) + $_aParams[ 3 ], 'style');
    }
    public function enqueueStyle()
    {
        $_aParams = func_get_args() + array( '', '', '', array() );
        return $this->oResource->_addEnqueuingResourceByType($_aParams[ 0 ], array( 'sPageSlug' => $_aParams[ 1 ], 'sTabSlug' => $_aParams[ 2 ], ) + $_aParams[ 3 ], 'style');
    }
    public function enqueueScripts()
    {
        $_aParams = func_get_args() + array( array(), '', '', array() );
        return $this->oResource->_enqueueResourcesByType($_aParams[ 0 ], array( 'sPageSlug' => $_aParams[ 1 ], 'sTabSlug' => $_aParams[ 2 ], ) + $_aParams[ 3 ], 'script');
    }
    public function enqueueScript()
    {
        $_aParams = func_get_args() + array( '', '', '', array() );
        return $this->oResource->_addEnqueuingResourceByType($_aParams[ 0 ], array( 'sPageSlug' => $_aParams[ 1 ], 'sTabSlug' => $_aParams[ 2 ], ) + $_aParams[ 3 ], 'script');
    }
    public function addLinkToPluginDescription($sTaggedLinkHTML1, $sTaggedLinkHTML2=null, $_and_more=null)
    {
        if ('plugins.php' !== $this->oProp->sPageNow) {
            return;
        }
        $this->oLink->_addLinkToPluginDescription(func_get_args());
    }
    public function addLinkToPluginTitle($sTaggedLinkHTML1, $sTaggedLinkHTML2=null, $_and_more=null)
    {
        if ('plugins.php' !== $this->oProp->sPageNow) {
            return;
        }
        $this->oLink->_addLinkToPluginTitle(func_get_args());
    }
    public function setPluginSettingsLinkLabel($sLabel)
    {
        $this->oProp->sLabelPluginSettingsLink = $sLabel;
    }
    public function setCapability($sCapability)
    {
        $this->oProp->sCapability = $sCapability;
        if (isset($this->oForm)) {
            $this->oForm->sCapability = $sCapability;
        }
    }
    public function setAdminNotice($sMessage, $sClassSelector='error', $sID='')
    {
        $sID = $sID ? $sID : md5($sMessage);
        $this->oProp->aAdminNotices[ $sID ] = array( 'sMessage' => $sMessage, 'aAttributes' => array( 'id' => $sID, 'class' => $sClassSelector ) );
        new AdminPageFramework_AdminNotice($this->oProp->aAdminNotices[ $sID ][ 'sMessage' ], $this->oProp->aAdminNotices[ $sID ][ 'aAttributes' ], array( 'should_show' => array( $this, 'isInThePage' ), ));
    }
    public function setDisallowedQueryKeys($asQueryKeys, $bAppend=true)
    {
        if (! $bAppend) {
            $this->oProp->aDisallowedQueryKeys = ( array ) $asQueryKeys;
            return;
        }
        $aNewQueryKeys = array_merge(( array ) $asQueryKeys, $this->oProp->aDisallowedQueryKeys);
        $aNewQueryKeys = array_filter($aNewQueryKeys);
        $aNewQueryKeys = array_unique($aNewQueryKeys);
        $this->oProp->aDisallowedQueryKeys = $aNewQueryKeys;
    }
    public static function getOption($sOptionKey, $asKey=null, $vDefault=null)
    {
        return AdminPageFramework_WPUtility::getOption($sOptionKey, $asKey, $vDefault);
    }
}
