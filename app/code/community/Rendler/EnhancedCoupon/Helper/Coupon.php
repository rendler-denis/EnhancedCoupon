<?php
/**
 * EnhancedCoupon Helper
 *
 * @package    Rendler_EnhancedCoupon
 * @copyright  Copyright (c) Denis-Florin Rendler <http://www.denis.rendler.me>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v.3
 */

/**
 * Coupon code helper class
 *
 * @category    Helper
 * @package     Rendler_EnhancedCoupon
 * @author      Denis-Florin Rendler <magento@rendler.me>
 */
class Rendler_EnhancedCoupon_Helper_Coupon
    extends Mage_SalesRule_Helper_Coupon
{

    /**
     * Config path for the pattern
     */
    const XML_PATH_SALES_RULE_COUPON_PATTERN = 'promo/auto_generated_coupon_codes/pattern';

    /**
     * Const for pattern
     */
    const COUPON_FORMAT_PATTERN = 'pattern';

    /**
     * Tokens constants
     */
    const TOKEN_UPPERCASE = '$';
    const TOKEN_LOWERCASE = '^';
    const TOKEN_DIGIT     = '#';

    /**
     * Retrieve the coupon code formats list including the new format
     *
     * @return array
     */
    public function getFormatsList()
    {
        $formats = parent::getFormatsList();

        $formats[self::COUPON_FORMAT_PATTERN] = $this->__('Pattern Expression');

        return $formats;
    }

    /**
     * Get default coupon code suffix
     *
     * @return string
     */
    public function getDefaultRegex()
    {
        return Mage::getStoreConfig(self::XML_PATH_SALES_RULE_COUPON_PATTERN);
    }

    /**
     * Retrieve the default Magento formats list
     *
     * @return array
     */
    public function getMageFormatsList()
    {
        return array_keys(parent::getFormatsList());
    }

    /**
     * Retrieve the string tokens
     *
     * @return array
     */
    public function getTokens()
    {
        return [self::TOKEN_LOWERCASE, self::TOKEN_UPPERCASE, self::TOKEN_DIGIT];
    }
}