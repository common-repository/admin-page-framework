<?php
/**
 * Admin Page Framework - Demo
 *
 * Demonstrates the usage of Admin Page Framework.
 *
 * http://admin-page-framework.michaeluno.jp/
 * Copyright (c) 2013-2022, Michael Uno; Licensed GPLv2
 *
 */

/**
 * Adds a section in a tab.
 *
 * @package     AdminPageFramework/Example
 */
class APF_Demo_AdvancedUsage_Section_Collapsible_A {

    /**
     * The page slug to add the tab and form elements.
     */
    public $sPageSlug   = 'apf_advanced_usage';

    /**
     * The tab slug to add to the page.
     */
    public $sTabSlug    = 'sections';

    /**
     * The section slug to add to the tab.
     */
    public $sSectionID  = 'collapsible_section_a';

    /**
     * Sets up a form section.
     */
    public function __construct( $oFactory ) {

        // Section
        $oFactory->addSettingSections(
            $this->sPageSlug, // the target page slug
            array(
                'section_id'        => $this->sSectionID,
                'tab_slug'          => $this->sTabSlug,
                'title'             => __( 'Collapsible Section A', 'admin-page-framework-loader' ),
                'description'       => __( 'This section can be expanded and collapsed.', 'admin-page-framework-loader' ),
                'collapsible'       => array(
                    'toggle_all_button' => 'top-right',
                ),
            )
        );

        // Fields
        $oFactory->addSettingFields(
            $this->sSectionID, // the target section ID
            array(
                'field_id'      => 'text_field_in_collapsible_section',
                'title'         => __( 'Text', 'admin-page-framework-loader' ),
                'type'          => 'text',
                'repeatable'    => true,
                'sortable'      => true,
            )
        );

    }

}
