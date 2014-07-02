<?php
/**
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Block_Graph extends Mage_Catalog_Block_Product_Abstract {

    public function __construct() {

        parent::__construct();
        $this->setTemplate('aschroder_email/graph.phtml');
    }

}
