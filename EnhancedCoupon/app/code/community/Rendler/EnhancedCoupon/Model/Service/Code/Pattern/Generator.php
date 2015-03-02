<?php
/**
 * Service Class
 *
 * @package    Rendler_EnhancedCoupon
 * @copyright  Copyright (c) Denis-Florin Rendler <http://www.denis.rendler.me>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v.3
 */

/**
 * Model Service Class
 *
 * @category    Model
 * @package     Rendler_EnhancedCoupon
 * @author      Denis-Florin Rendler <magento@rendler.me>
 */
class Rendler_EnhancedCoupon_Model_Service_Code_Pattern_Generator
    extends Rendler_EnhancedCoupon_Model_Service_Code_GeneratorAbstract
{
    /**
     * Generate a code based on the pattern set
     *
     * @param \Varien_Object $formData
     *
     * @return string
     * @throws \Exception
     */
    public function generateCode(Varien_Object $formData = null)
    {
        if (null === $formData) {
            throw new Exception('');
        }

        $pattern     = $formData->getPattern();
        $tokens      = Mage::helper('salesrule/coupon')->getTokens();
        $tokensRegex = vsprintf('/\%s+|\%s+|\%s+/', $tokens);
        $charset     = $this->getCharsets($tokens, $formData->getFormat());
        $tokensFound = preg_grep($tokensRegex, str_split($pattern));

        $code = str_split($pattern);

        foreach ($tokensFound as $tokenPosition => $token) {
            $code[$tokenPosition] = $charset[$token][mt_rand(0, count($charset[$token]) - 1)];
        }

        return $formData->getPrefix() . implode('', $code) . $formData->getSuffix();
    }

    /**
     * Get the available charset
     *
     * @param array  $tokens
     * @param string $format
     *
     * @return array
     */
    protected function getCharsets($tokens = array(), $format = null)
    {
        $charset = array_combine($tokens,
            explode('-', Mage::app()->getConfig()->getNode(sprintf(Mage_SalesRule_Helper_Coupon::XML_CHARSET_NODE, $format)))
        );

        foreach ($charset as &$set) {
            $set = str_split($set);
        }

        return $charset;
    }
}