<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class ht_manufacturer_title extends abstract_executable_module {

    const CONFIG_KEY_BASE = 'MODULE_HEADER_TAGS_MANUFACTURER_TITLE_';

    public function __construct() {
      parent::__construct(__FILE__);
    }

    function execute() {
      global $PHP_SELF, $oscTemplate, $brand;

      if (basename($PHP_SELF) == 'index.php') {
        if (isset($_GET['manufacturers_id']) && is_numeric($_GET['manufacturers_id'])) {
          $brand_seo_title = $brand->getData('manufacturers_seo_title');
          $brand_name      = $brand->getData('manufacturers_name');

          if ( tep_not_null($brand_seo_title) && (MODULE_HEADER_TAGS_MANUFACTURER_TITLE_SEO_TITLE_OVERRIDE == 'True') ) {
            $oscTemplate->setTitle($brand_seo_title . MODULE_HEADER_TAGS_MANUFACTURER_SEO_SEPARATOR . $oscTemplate->getTitle());
          } else {
            $oscTemplate->setTitle($brand_name . MODULE_HEADER_TAGS_MANUFACTURER_SEO_SEPARATOR . $oscTemplate->getTitle());
          }
        }
      }
    }

    protected function get_parameters() {
      return [
        $this->config_key_base . 'STATUS' => [
          'title' => 'Enable Manufacturer Title Module',
          'value' => 'True',
          'desc' => 'Do you want to allow manufacturer titles to be added to the page title?',
          'set_func' => "tep_cfg_select_option(['True', 'False'], ",
        ],
        $this->config_key_base . 'SORT_ORDER' => [
          'title' => 'Sort Order',
          'value' => '0',
          'desc' => 'Sort order of display. Lowest is displayed first.',
        ],
        $this->config_key_base . 'SEO_TITLE_OVERRIDE' => [
          'title' => 'SEO Title Override?',
          'value' => 'True',
          'desc' => 'Do you want to allow manufacturer names to be over-ridden by your SEO Titles (if set)?',
          'set_func' => "tep_cfg_select_option(['True', 'False'], ",
        ],
      ];
    }

  }
