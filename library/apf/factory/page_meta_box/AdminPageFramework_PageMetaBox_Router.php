<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

abstract class AdminPageFramework_PageMetaBox_Router extends AdminPageFramework_MetaBox_View {
    protected $oResource;
    protected function _isInstantiatable()
    {
        if ($this->_isWordPressCoreAjaxRequest()) {
            return false;
        }
        return true;
    }
    protected function _isInThePage()
    {
        if (! $this->oProp->bIsAdmin) {
            return false;
        }
        $_sPageSlug = $this->oUtil->getElement($this->oProp->aQuery, array( 'page' ), '');
        if (! $this->___isAddedPage($_sPageSlug)) {
            return false;
        }
        return true;
    }
    private function ___isAddedPage($sPageSlug)
    {
        if (! $this->oUtil->isAssociative($this->oProp->aPageSlugs)) {
            return in_array($sPageSlug, $this->oProp->aPageSlugs, true);
        }
        return in_array($sPageSlug, array_keys($this->oProp->aPageSlugs), true);
    }
    protected function _isValidAjaxReferrer()
    {
        return true;
    }
}
