<?php
/**
 * EnhancedCoupon Form Container
 *
 * @package    Rendler_EnhancedCoupon
 * @copyright  Copyright (c) Denis-Florin Rendler <http://www.denis.rendler.me>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v.3
 */

/**
 * Coupon code edit form container
 *
 * @category    Block
 * @package     Rendler_EnhancedCoupon
 * @author      Denis-Florin Rendler <magento@rendler.me>
 */
class Rendler_EnhancedCoupon_Block_Adminhtml_Promo_Quote_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_blockGroup = 'enhanced_coupon';
        $this->_controller = 'adminhtml_promo_quote';

        parent::__construct();
    }

    /**
     * Getter for form header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        $couponCode = Mage::registry('current_promo_quote_code');
        if ($couponCode && $couponCode->getRuleId()) {
            return Mage::helper('enhanced_coupon')
                ->__("Edit Coupon Code '%s'", $this->escapeHtml($couponCode->getName()));
        }
        else {
            return Mage::helper('enhanced_coupon')
                ->__('Edit Coupon Code');
        }
    }
}