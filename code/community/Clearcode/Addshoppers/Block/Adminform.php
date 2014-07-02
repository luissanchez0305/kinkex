<?php

class Clearcode_Addshoppers_Block_Adminform extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected $storeCode;
    
    /**
     *
     * @var Clearcode_Addshoppers_Helper_Config 
     */
    protected $config;

    const LOGIN_EXISTS = 'Login exists';
    const NOT_CREATED = 'Registration failed';
    const CREATED = 'Account created';
    const PASSWORD_TOO_SHORT = 'Password too short';
    const PASSWORD_WRONG = 'Password incorrect';
    const WRONG_CREDENTIAL = 'Login and/or password incorrect';
    const DOMAIN_BANNED = 'Domain banned';

    public static $ImportantMessages = array(
        self::LOGIN_EXISTS,
        self::NOT_CREATED,
        self::PASSWORD_TOO_SHORT,
        self::PASSWORD_WRONG,
        self::WRONG_CREDENTIAL,
        self::DOMAIN_BANNED,
    );

    protected function getCssSectionHtml()
    {
        $html = <<<HTML
<style type = "text/css">
td {vertical-align: middle;
height: 28px;
}
tr {vertical-align: middle;
}
div#config-twitter-button {
margin-top: 4px;
}
div#config-facebook-button {
margin-top: 8px;
}
div#config-google-button {
margin-top: 8px;
}
div#config-rss-button {
margin-top: 10px;
}
div.config-share-buttons {
float: left;
margin-right: 15px;
vertical-align: middle;
}
div.about {
font-size: 14px;
margin-top: 10px;
}
div.error-msg {
padding-top: 10px;
padding-bottom: 10px;
padding-left: 30px;
margin-bottom: 10px;
}
div.big-black {
font-family: Droid Serif;
font-size: 25px;
font-style: italic;
}
a {
font-family: Arial;
font-size: 12px;
}
</style>
HTML;
        return $html;
    }

    protected function getHeaderSectionHtml()
    {
        $msg = Mage::getSingleton('core/session')->getData('message');
        Mage::getSingleton('core/session')->setData('message', null);
        if(isset($msg['value']) && in_array($msg['value'], self::$ImportantMessages))
            $txt = "<div class=\"error-msg\">" . $msg['value'] . "</div>";
        else
            $txt = "";
        $html = <<<HTML
</form>
<div style="float: left; width: 100%">
    <div class="entry-edit" style="width: 33%; float: left">
    $txt
HTML;
        return $html;
    }

    protected function getPluginStatusSectionHtml()
    {
        $url = $this->getUrl('adminhtml/adminform/enable');
        $formKey = Mage::getSingleton('core/session')->getFormKey();
        $firstSelected = ($this->config->getEnabled()) ? "selected=\"selected\"" : "";
        $secondSelected = ($this->config->getEnabled()) ? "" : "selected=\"selected\"";

        $html = <<<HTML
        <form id="edit_form" name="edit_form" method="post" action="{$url}">
            <input name="form_key" type="hidden" value="{$formKey}" />
            <input name="store" type="hidden" value="{$this->storeCode}" />
            <h4 class="icon-head head-edit-form fieldset-legend">{$this->__('Plugin Status') }</h4>
            <fieldset id="my-fieldset">
                <table cellspacing="0" class="form-list">
                    <tr>
                        <td class="label">{$this->__('Enabled') } </td>
                        <td class="input-ele">
                            <select name="status[enabled]" width="40">
                                <option value="1" {$firstSelected}>Yes</option>
                                <option value="0" {$secondSelected}>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button>Save</button></td>
                    </tr> 
                </table>
            </fieldset>
        </form>
HTML;
        return $html;
    }

    protected function getLoginSectionHtml()
    {
        $url = $this->getUrl('adminhtml/adminform/login');
        $formKey = Mage::getSingleton('core/session')->getFormKey();
        $login = $this->config->getEmail();
        $password = $this->config->getPassword();

        $html = <<<HTML
                <form id="edit_form" name="edit_form" method="post" action="{$url}">
                    <input name="form_key" type="hidden" value="{$formKey}"/>
                    <input name="store" type="hidden" value="{$this->storeCode}" />
                    <h4 class="icon-head head-edit-form fieldset-legend">{$this->__('Login') }</h4>
                    <fieldset id="my-fieldset">
                        <table cellspacing="0" class="form-list">
                            <tr>
                                <td class="label">{$this->__('Email Address') } </td>
                                <td class="input-ele">
                                    <input class="input-text" name="login[login]" size="40" maxlength="32" value="{$login}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Password') }</td>
                                <td class="input-ele">
                                    <input type="password" class="input-text" name="login[password]" size="40" maxlength="128" value="{$password}"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button>Login</button></td>
                            </tr>    
                        </table>
                    </fieldset>
                </form>
HTML;
        return $html;
    }

    protected function getNewAccSectionHtml()
    {
        $url = $this->getUrl('adminhtml/adminform/register');
        $formKey = Mage::getSingleton('core/session')->getFormKey();
        $email = $this->config->getEmail();
        $pass = $this->config->getPassword();

        $html = <<<HTML
                <form id="edit_form" name="edit_form" method="post" action="{$url}">
                    <input name="form_key" type="hidden" value="{$formKey}" />
                    <input name="store" type="hidden" value="{$this->storeCode}" />
                    <h4 class="icon-head head-edit-form fieldset-legend">{$this->__('Create New Account') }</h4>
                    <fieldset id="my-fieldset">
                        <table cellspacing="0" class="form-list">
                            <tr>
                                <td class="label">{$this->__('Email Address') } </td>
                                <td class="input-ele">
                                    <input class="input-text" name="register[login]" size="40" maxlength="32" value="{$email}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Password') }</td>
                                <td class="input-ele">
                                    <input type="password" class="input-text" name="register[password]" size="40" maxlength="128" value="{$pass}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Confirm Password') }</td>
                                <td class="input-ele">
                                    <input type="password" class="input-text" name="register[cpassword]" size="40" maxlength="128" value="{$pass}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Category') } </td>
                                <td class="input-ele">
                                    <select name="register[category]" width="40">
                                        <option>Apparel & Clothing</option>
                                        <option>Arts & Antiques</option>
                                        <option>Automotive & Vehicles</option>
                                        <option>Collectibles</option>
                                        <option>Crafts & Hobbies</option>
                                        <option>Baby & Children</option>
                                        <option>Business & Industrial</option>
                                        <option>Cameras & Optics</option>
                                        <option>Electronics</option>
                                        <option>Entertainment & Media</option>
                                        <option>Food, Beverages, & Tobacco</option>
                                        <option>Furniture</option>
                                        <option>General Merchandise</option>
                                        <option>Gifts, Hardware</option>
                                        <option>Health & Beauty</option>
                                        <option>Holiday</option>
                                        <option>Home & Garden</option>
                                        <option>Jewelry</option>
                                        <option>Luggage & Bags</option>
                                        <option>Mature / Adult</option>
                                        <option>Music</option>
                                        <option>Novelty</option>
                                        <option>Office Supplies</option>
                                        <option>Pets & Animals</option>
                                        <option>Software</option>
                                        <option>Sporting Goods & Outdoors</option>
                                        <option>Toys & Games</option>
                                        <option>Travel</option>
                                        <option>Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Phone(optional)') } </td>
                                <td class="input-ele">
                                    <input class="input-text" name="register[phone]" size="40" maxlength="32"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button>Create Free Account</button></td>
                            </tr>    
                        </table>
                    </fieldset>
                </form>
HTML;
        return $html;
    }

    protected function getAccSettingsSectionHtml()
    {
        $url = $this->getUrl('adminhtml/adminform/settings');
        $formKey = Mage::getSingleton('core/session')->getFormKey();
        $email = $this->config->getEmail();
        $password = $this->config->getPassword();
        $apiKey = $this->config->getApiKey();
        $shopId = $this->config->getShopId();

        $html = <<<HTML
                <form id="edit_form" name="edit_form" method="post" action="{$url}">
                    <input name="form_key" type="hidden" value="{$formKey}" />
                    <input name="store" type="hidden" value="{$this->storeCode}" />
                    <h4 class="icon-head head-edit-form fieldset-legend">{$this->__('Account Settings') }</h4>
                    <fieldset id="my-fieldset">
                        <table cellspacing="0" class="form-list">
                            <tr>
                                <td class="label">{$this->__('Email Address') } </td>
                                <td class="input-ele">
                                    <input class="input-text" name="config[login]" size="40" maxlength="32" value="{$email}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Password') }</td>
                                <td class="input-ele">
                                    <input type="password" class="input-text" name="config[password]" size="40" maxlength="128" value="{$password}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('API Key') } </td>
                                <td class="input-ele">
                                    <input class="input-text" name="config[api_key]" size="40" maxlength="32" value="{$apiKey}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Shop ID') } </td>
                                <td class="input-ele">
                                    <input class="input-text" name="config[shop_id]" size="40" maxlength="32" value="{$shopId}"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button>Save</button></td>
                            </tr>    
                        </table>
                    </fieldset>
                </form>
HTML;
        return $html;
    }

    protected function getDefaultAppsSectionHtml()
    {
        $url = $this->getUrl('adminhtml/adminform/social');
        $formKey = Mage::getSingleton('core/session')->getFormKey();
        $schema = ($this->config->getSchemaEnabled() == '1') ? "checked" : "";
        $default = ($this->config->getSocialEnabled() == '1') ? "checked" : "";
        $fb = ($this->config->getOpenGraphEnabled() == '1') ? "checked" : "";

        $html = <<<HTML
                <form id="edit_form" name="edit_form" method="post" action="{$url}">
                    <input name="form_key" type="hidden" value="{$formKey}" />
                    <input name="store" type="hidden" value="{$this->storeCode}" />
                    <h4 class="icon-head head-edit-form fieldset-legend">{$this->__('Default Social Apps') }</h4>
                    <fieldset id="my-fieldset">
                        <table cellspacing="0" class="form-list">
                            <tr>
                                These Apps are designed to work with default theme. If you have another theme or would like further customizations, 
                            <a href="http://help.addshoppers.com/customer/portal/articles/692490--magento-installation-instructions" target="_blank">follow the instructions here</a>
                            .<br/><br/>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Use Product Schema for Data') } </td>
                                <td class="input-ele">
                                    <input type="checkbox" class="input-text" name="config[use_schema]" size="40" maxlength="32" {$schema}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Use Default Social Buttons') } </td>
                                <td class="input-ele">
                                    <input type="checkbox" class="input-text" name="config[social]" size="40" maxlength="32" {$default}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Use Facebook Open Graph buttons') } </td>
                                <td class="input-ele">
                                    <input type="checkbox" class="input-text" name="config[opengraph]" size="40" maxlength="32" {$fb}/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button>Save</button></td>
                            </tr>    
                        </table>
                    </fieldset>
                </form>
HTML;
        return $html;
    }

    protected function getPurchaseSharingSectionHtml()
    {
        $url = $this->getUrl('adminhtml/adminform/salesharing');
        $formKey = Mage::getSingleton('core/session')->getFormKey();
        $enabled = ($this->config->getSalesSharingEnabled() == '1') ? "checked" : "";
        $popupTitle = $this->config->getPopupTitle();
        $imageShare = $this->config->getShareImage();
        $urlShare = $this->config->getShareUrl();
        $titleShare = $this->config->getShareTitle();
        $descriptionShare = $this->config->getShareDescription();

        $disabled = ($enabled != "checked") ? 'disabled="disabled"' : "";

        $html = <<<HTML
                <form id="edit_form" name="edit_form" method="post" action="{$url}">
                    <input name="form_key" type="hidden" value="{$formKey}" />
                    <input name="store" type="hidden" value="{$this->storeCode}" />
                    <h4 class="icon-head head-edit-form fieldset-legend">{$this->__('Purchase Sharing') }</h4>
                    <fieldset id="my-fieldset">
                        <table cellspacing="0" class="form-list">
                            <tr>
                                <td class="label">{$this->__('Enable Purchase Sharing') } </td>
                                <td class="input-ele">
                                    <input id="sales_sharing_enable" onclick="toggleSharing();" type="checkbox" class="input-text" name="config[sales_sharing_enable]" size="40" maxlength="32" {$enabled}/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Sharing Popup Title') } </td>
                            </tr>
                            <tr>
                                <td class="input-ele" colspan="2">
                                    <input id='popup_title' type="text" class="input-text" name="config[popup_title]" size="70%" value="{$popupTitle}" $disabled/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Image to be shared') } </td>
                            </tr>
                            <tr>
                                <td class="input-ele" colspan="2">
                                    <input id='image_share' type="text" class="input-text" name="config[image_share]" size="70%" value="{$imageShare}" $disabled/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('URL to be shared') } </td>
                            </tr>
                            <tr>
                                <td class="input-ele" colspan="2">
                                    <input id="url_share" type="text" class="input-text" name="config[url_share]" size="70%" value="{$urlShare}" $disabled/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Share title') } </td>
                            </tr>
                            <tr>
                                <td class="input-ele" colspan="2">
                                    <input id="title_share" type="text" class="input-text" name="config[title_share]" size="70%" value="{$titleShare}" $disabled/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">{$this->__('Share description') } </td>
                            </tr>
                            <tr>
                                <td class="input-ele" colspan="2">
                                    <input id="description_share" type="text" class="input-text" name="config[description_share]" size="70%" value="{$descriptionShare}" $disabled/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button>Save</button></td>
                            </tr>    
                        </table>
                    </fieldset>
                </form>
HTML;
        return $html;
    }

    protected function getLogoutSectionHtml()
    {
        $url = $this->getUrl('adminhtml/adminform/reset');
        $formKey = Mage::getSingleton('core/session')->getFormKey();

        $html = <<<HTML
                <form id="edit_form" name="edit_form" method="post" action="{$url}">
                    <input name="form_key" type="hidden" value="{$formKey}" />
                    <input name="store" type="hidden" value="{$this->storeCode}" />
                    <h4 class="icon-head head-edit-form fieldset-legend">{$this->__('Logout') }</h4>
                    <fieldset id="my-fieldset">
                        <table cellspacing="0" class="form-list">
                            <tr>
                                <td>
                                <td class="label">{$this->__('Disconnect from AddShoppers') }</td></td>
                                <td><button>Logout</button></td>
                            </tr>    
                        </table>
                    </fieldset>
                </form>
HTML;
        return $html;
    }

    protected function getFollowSectionHtml()
    {
        $html = <<<HTML
        <h4 class="icon-head head-edit-form fieldset-legend">{$this->__('Follow us for updates on new features') }</h4>
        <fieldset id="my-fieldset">
            <div style="float: left; width: 100%;">
                    <div id="config-twitter-button" class="config-share-buttons">
                        <a href="https://twitter.com/addshoppers" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @addshoppers</a>
                    </div>
                    <div id="config-facebook-button" class="config-share-buttons">
                        <div class="fb-like" data-href="https://www.facebook.com/addshoppers" data-send="false" data-layout="button_count"></div>
                    </div>
                    <div id="config-google-button" class="config-share-buttons">
                        <div class="g-plusone" data-size="medium" data-href="//plus.google.com/112540297435892482797?rel=publisher"></div>
                    </div>
                    <div id="config-rss-button" class="config-share-buttons">
                        <a href="http://feeds.feedburner.com/addshoppers" rel="alternate" title="Subscribe to my feed" type="application/rss+xml">
                            <img alt="" src="http://www.feedburner.com/fb/images/pub/feed-icon16x16.png"/>
                        </a>
                    </div>
            </div>
        </fieldset>
HTML;
        return $html;
    }

    protected function getAboutSectionHtml()
    {
        $html = <<<HTML
    </div>
    <div  class="entry-edit" style="width: 65%; float: right">
        <h4 class="icon-head head-edit-form fieldset-legend">{$this->__('About AddShoppers') }</h4>
        <div class="feeds">
            <img src="{$this->getSkinUrl('clearcode_addshoppers/feeds.png') }">
        </div>
        <div>
            <div class="big-black">
                100's of button styles available to match your site's look & feel. Place social buttons anywhere.
                <a href="http://help.addshoppers.com/customer/portal/articles/692469-social-sharing-button-placement-examples" target="_blank">learn more</a>
            </div>
        </div>

        <div class="about">
            <h2>Need help?</h2>
            <span class="url"><a href="http://forums.addshoppers.com" target="_blank">eCommerce Forums</a></span>
            <span class="url"><a href="mailto:help@addshoppers.com">help@addshoppers.com</a></span>
            <span class="url"><a href="http://help.addshoppers.com" target="_blank">help.addshoppers.com</a></span>
        </div>

        <div class="about">
            <h2>Advanced integration instruction</h2>
            <p>To change button types or positioning on any theme:</p>

            <ol>
                <li>1. Login to your <a href="https://www.addshoppers.com/merchants" target="_blank">AddShoppers Merchant Admin</a>.</li>
                <li>2. From the left navigation, go to <i>Get Apps -> Sharing Buttons</i></li>
                <li>3. Select the button you want and copy the div code.</li>
                <li>4. Find file <i>view.phtml</i> in <i>design/frontend/TEMPLATE/default/template/catalog/product</i> where TEMPLATE is used template name e.g. 'base' or 'enterprise'.</li>
                <li>5. Paste our code where you want the buttons to appear.</li>
            </ol>
        </div>

        <div class="about">
            <h2>About AddShoppers</h2>
            AddShoppers is a free social sharing and analytics platform built for eCommerce.
            We make it easy to add social sharing buttons to your site, measure the ROI of social at
            the SKU level, and increase sharing by rewarding social actions. You'll discover the value
            of social sharing, identify influencers, and decrease shopping cart abandonment by adding
            AddShoppers social apps to your store.

            <div class="get-started">
                <a href="http://www.addshoppers.com" target="_blank">Get started with your free account at AddShoppers.com.</a>
            </div>
        </div>
        <div>
            <br/>If you're a large enterprise retailer who needs a more custom solution, <a href="http://www.addshoppers.com/enterprise" target="_blank">learn more</a>.
        </div>
        <div>
            <br/>By installing the AddShoppers module you agree to our <a href="http://www.addshoppers.com/terms">Terms</a> and <a href="http://www.addshoppers.com/privacy">Privacy Policy</a>.<br/>
        </div>
    </div>
</div>
HTML;
        return $html;
    }

    protected function getJavaScriptsHtml()
    {
        $html = <<<HTML
<script type="text/javascript">
    var editForm = new varienForm('edit_form');
</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
<script type="text/javascript">
    function toggleSharing() {
        if (document.getElementById('sales_sharing_enable').checked == true)
            var value = false;
        else
            var value = true;
         
        document.getElementById('popup_title').disabled = value;
        document.getElementById('image_share').disabled = value;
        document.getElementById('url_share').disabled = value;
        document.getElementById('title_share').disabled = value;
        document.getElementById('description_share').disabled = value;
    };
</script>
HTML;
        return $html;
    }

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $curStore = $this->getRequest()->getParam('store');

        $this->storeCode = (isset($curStore)) ? $curStore : '0';
        $this->config = new Clearcode_Addshoppers_Helper_Config($this->storeCode);

        $html = $this->getCssSectionHtml();
        $html .= $this->getHeaderSectionHtml();
        $html .= $this->getPluginStatusSectionHtml();
        if(($this->config->getEnabled() == 1)) {
            if(($this->config->getActive() != 1)) {
                $html .= $this->getLoginSectionHtml();
                $html .= $this->getNewAccSectionHtml();
            }
            else {
                $html .= $this->getAccSettingsSectionHtml();
                $html .= $this->getDefaultAppsSectionHtml();
                $html .= $this->getPurchaseSharingSectionHtml();
                $html .= $this->getLogoutSectionHtml();
            }
        }
        $html .= $this->getFollowSectionHtml();
        $html .= $this->getAboutSectionHtml();
        $html .= $this->getJavaScriptsHtml();
        return $html;
    }
}
