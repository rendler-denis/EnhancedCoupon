<?php
/**
 * EnhancedCoupon Form
 *
 * @package    Rendler_EnhancedCoupon
 * @copyright  Copyright (c) Denis-Florin Rendler <http://www.denis.rendler.me>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v.3
 */

/**
 * Coupon code edit form
 *
 * @category    Block
 * @package     Rendler_EnhancedCoupon
 * @author      Denis-Florin Rendler <magento@rendler.me>
 */
class Rendler_EnhancedCoupon_Block_Adminhtml_Promo_Quote_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Preparing form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $helper = Mage::helper('enhanced_coupon');
        $model = Mage::registry('current_promo_quote_code');

        $form = new Varien_Data_Form([
            'id' => 'edit_form',
            'method' => 'post',
            'html_id_prefix' => 'coupon_'
        ]);

        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('code_info', [
            'legend' => $helper->__('Coupon Code Settings'),
            'class' => 'fieldset'
        ]);

        if ($model && $model->getId()) {
            $fieldset->addField('coupon_id', 'hidden', [
                'name' => 'coupon_id'
            ]);

            $form->setData('action',  $this->getUrl('*/*/save', array('id' => $model->getId())));
        }

        $fieldset->addField('code', 'text', [
            'name' => 'code',
            'label' => $helper->__('Coupon Code'),
            'required' => true
        ]);

        $fieldset->addField('usage_limit', 'text', [
            'name' => 'usage_limit',
            'label' => $helper->__('Uses Per Coupon'),
            'required' => true
        ]);

        $fieldset->addField('usage_per_customer', 'text', [
            'name' => 'usage_per_customer',
            'label' => $helper->__('Uses Per Customer'),
        ]);

        $dateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $fieldset->addField('expiration_date', 'date', array(
            'name'   => 'expiration_date',
            'label'  => $helper->__('Expiration Date'),
            'title'  => $helper->__('Expiration Date'),
            'image'  => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
            'format'       => $dateFormatIso
        ));

        $fieldset->addField('is_primary', 'checkbox', [
            'name' => 'is_primary',
            'label' => $helper->__('Is Code The Primary Code?'),
        ]);

        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}