<?php
/**
 * EnhancedCoupon Observer
 *
 * @package    Rendler_EnhancedCoupon
 * @copyright  Copyright (c) Denis-Florin Rendler <http://www.denis.rendler.me>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v.3
 */

/**
 * Observer class
 *
 * @category    Model
 * @package     Rendler_EnhancedCoupon
 * @author      Denis-Florin Rendler <magento@rendler.me>
 */
class Rendler_EnhancedCoupon_Model_Coupon_Form_Observer
{
    /**
     * Add Pattern Functionality To The Coupon Generator
     *
     * @param Varien_Event_Observer $observer
     */
    public function enhanceCouponGenerator(Varien_Event_Observer $observer)
    {
        $form         = $observer->getForm();
        $formParent   = $form->getParent();
        $fieldset     = $form->getElement('information_fieldset');
        $couponFormat = $form->getElement('format');
        $dash         = $form->getElement('dash');
        $length       = $form->getElement('length');
        $couponHelper = Mage::helper('salesrule/coupon');

        $pattern = $fieldset->addField(
            'pattern_rule',
            'text',
            array(
                'name'     => Rendler_EnhancedCoupon_Helper_Coupon::COUPON_FORMAT_PATTERN,
                'label'    => Mage::helper('enhanced_coupon')->__('Code Pattern'),
                'title'    => Mage::helper('enhanced_coupon')->__('Code Pattern'),
                'note'     => Mage::helper('enhanced_coupon')->__(
                    'Pattern used to generate new coupon code.<br />'
                    . '<b>$</b> - upper case letter, <b>#</b> - digit<br />'
                    . 'E.g.: PROMO-$$#$ will result in PROMO-AB1Z'
                ),
                'required' => true,
                'value'    => $couponHelper->getDefaultRegex(),
            ),
            'format'
        );

        $formParent->setChild(
            'form_after',
            $formParent->getLayout()->createBlock('adminhtml/widget_form_element_dependence')
                ->addFieldMap($couponFormat->getHtmlId(), $couponFormat->getName())
                ->addFieldMap($pattern->getHtmlId(), $pattern->getName())
                ->addFieldMap($dash->getHtmlId(), $dash->getName())
                ->addFieldMap($length->getHtmlId(), $length->getName())
                ->addFieldDependence(
                    $pattern->getName(),
                    $couponFormat->getName(),
                    Rendler_EnhancedCoupon_Helper_Coupon::COUPON_FORMAT_PATTERN
                )
                ->addFieldDependence(
                    $dash->getName(), $couponFormat->getName(), $couponHelper->getMageFormatsList()
                )
                ->addFieldDependence(
                    $length->getName(), $couponFormat->getName(), $couponHelper->getMageFormatsList()
                )
        );
    }
}