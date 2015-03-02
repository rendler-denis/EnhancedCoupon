<?php
/**
 * EnhancedCoupon Grid
 *
 * @package    Rendler_EnhancedCoupon
 * @copyright  Copyright (c) Denis-Florin Rendler <http://www.denis.rendler.me>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v.3
 */

/**
 * Coupon codes grid
 *
 * @category    Block
 * @package     Rendler_EnhancedCoupon
 * @author      Denis-Florin Rendler <magento@rendler.me>
 */
class Rendler_EnhancedCoupon_Block_Adminhtml_Promo_Quote_Edit_Tab_Coupons_Grid
    extends Mage_Adminhtml_Block_Promo_Quote_Edit_Tab_Coupons_Grid
{

    /**
     * Configure grid mass actions
     *
     * @return Mage_Adminhtml_Block_Promo_Quote_Edit_Tab_Coupons_Grid
     */
    protected function _prepareMassaction()
    {
        return parent::_prepareMassaction();
    }

    /**
     * Get row url
     *
     * @param $row
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/coupon_code/editCode', array('id' => $row->getId()));
    }
}
