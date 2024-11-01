<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

class AdminPageFramework_Form_View___FieldTitle extends AdminPageFramework_Form_Utility {
    public $aFieldset = array();
    public $aClassSelectors = array();
    public $aSavedData = array();
    public $aFieldErrors = array();
    public $aFieldTypeDefinitions = array();
    public $aCallbacks = array();
    public $oMsg = array();
    public function __construct()
    {
        $_aParameters = func_get_args() + array( $this->aFieldset, $this->aClassSelectors, $this->aSavedData, $this->aFieldErrors, $this->aFieldTypeDefinitions, $this->aCallbacks, $this->oMsg );
        $this->aFieldset = $_aParameters[ 0 ];
        $this->aClassSelectors = $_aParameters[ 1 ];
        $this->aSavedData = $_aParameters[ 2 ];
        $this->aFieldErrors = $_aParameters[ 3 ];
        $this->aFieldTypeDefinitions = $_aParameters[ 4 ];
        $this->aCallbacks = $_aParameters[ 5 ];
        $this->oMsg = $_aParameters[ 6 ];
    }
    public function get()
    {
        $_sOutput = '';
        $aField = $this->aFieldset;
        if (! $aField[ 'show_title_column' ]) {
            return '';
        }
        $_oInputTagIDGenerator = new AdminPageFramework_Form_View___Generate_FieldInputID($aField, 0);
        $_aLabelAttributes = array( 'class' => $this->getClassAttribute('admin-page-framework-field-title', $this->aClassSelectors), 'for' => $_oInputTagIDGenerator->get(), );
        $_sOutput .= $aField[ 'title' ] ? "<label " . $this->getAttributes($_aLabelAttributes) . "'>" . "<a id='{$aField[ 'field_id' ]}'></a>" . "<span title='" . esc_attr(strip_tags(is_array($aField[ 'description' ]) ? implode('&#10;', $aField[ 'description' ]) : $aField[ 'description' ])) . "'>" . $aField[ 'title' ] . $this->_getTitleColon($aField) . "</span>" . $this->___getToolTip($aField[ 'tip' ], $aField[ 'field_id' ]) . "</label>" : '';
        $_sOutput .= $this->_getFieldOutputsInFieldTitleAreaFromNestedFields($aField);
        return $_sOutput;
    }
    private function _getFieldOutputsInFieldTitleAreaFromNestedFields($aField)
    {
        if (! $this->hasNestedFields($aField)) {
            return '';
        }
        $_sOutput = '';
        foreach ($aField[ 'content' ] as $_aNestedField) {
            if ('field_title' !== $_aNestedField[ 'placement' ]) {
                continue;
            }
            $_oFieldset = new AdminPageFramework_Form_View___Fieldset($_aNestedField, $this->aSavedData, $this->aFieldErrors, $this->aFieldTypeDefinitions, $this->oMsg, $this->aCallbacks);
            $_sOutput .= $_oFieldset->get();
        }
        return $_sOutput;
    }
    private function ___getToolTip($asTip, $sElementID)
    {
        $_oToolTip = new AdminPageFramework_Form_View___ToolTip($asTip, $sElementID);
        return $_oToolTip->get();
    }
    private function _getTitleColon($aField)
    {
        if (! isset($aField[ 'title' ]) || '' === $aField[ 'title' ]) {
            return '';
        }
        if (in_array($aField[ '_structure_type' ], array( 'widget', 'post_meta_box', 'page_meta_box' ))) {
            return "<span class='title-colon'>:</span>" ;
        }
    }
}
