<?php
/*
Copyright (C) 2011, WebAndPeople.com
*/
?>
<?php
 class WP_AdvancedSlider_Block_Widget_Slider extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface{private $���=null;private static $����=array (WP_AdvancedSlider_Model_Source_Style::STYLE_STANDART=>"webandpeople/advancedslider/slider/standart.phtml",WP_AdvancedSlider_Model_Source_Style::STYLE_NICOLE=>"webandpeople/advancedslider/slider/nicole.phtml",WP_AdvancedSlider_Model_Source_Style::STYLE_KRISTA=>"webandpeople/advancedslider/slider/krista.phtml",WP_AdvancedSlider_Model_Source_Style::STYLE_XANDRA=>"webandpeople/advancedslider/slider/xandra.phtml",WP_AdvancedSlider_Model_Source_Style::STYLE_TRISHA=>"webandpeople/advancedslider/slider/trisha.phtml",);public function getOption($�����,$������){if (isset ($this->���[$�����])&& $this->���[$�����]!== '')$�������=$this->���[$�����];else $�������=$������;if (is_array($�������))$�������=json_encode($�������);return $�������;}public function getSlideOption(&$��������,$�����,$������=""){if (isset ($��������[chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(115)][$�����])&& $��������[chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(115)][$�����]!== '')$�������=$��������[chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(115)][$�����];else $�������=$������;return $�������;}protected function _toHtml(){$���������='';$����������=Mage::getModel(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115))->{"\x6c\x6f\x61\x64"}($this->{"\x67\x65\x74\x44\x61\x74\x61"}(chr(115).chr(108).chr(105).chr(100).chr(101).chr(114)));if (!$����������->{"\x67\x65\x74\x49\x64"}()|| $����������->{"\x67\x65\x74\x53\x74\x61\x74\x75\x73"}()!= WP_AdvancedSlider_Model_Source_Status::STATUS_ACTIVE)return $���������;$�����������=$����������->{"\x67\x65\x74\x53\x6c\x69\x64\x65\x73\x50\x6f\x73\x69\x74\x69\x6f\x6e"}(true);if (!count($�����������))return $���������;$������������=$����������->{"\x67\x65\x74\x53\x74\x79\x6c\x65"}();$�������������=self::$����[$������������];$this->{"\x73\x65\x74\x54\x65\x6d\x70\x6c\x61\x74\x65"}($�������������);$��������������=$����������->{"\x67\x65\x74\x57\x69\x64\x74\x68"}();$���������������=$����������->{"\x67\x65\x74\x48\x65\x69\x67\x68\x74"}();$����������������=$����������->{"\x67\x65\x74\x4c\x69\x6e\x6b\x54\x61\x72\x67\x65\x74"}();$�����������������=$this->{"\x67\x65\x74\x44\x61\x74\x61"}(chr(117).chr(110).chr(105).chr(113).chr(117).chr(101).chr(95).chr(105).chr(100).chr(95).chr(112).chr(114).chr(101).chr(102).chr(105).chr(120));$������������������=array ();$�������������������=Mage::getModel(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(115).chr(108).chr(105).chr(100).chr(101).chr(115));$��������������������=Mage::helper(chr(99).chr(109).chr(115))->{"\x67\x65\x74\x50\x61\x67\x65\x54\x65\x6d\x70\x6c\x61\x74\x65\x50\x72\x6f\x63\x65\x73\x73\x6f\x72"}();foreach ($����������� as $���������������������=>$����������������������){$�������������������=$�������������������->{"\x6c\x6f\x61\x64"}($���������������������);if ($�������������������->{"\x67\x65\x74\x49\x64"}()){$������������������[$���������������������][chr(105).chr(115).chr(73).chr(109).chr(97).chr(103).chr(101)]=($�������������������->{"\x67\x65\x74\x54\x79\x70\x65"}()== WP_AdvancedSlider_Model_Source_Type::TYPE_IMAGE);$������������������[$���������������������][chr(105).chr(115).chr(72).chr(116).chr(109).chr(108)]=($�������������������->{"\x67\x65\x74\x54\x79\x70\x65"}()== WP_AdvancedSlider_Model_Source_Type::TYPE_HTML);$������������������[$���������������������][chr(104).chr(116).chr(109).chr(108)]=trim($��������������������->{"\x66\x69\x6c\x74\x65\x72"}($�������������������->{"\x67\x65\x74\x48\x74\x6d\x6c"}()));$������������������[$���������������������][chr(105).chr(109).chr(97).chr(103).chr(101)]=$�������������������->{"\x67\x65\x74\x49\x6d\x61\x67\x65"}();$������������������[$���������������������][chr(116).chr(105).chr(116).chr(108).chr(101)]=trim($�������������������->{"\x67\x65\x74\x54\x69\x74\x6c\x65"}());$������������������[$���������������������][chr(108).chr(105).chr(110).chr(107)]=$�������������������->{"\x67\x65\x74\x4c\x69\x6e\x6b"}();$������������������[$���������������������][chr(108).chr(105).chr(110).chr(107).chr(84).chr(97).chr(114).chr(103).chr(101).chr(116)]=$����������������;$������������������[$���������������������][chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(115)]=unserialize($�������������������->{"\x67\x65\x74\x53\x74\x79\x6c\x65\x4f\x70\x74\x69\x6f\x6e\x73"}());}}if (!count($������������������))return $���������;$this->���=unserialize($����������->{"\x67\x65\x74\x53\x74\x79\x6c\x65\x4f\x70\x74\x69\x6f\x6e\x73"}());$this->{"\x61\x73\x73\x69\x67\x6e"}(chr(119).chr(105).chr(100).chr(116).chr(104),$��������������);$this->{"\x61\x73\x73\x69\x67\x6e"}(chr(104).chr(101).chr(105).chr(103).chr(104).chr(116),$���������������);$this->{"\x61\x73\x73\x69\x67\x6e"}(chr(108).chr(105).chr(115).chr(116),$������������������);$this->{"\x61\x73\x73\x69\x67\x6e"}(chr(105).chr(100),$�����������������);return parent::_toHtml();}}