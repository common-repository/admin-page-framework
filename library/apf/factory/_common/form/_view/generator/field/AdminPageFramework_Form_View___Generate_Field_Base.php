<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

abstract class AdminPageFramework_Form_View___Generate_Field_Base extends AdminPageFramework_Form_View___Generate_Section_Base {
    public $aArguments = array();
    protected function _isSectionSet()
    {
        return isset($this->aArguments[ 'section_id' ]) && $this->aArguments[ 'section_id' ] && '_default' !== $this->aArguments[ 'section_id' ];
    }
}
