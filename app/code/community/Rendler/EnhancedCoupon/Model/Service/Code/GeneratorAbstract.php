<?php
/**
 * Abstract Model Service
 *
 * @package    Rendler_EnhancedCoupon
 * @copyright  Copyright (c) Denis-Florin Rendler <http://www.denis.rendler.me>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v.3
 */

/**
 * Abstract Model Service Class
 *
 * @category    Model
 * @package     Rendler_EnhancedCoupon
 * @author      Denis-Florin Rendler <magento@rendler.me>
 */
abstract class Rendler_EnhancedCoupon_Model_Service_Code_GeneratorAbstract
    extends Varien_Object
{
    /**
     * Generate coupon code according to algorithm
     *
     * @return string
     *
     * @throw Exception
     */
    public abstract function generateCode();
}