<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

abstract class AdminPageFramework_Model_Page extends AdminPageFramework_Controller_Form {
    public function _replyToFinalizeInPageTabs()
    {
        if (! $this->oProp->isPageAdded()) {
            return;
        }
        foreach ($this->oProp->aPages as $_sPageSlug => $_aPage) {
            if (! isset($this->oProp->aInPageTabs[ $_sPageSlug ])) {
                continue;
            }
            $_oFormatter = new AdminPageFramework_Format_InPageTabs($this->oProp->aInPageTabs[ $_sPageSlug ], $_sPageSlug, $this);
            $this->oProp->aInPageTabs[ $_sPageSlug ] = $_oFormatter->get();
            $this->oProp->aDefaultInPageTabs[ $_sPageSlug ] = $this->_getDefaultInPageTab($_sPageSlug, $this->oProp->aInPageTabs[ $_sPageSlug ]);
        }
    }
    protected function _finalizeInPageTabs()
    {
        $this->_replyToFinalizeInPageTabs();
    }
    private function _getDefaultInPageTab($sPageSlug, $aInPageTabs)
    {
        foreach ($aInPageTabs as $_aInPageTab) {
            if (! isset($_aInPageTab[ 'tab_slug' ])) {
                continue;
            }
            return $_aInPageTab[ 'tab_slug' ];
        }
    }
    public function _getPageCapability($sPageSlug)
    {
        return $this->oUtil->getElement($this->oProp->aPages, array( $sPageSlug, 'capability' ));
    }
    public function _getInPageTabCapability($sTabSlug, $sPageSlug)
    {
        return $this->oUtil->getElement($this->oProp->aInPageTabs, array( $sPageSlug, $sTabSlug, 'capability' ));
    }
}
