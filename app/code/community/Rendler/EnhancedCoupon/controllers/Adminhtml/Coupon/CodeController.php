<?php
/**
 * EnhancedCoupon Controller
 *
 * @package    Rendler_EnhancedCoupon
 * @copyright  Copyright (c) Denis-Florin Rendler <http://www.denis.rendler.me>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v.3
 */

/**
 * Coupon code edit form
 *
 * @category    Controllers
 * @package     Rendler_EnhancedCoupon
 * @author      Denis-Florin Rendler <magento@rendler.me>
 */
class Rendler_EnhancedCoupon_Adminhtml_Coupon_CodeController
    extends Mage_Adminhtml_Controller_Action
{

    /**
     * View form action
     */
    public function editCodeAction()
    {
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            $code = Mage::getModel('salesrule/coupon')->load($id);

            if (!$code || !$code->getId()) {
                $this->_setRedirect('This coupon code no longer exists.');

                return;
            }
        }

        Mage::register('current_promo_quote_code' , $code);

        $this->loadLayout();
        $this->_setActiveMenu('promo');
        $this->renderLayout();
    }

    /**
     * Save the coupon code
     */
    public function saveAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_setRedirect('There was a problem saving the coupon code!');

            return;
        }

        $formData = new Varien_Object($this->getRequest()->getPost());
        $couponId = $this->getRequest()->getParam('id');

        if (!$couponId || $formData->isEmpty()) {
            $this->_setRedirect('No coupon code data was provided!');

            return;
        }

        $model = Mage::getModel('salesrule/coupon')->load($couponId);
        try {
            $model->updateModelFromForm($formData);
            $model->save();

            $this->_redirect('*/*/');

            return;
        }catch (Exception $exc) {
            $this->_getSession()->addError($exc->getMessage());
            $id = (int)$this->getRequest()->getParam('rule_id');

            if (!empty($id)) {
                $this->_redirect('*/*/edit', array('id' => $id));
            }

            return;
        }
    }

    /**
     * Setup a redirect
     *
     * @param string $message
     * @param string $url
     */
    protected function _setRedirect($message, $url = '*/*')
    {
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('enhanced_coupon')->__($message)
        );
        $this->_redirect($url);
    }
}