<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

abstract class AdminPageFramework_Widget_View extends AdminPageFramework_Widget_Model {
    public function content($sContent, $aArguments, $aFormData)
    {
        return $sContent;
    }
    public function _printWidgetForm()
    {
        echo $this->oForm->get();
    }
}
