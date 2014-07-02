<?php

class Clearcode_Addshoppers_Adminhtml_AdminformController extends Mage_Adminhtml_Controller_Action
{
    /**
     * View form action
     */
    const REG_LOGIN_EXISTS = -1;
    const REG_ACCOUNT_NOT_CREATED = 0;
    const REG_ACCOUNT_CREATED = 1;
    const REG_PASSWORD_TOO_SHORT = 2;
    const REG_PASSWORD_CONSECUTIVE_CHARS = 8;
    const REG_PASSWORD_COMMON = 9;
    const REG_PARAM_MISSING = 10;
    const REG_DOMAIN_BANNED = 17;
    const REG_CATEGORY_INVALID = 19;
    const LOGIN_ACCOUNT_CREATED = 1;
    const LOGIN_MISSING_PARAMETER = 10;
    const LOGIN_WRONG_CREDENTIALS = 11;
    const LOGIN_SITE_EXISTS = 15;

    public $loginMessages = array(
        self::LOGIN_ACCOUNT_CREATED => 'Account authenticated successfuly',
        self::LOGIN_MISSING_PARAMETER => 'Please fill in all the fields',
        self::LOGIN_WRONG_CREDENTIALS => 'Wrong credentials',
        self::LOGIN_SITE_EXISTS => 'Site is already registered',
    );
    public $registrationMessages = array(
        self::REG_LOGIN_EXISTS => 'Login already exists',
        self::REG_ACCOUNT_NOT_CREATED => 'Account was not created due to unknown error',
        self::REG_ACCOUNT_CREATED => 'Account was successfuly created!',
        self::REG_PASSWORD_TOO_SHORT => 'Password is too short',
        self::REG_PASSWORD_CONSECUTIVE_CHARS => 'Password must consist of different characters',
        self::REG_PASSWORD_COMMON => 'Password is too weak',
        self::REG_PARAM_MISSING => 'Request was invalid',
        self::REG_DOMAIN_BANNED => 'Your domain is banned',
    );
    protected $api_url = 'http://api.addshoppers.com/1.0';
    protected $defaultShopId = '500975935b3a42793000002b';
    protected $defaultButtons = '<div class="share-buttons share-buttons-tab" data-buttons="twitter,facebook,pinterest" data-style="medium" data-counter="true" data-hover="true" data-promo-callout="true" data-float="left"></div>';
    //// '<div style="float:right;"><div class="share-buttons share-buttons-panel" data-style="medium" data-counter="true" data-oauth="true" data-hover="true" data-buttons="twitter,facebook,pinterest"></div></div><div class="share-buttons-multi"><div class="share-buttons share-buttons-fb-like" data-style="standard"></div><div class="share-buttons share-buttons-og" data-action="want" data-counter="false"></div><div class="share-buttons share-buttons-og" data-action="own" data-counter="false"></div></div>';
    protected $shopUrl;
    protected $shopName;
    protected $platform = "magento";

    protected function sendRequestWithBasicAuth($url, $data)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, 'addshop:addshop123');
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    function getButtonsCode($shopid, $apikey)
    {
        return array(
            'buttons' => array(
                'button1' => $this->defaultButtons,
                'button2' => $this->defaultButtons,
                'open-graph' => $this->defaultButtons,
            ),
        );
        
//        $data = "shopid=" . urlencode($shopid)
//            . "&key=" . urlencode($apikey);
//
//        $curl = curl_init($this->api_url . '/account/social-analytics/tracking-codes');
//        curl_setopt($curl, CURLOPT_POST, true);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        $result = curl_exec($curl);
//        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//        curl_close($curl);
//
//        return json_decode($result, true);
    }

    public function _beforeSave($object)
    {
        return $this;
    }

    public function indexAction()
    {
        $this->_redirect('/system_config/edit/section/addshoppers/');
    }

    public function gridAction()
    {
        $this->_registryObject();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('addshoppers/adminhtml_form_edit_tab_login')
                ->toHtml()
        );
    }

    public function registerAction()
    {
        $this->shopUrl = urlencode(Mage::app()->getStore()->getBaseUrl());
        $this->shopName = urlencode(Mage::app()->getStore()->getName());

        $params = $this->getRequest()->getParams();
        
        $config = new Clearcode_Addshoppers_Helper_Config($params['store']);

        if(!isset($params['register']['register']))
        {
            $data = "email=" . urlencode($params['register']['login'])
                . "&password=" . urlencode($params['register']['password'])
                . "&url=" . $this->shopUrl
                . "&category=" . urlencode($params['register']['category'])
                . "&platform=" . $this->platform
                . "&site_name=" . $this->shopName;

            if (isset($params['register']['phone']))
                $data .= "&phone=" . urlencode($params['register']['phone']);

            $return = $this->sendRequestWithBasicAuth($this->api_url . '/registration', $data);
        }
        // $this->getResponse()->setBody(var_dump($return));
        if(isset($params['register']['register']))
        {
            $return['result'] = 1;
        }
        if(($return['result'] == -1))
        {
            $message = Clearcode_Addshoppers_Block_Adminform::LOGIN_EXISTS;
        }
        elseif($return['result'] == 0)
        {
            $message = Clearcode_Addshoppers_Block_Adminform::NOT_CREATED;
        }
        elseif($return['result'] == 2)
        {
            $message = Clearcode_Addshoppers_Block_Adminform::PASSWORD_TOO_SHORT;
        }
        elseif($return['result'] == 8)
        {
            $message = Clearcode_Addshoppers_Block_Adminform::PASSWORD_WRONG;
        }
        elseif(($return['result'] == 1) || (isset($params['register']['register'])))
        {
            if(isset($params['configuration']['use_schema']))
            {
                $params['configuration']['use_schema'] = 1;
            }
            if(isset($params['configuration']['social']))
            {
                $params['configuration']['social'] = 1;
            }
            if(isset($params['configuration']['opengraph']))
            {
                $params['configuration']['opengraph'] = 1;
            }

            $config->setEnabled(1);
            $config->setSchemaEnabled($params['configuration']['social']);

            if(isset($params['register']['register']))
            {
                $data = "login=" . urlencode($params['register']['login'])
                    . "&password=" . urlencode($params['register']['password'])
                    . "&url=" . urlencode(Mage::app()->getStore()->getHomeUrl())
                    . "&category=" . urlencode($params['register']['category'])
                    . "&platform=" . $this->platform
                    . "&site_name=" . $this->shopName;
            if (isset($params['register']['phone']))
                $data .= "&phone=" . urlencode($params['register']['phone']);

                $return = $this->sendRequestWithBasicAuth($this->api_url . '/login', $data);
            }
            $config->setApiKey($return['api_key']);
            $buttons_codes = $this->getButtonsCode($return['shopid'], $return['api_key']);
            $buttons_code_html = '';
            if($params['configuration']['social'])
            {
                $buttons_code_html = '<div style="float:right;">' . $buttons_codes['buttons']['button2'] . '</div>';
            }
            if($params['configuration']['social'])
            {
                $buttons_code_html = $buttons_code_html . $buttons_codes['buttons']['open-graph'];
            }
            if($buttons_code_html == '')
            {
                $buttons_code_html = $buttons_codes['buttons']['button1'];
            }

            $config->setButtonsCode($buttons_code_html);
            $config->setActive(1);
            $config->setUrl($this->shopUrl);
            $config->setPlatform($params['register']['platform']);
            $config->setSocialEnabled(1);
            $config->setOpenGraphEnabled(1);
            $config->setEmail($params['register']['email']);
            $config->setPassword($params['register']['password']);
            $config->setCategory($params['register']['category']);
            $config->setShopId($return['shopid']);

            $message = Clearcode_Addshoppers_Block_Adminform::CREATED;
        }
        else
        {
            $message = 'Other except!';
        }

        Mage::getSingleton('core/session')->setData('message', array('value' => $message));
        
        Mage::app()->getCache()->clean();
        
        $this->redirectBack($params['store']);
    }

    public function socialAction()
    {
        $params = $this->getRequest()->getParams();
        $config = new Clearcode_Addshoppers_Helper_Config($params['store']);
        
        $social = (isset($params['config']['social'])) ? 1 : 0;
        $config->setSocialEnabled($social);
        $open = (isset($params['config']['opengraph'])) ? 1 : 0;
        $config->setOpenGraphEnabled($open);
        $schema = (isset($params['config']['use_schema'])) ? 1 : 0;
        $config->setSchemaEnabled($schema);
        
        Mage::app()->getCache()->clean();
        
        $this->redirectBack($params['store']);
    }
    
    public function salesharingAction()
    {
        $params = $this->getRequest()->getParams(); 
        $config = new Clearcode_Addshoppers_Helper_Config($params['store']);
        
        $enable = (isset($params['config']['sales_sharing_enable'])) ? 1 : 0;
        $config->setSalesSharingEnabled($enable);
        $config->setPopupTitle($params['config']['popup_title']);
        $config->setShareImage($params['config']['image_share']);
        $config->setShareUrl($params['config']['url_share']);
        $config->setShareTitle($params['config']['title_share']);
        $config->setShareDescription($params['config']['description_share']);
        
        Mage::app()->getCache()->clean();
        
        $this->redirectBack($params['store']);
    }

    public function settingsAction()
    {
        $params = $this->getRequest()->getParams();
        $config = new Clearcode_Addshoppers_Helper_Config($params['store']);
        $config->setEmail($params['config']['login']);
        $config->setPassword($params['config']['password']);
        $config->setShopId($params['config']['shop_id']);
        $config->setApiKey($params['config']['api_key']);
        
        Mage::app()->getCache()->clean();
        
        $this->redirectBack($params['store']);
    }

    public function loginAction()
    {
        $this->shopUrl = urlencode(Mage::app()->getStore()->getBaseUrl());
        $this->shopName = urlencode(Mage::app()->getStore()->getName());

        $params = $this->getRequest()->getParams();
        $config = new Clearcode_Addshoppers_Helper_Config($params['store']);

        if($config->getActive() != 1)
        {
            $config->setSocialEnabled(1);
            $params['configuration']['social'] = 1;
            $config->setOpenGraphEnabled(1);
            $params['configuration']['opengraph'] = 1;
            $config->setSchemaEnabled(1);
            $params['configuration']['use_schema'] = 1;
        }

        $data = "login=" . urlencode($params['login']['login'])
            . "&password=" . urlencode($params['login']['password'])
            . "&url=" . $this->shopUrl
            . "&category=Other"
            . "&phone=" . urlencode($config->getPhone())
            . "&platform=" . $this->platform
            . "&site_name=" . $this->shopName;

        $return = $this->sendRequestWithBasicAuth($this->api_url . '/login', $data);

        if($return['result'] == 17)
        {
            $message = Clearcode_Addshoppers_Block_Adminform::DOMAIN_BANNED;
        }
        elseif($return['result'] == 11)
        {
            $message = Clearcode_Addshoppers_Block_Adminform::WRONG_CREDENTIAL;
        }
        elseif(($return['result'] == 1) || ($return['result'] == 15) || ($return['result'] == 10))
        {

            if($return['result'] == 10)
            {
                if((isset($params['login']['login'])) && (isset($params['login']['password'])))
                {
                    $message = "LOGIN_MISSING_PARAMETER";
                    $data = "login=" . urlencode($params['login']['login'])
                        . "&password=" . urlencode($params['login']['password'])
                        . "&url=" . $this->shopUrl
                        . "&category=" . urlencode($config->getCategory())
                        . "&phone=" . urlencode($config->getPhone())
                        . "&platform=" . $this->platform
                        . "&site_name=" . $this->shopName;

                    $return = $this->sendRequestWithBasicAuth($this->api_url . '/login', $data);
                    // $this->getResponse()->setBody(var_dump($return));
                    if(!isset($return['shopid']))
                    {
                        $return['shopid'] = $config->getShopId();
                    }
                    if(!isset($return['api_key']))
                    {
                        $return['api_key'] = $config->getApiKey();
                    }
                    $buttons_codes = $this->getButtonsCode($return['shopid'], $return['api_key']);
                    $buttons_code_html = '';
                    if($params['configuration']['social'])
                    {
                        $buttons_code_html = '<div style="float:right;">' . $buttons_codes['buttons']['button2'] . '</div>';
                    }
                    if($params['configuration']['opengraph'])
                    {
                        $buttons_code_html = $buttons_code_html . $buttons_codes['buttons']['open-graph'];
                    }
                    if($buttons_code_html == '')
                    {
                        $buttons_code_html = $buttons_codes['buttons']['button1'];
                    }
                    if(!isset($buttons_codes['buttons']['button2']))
                    {
                        $config->setApiKey('9NF-HtmcFlwYOCOCpRJRwv6smHChiubg');
                        $buttons_code_html = '<div class="share-buttons share-buttons-panel" data-style="medium" data-counter="true" data-oauth="true" data-hover="true" data-buttons="twitter,facebook,pinterest"></div><div style="float:right;"><div class="share-buttons-multi"><div class="share-buttons share-buttons-fb-like" data-style="standard"></div><div class="share-buttons share-buttons-og" data-action="want" data-counter="false"></div><div class="share-buttons share-buttons-og" data-action="own" data-counter="false"></div></div></div>';
                    }
                    $config->setButtonsCode($buttons_code_html);
                    $config->setActive(1);
                    $config->setSocialEnabled($params['configuration']['social']);
                    $config->setOpenGraphEnabled($params['configuration']['opengraph']);
                    $config->setEmail($params['login']['login']);
                    $config->setPassword($params['login']['password']);
                    $config->setCategory($params['login']['category']);
                    $config->setShopId($return['shopid']);
                    $config->setApiKey($return['api_key']);
                    $config->setUrl($this->shopUrl);
                    
                    $this->redirectBack($params['store']);
                }
            }

            if(isset($params['configuration']['use_schema']))
            {
                $params['configuration']['use_schema'] = 1;
            }
            if(isset($params['configuration']['social']))
            {
                $params['configuration']['social'] = 1;
            }
            if(isset($params['configuration']['opengraph']))
            {
                $params['configuration']['opengraph'] = 1;
            }
            
            $config->setEnabled(1);
            $config->setSchemaEnabled($params['configuration']['use_schema']);
            $config->setApiKey($return['api_key']);

            $buttons_codes = $this->getButtonsCode($return['shopid'], $return['api_key']);
            $buttons_code_html = '';
            if($params['configuration']['social'])
            {
                $buttons_code_html = '<div style="float:right;">' . $buttons_codes['buttons']['button2'] . '</div>';
            }
            if($params['configuration']['opengraph'])
            {
                $buttons_code_html .= $buttons_codes['buttons']['open-graph'];
            }
            if($buttons_code_html == '')
            {
                $buttons_code_html = $buttons_codes['buttons']['button1'];
            }
            
            $config->setButtonsCode($buttons_code_html);
            $config->setActive(1);
            $config->setSocialEnabled($params['configuration']['social']);
            $config->setOpenGraphEnabled($params['configuration']['opengraph']);
            $config->setEmail($params['login']['login']);
            $config->setPassword($params['login']['password']);
            $config->setCategory('Other');
            $config->setShopId($return['shopid']);
            $config->setApiKey($return['api_key']);
            $config->setUrl($this->shopUrl);
                    
            $message = 'AUTHENTICATED';
        }
        else
        {
            $message = 'Unknown exception.';
        }

        Mage::getSingleton('core/session')->setData('message', array('value' => $message));
        
        Mage::app()->getCache()->clean();

        $this->redirectBack($params['store']);
    }

    public function resetAction()
    {
        $params = $this->getRequest()->getParams();
        $config = new Clearcode_Addshoppers_Helper_Config($params['store']);
        
        $config->setButtonsCode($this->defaultButtons);
        $config->setEnabled(1);
        $config->setActive(0);
        $config->setSocialEnabled(1);
        $config->setOpenGraphEnabled(1);
        $config->setEmail('');
        $config->setPassword('');
        $config->setCategory('');
        $config->setShopId($this->defaultShopId);
        $config->setApiKey('');
        $config->setUrl('');
        $config->setSchemaEnabled(1);
        $config->setPlatform('magento');
        
        Mage::app()->getCache()->clean();

        $this->redirectBack($params['store']);
    }

    public function enableAction()
    {
        $params = $this->getRequest()->getParams();
        $config = new Clearcode_Addshoppers_Helper_Config($params['store']);
        $config->setEnabled($params['status']['enabled']);
        
        Mage::app()->getCache()->clean();
        
        $this->redirectBack($params['store']);
    }

    protected function _registryObject()
    {
        Mage::register('clearcode_addshoppers', Mage::getModel('clearcode_addshoppers/form'));
    }
        
    protected function redirectBack($storeCode)
    {
        $this->_redirect('/system_config/edit/section/addshoppers/store/'. $storeCode);
    }
}
