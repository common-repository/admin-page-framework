<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

class AdminPageFramework_View__PageRenderer__InPageTabs extends AdminPageFramework_FrameworkUtility {
    public $oFactory;
    public $sPageSlug;
    public $sTag = 'h3';
    public function __construct($oFactory, $sPageSlug)
    {
        $this->oFactory = $oFactory;
        $this->sPageSlug = $sPageSlug;
        $this->sTag = $oFactory->oProp->sInPageTabTag ? $oFactory->oProp->sInPageTabTag : 'h3';
    }
    public function get()
    {
        $_aInPageTabs = $this->getElement($this->oFactory->oProp->aInPageTabs, $this->sPageSlug, array());
        if (empty($_aInPageTabs)) {
            return '';
        }
        return $this->_getOutput($_aInPageTabs, $this->sPageSlug, $this->sTag);
    }
    private function _getOutput($aInPageTabs, $sCurrentPageSlug, $sTag)
    {
        $_aPage = $this->oFactory->oProp->aPages[ $sCurrentPageSlug ];
        $_sCurrentTabSlug = $this->_getCurrentTabSlug($sCurrentPageSlug);
        $_sTag = $this->_getInPageTabTag($sTag, $_aPage);
        if (! $_aPage[ 'show_in_page_tabs' ]) {
            return $this->getElement($aInPageTabs, array( $_sCurrentTabSlug, 'title' )) ? "<{$_sTag} class='admin-page-framework-in-page-tab-title'>" . $aInPageTabs[ $_sCurrentTabSlug ][ 'title' ] . "</{$_sTag}>" : "";
        }
        return $this->_getInPageTabNavigationBar($aInPageTabs, $_sCurrentTabSlug, $sCurrentPageSlug, $_sTag);
    }
    private function _getInPageTabNavigationBar(array $aTabs, $sActiveTab, $sCurrentPageSlug, $sTag)
    {
        $_oTabBar = new AdminPageFramework_TabNavigationBar($aTabs, $sActiveTab, $sTag, array( 'class' => 'in-page-tab', ), array( 'format' => array( $this, '_replyToFormatNavigationTabItem_InPageTab' ), 'arguments' => array( 'page_slug' => $sCurrentPageSlug, ), ));
        $_sTabBar = $_oTabBar->get();
        return $_sTabBar ? "<div class='admin-page-framework-in-page-tab'>" . $_sTabBar . "</div>" : '';
    }
    public function _replyToFormatNavigationTabItem_InPageTab(array $aTab, array $aStructure, array $aTabs, array $aArguments=array())
    {
        $_oFormatter = new AdminPageFramework_Format_NavigationTab_InPageTab($aTab, $aStructure, $aTabs, $aArguments, $this->oFactory);
        return $_oFormatter->get();
    }
    private function _getInPageTabTag($sTag, array $aPage)
    {
        return tag_escape($aPage[ 'in_page_tab_tag' ] ? $aPage[ 'in_page_tab_tag' ] : $sTag);
    }
    private function _getCurrentTabSlug($sCurrentPageSlug)
    {
        return $this->_getParentTabSlug($sCurrentPageSlug, $this->getHTTPQueryGET('tab', $this->oFactory->oProp->getDefaultInPageTab($sCurrentPageSlug)));
    }
    private function _getParentTabSlug($sPageSlug, $sTabSlug)
    {
        $_sParentTabSlug = $this->getElement($this->oFactory->oProp->aInPageTabs, array( $sPageSlug, $sTabSlug, 'parent_tab_slug' ), $sTabSlug);
        return isset($this->oFactory->oProp->aInPageTabs[ $sPageSlug ][ $_sParentTabSlug ][ 'show_in_page_tab' ]) && $this->oFactory->oProp->aInPageTabs[ $sPageSlug ][ $_sParentTabSlug ][ 'show_in_page_tab' ] ? $_sParentTabSlug : $sTabSlug;
    }
}
