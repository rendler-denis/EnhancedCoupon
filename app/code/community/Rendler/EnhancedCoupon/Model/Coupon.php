<?php
/**
 * Coupon Code Model
 *
 * @package    Rendler_EnhancedCoupon
 * @copyright  Copyright (c) Denis-Florin Rendler <http://www.denis.rendler.me>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v.3
 */

/**
 * Coupon code model class
 *
 * @category    Model
 * @package     Rendler_EnhancedCoupon
 * @author      Denis-Florin Rendler <magento@rendler.me>
 */
class Rendler_EnhancedCoupon_Model_Coupon
    extends Mage_SalesRule_Model_Coupon
{
    /**
     * Required fields for coupon
     *
     * @type array
     */
    protected $_requiredFields = array(
        'code'              => '',
        'uses_per_customer' => 0
    );

    /**
     * Update model values based on data sent from the form
     *
     * @param Varien_Object $data
     *
     * @return Rendler_EnhancedCoupon_Model_Coupon
     */
    public function updateModelFromForm($data = null)
    {
        if (null === $data) {
            return;
        }

        foreach ($this->_requiredFields as $field => $defaultValue) {
            $this->setData($field, $data->getDataSetDefault($field, $defaultValue));
            $data->unsetData($field);
        }

        if ($data->hasData('is_primary')) {
            $data->setIsPrimary(true);
        }

        $this->addData($data->getData());
    }
}