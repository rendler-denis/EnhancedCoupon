<?php
/**
 * EnhancedCoupon Massgenerator Override
 *
 * @package    Rendler_EnhancedCoupon
 * @copyright  Copyright (c) Denis-Florin Rendler <http://www.denis.rendler.me>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v.3
 */

/**
 * Model Helper Class
 *
 * @category    Model
 * @package     Rendler_EnhancedCoupon
 * @author      Denis-Florin Rendler <magento@rendler.me>
 */
class Rendler_EnhancedCoupon_Model_Coupon_Massgenerator
    extends Mage_SalesRule_Model_Coupon_Massgenerator
{
    /**
     * Generate a code based on pattern
     *
     * @return string
     */
    public function generateCode()
    {
        switch($this->getFormat()) {
            case Rendler_EnhancedCoupon_Helper_Coupon::COUPON_FORMAT_PATTERN:
                $code = Mage::getModel('enhanced_coupon/service_code_pattern_generator')
                    ->generateCode(new Varien_Object($this->getData()));
                break;

            default:
                $code = parent::generateCode();
        }

        return $code;
    }

    /**
     * Validate the data from the form
     *
     * @param array $data
     *
     * @return bool
     */
    public function validateData($data)
    {
        switch($this->getFormat()) {
            case Rendler_EnhancedCoupon_Helper_Coupon::COUPON_FORMAT_PATTERN:
                $valid = !empty($data) && !empty($data['qty']) && !empty($data['rule_id'])
                    && !empty($data['format']) && (int)$data['qty'] > 0 && (int) $data['rule_id'] > 0;
                break;

            default:
                $valid = parent::generateCode();
        }

        return $valid;
    }
}