<?php
/*
Copyright (C) 2011, WebAndPeople.com
*/
?>
<?php
 class WP_AdvancedSlider_Block_Adminhtml_Sliders_Edit_Tab_General extends Mage_Adminhtml_Block_Widget_Container{public function __construct(){parent::__construct();$this->{"\x73\x65\x74\x54\x65\x6d\x70\x6c\x61\x74\x65"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(46).chr(112).chr(104).chr(116).chr(109).chr(108));}public function getSliderId(){return $this->{"\x5f\x67\x65\x74\x53\x6c\x69\x64\x65\x72"}()->{"\x67\x65\x74\x49\x64"}();}public function _getOldStyle(){return Mage::registry(chr(115).chr(116).chr(121).chr(108).chr(101));}protected function _getSlider(){return Mage::registry(chr(115).chr(108).chr(105).chr(100).chr(101).chr(114));}protected function _prepareLayout(){$   =$this->{"\x67\x65\x74\x53\x6c\x69\x64\x65\x72\x49\x64"}();$    =$this->{"\x67\x65\x74\x4c\x61\x79\x6f\x75\x74"}();$this->{"\x73\x65\x74\x43\x68\x69\x6c\x64"}(chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108),$    ->{"\x63\x72\x65\x61\x74\x65\x42\x6c\x6f\x63\x6b"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(97).chr(100).chr(109).chr(105).chr(110).chr(104).chr(116).chr(109).chr(108).chr(95).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115).chr(95).chr(101).chr(100).chr(105).chr(116).chr(95).chr(116).chr(97).chr(98).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(95).chr(102).chr(111).chr(114).chr(109)));$     =$this->{"\x5f\x67\x65\x74\x53\x6c\x69\x64\x65\x72"}()->{"\x67\x65\x74\x53\x74\x79\x6c\x65"}();if (!$     )$     =WP_AdvancedSlider_Model_Source_Style::STYLE_STANDART;$      =unserialize($this->{"\x5f\x67\x65\x74\x53\x6c\x69\x64\x65\x72"}()->{"\x67\x65\x74\x53\x74\x79\x6c\x65\x4f\x70\x74\x69\x6f\x6e\x73"}());switch ($     ){case WP_AdvancedSlider_Model_Source_Style::STYLE_STANDART:$       =$    ->{"\x63\x72\x65\x61\x74\x65\x42\x6c\x6f\x63\x6b"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(97).chr(100).chr(109).chr(105).chr(110).chr(104).chr(116).chr(109).chr(108).chr(95).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115).chr(95).chr(101).chr(100).chr(105).chr(116).chr(95).chr(116).chr(97).chr(98).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(95).chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(115).chr(95).chr(115).chr(116).chr(97).chr(110).chr(100).chr(97).chr(114).chr(116));$        =$    ->{"\x63\x72\x65\x61\x74\x65\x42\x6c\x6f\x63\x6b"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(97).chr(100).chr(109).chr(105).chr(110).chr(104).chr(116).chr(109).chr(108).chr(95).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115).chr(95).chr(101).chr(100).chr(105).chr(116).chr(95).chr(116).chr(97).chr(98).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(95).chr(115).chr(116).chr(121).chr(108).chr(101).chr(100).chr(101).chr(115).chr(99).chr(114).chr(105).chr(112).chr(116).chr(105).chr(111).chr(110))->{"\x73\x65\x74\x53\x74\x79\x6c\x65"}($     );break ;case WP_AdvancedSlider_Model_Source_Style::STYLE_NICOLE:$       =$    ->{"\x63\x72\x65\x61\x74\x65\x42\x6c\x6f\x63\x6b"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(97).chr(100).chr(109).chr(105).chr(110).chr(104).chr(116).chr(109).chr(108).chr(95).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115).chr(95).chr(101).chr(100).chr(105).chr(116).chr(95).chr(116).chr(97).chr(98).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(95).chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(115).chr(95).chr(110).chr(105).chr(99).chr(111).chr(108).chr(101));$        =$    ->{"\x63\x72\x65\x61\x74\x65\x42\x6c\x6f\x63\x6b"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(97).chr(100).chr(109).chr(105).chr(110).chr(104).chr(116).chr(109).chr(108).chr(95).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115).chr(95).chr(101).chr(100).chr(105).chr(116).chr(95).chr(116).chr(97).chr(98).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(95).chr(115).chr(116).chr(121).chr(108).chr(101).chr(100).chr(101).chr(115).chr(99).chr(114).chr(105).chr(112).chr(116).chr(105).chr(111).chr(110))->{"\x73\x65\x74\x53\x74\x79\x6c\x65"}($     );break ;case WP_AdvancedSlider_Model_Source_Style::STYLE_KRISTA:$       =$    ->{"\x63\x72\x65\x61\x74\x65\x42\x6c\x6f\x63\x6b"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(97).chr(100).chr(109).chr(105).chr(110).chr(104).chr(116).chr(109).chr(108).chr(95).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115).chr(95).chr(101).chr(100).chr(105).chr(116).chr(95).chr(116).chr(97).chr(98).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(95).chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(115).chr(95).chr(107).chr(114).chr(105).chr(115).chr(116).chr(97));$        =$    ->{"\x63\x72\x65\x61\x74\x65\x42\x6c\x6f\x63\x6b"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(97).chr(100).chr(109).chr(105).chr(110).chr(104).chr(116).chr(109).chr(108).chr(95).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115).chr(95).chr(101).chr(100).chr(105).chr(116).chr(95).chr(116).chr(97).chr(98).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(95).chr(115).chr(116).chr(121).chr(108).chr(101).chr(100).chr(101).chr(115).chr(99).chr(114).chr(105).chr(112).chr(116).chr(105).chr(111).chr(110))->{"\x73\x65\x74\x53\x74\x79\x6c\x65"}($     );break ;case WP_AdvancedSlider_Model_Source_Style::STYLE_XANDRA:$       =$    ->{"\x63\x72\x65\x61\x74\x65\x42\x6c\x6f\x63\x6b"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(97).chr(100).chr(109).chr(105).chr(110).chr(104).chr(116).chr(109).chr(108).chr(95).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115).chr(95).chr(101).chr(100).chr(105).chr(116).chr(95).chr(116).chr(97).chr(98).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(95).chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(115).chr(95).chr(120).chr(97).chr(110).chr(100).chr(114).chr(97));$        =$    ->{"\x63\x72\x65\x61\x74\x65\x42\x6c\x6f\x63\x6b"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(97).chr(100).chr(109).chr(105).chr(110).chr(104).chr(116).chr(109).chr(108).chr(95).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115).chr(95).chr(101).chr(100).chr(105).chr(116).chr(95).chr(116).chr(97).chr(98).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(95).chr(115).chr(116).chr(121).chr(108).chr(101).chr(100).chr(101).chr(115).chr(99).chr(114).chr(105).chr(112).chr(116).chr(105).chr(111).chr(110))->{"\x73\x65\x74\x53\x74\x79\x6c\x65"}($     );break ;case WP_AdvancedSlider_Model_Source_Style::STYLE_TRISHA:$       =$    ->{"\x63\x72\x65\x61\x74\x65\x42\x6c\x6f\x63\x6b"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(97).chr(100).chr(109).chr(105).chr(110).chr(104).chr(116).chr(109).chr(108).chr(95).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115).chr(95).chr(101).chr(100).chr(105).chr(116).chr(95).chr(116).chr(97).chr(98).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(95).chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(115).chr(95).chr(116).chr(114).chr(105).chr(115).chr(104).chr(97));$        =$    ->{"\x63\x72\x65\x61\x74\x65\x42\x6c\x6f\x63\x6b"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(97).chr(100).chr(109).chr(105).chr(110).chr(104).chr(116).chr(109).chr(108).chr(95).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(115).chr(95).chr(101).chr(100).chr(105).chr(116).chr(95).chr(116).chr(97).chr(98).chr(95).chr(103).chr(101).chr(110).chr(101).chr(114).chr(97).chr(108).chr(95).chr(115).chr(116).chr(121).chr(108).chr(101).chr(100).chr(101).chr(115).chr(99).chr(114).chr(105).chr(112).chr(116).chr(105).chr(111).chr(110))->{"\x73\x65\x74\x53\x74\x79\x6c\x65"}($     );break ;}$       ->{"\x73\x65\x74\x4f\x70\x74\x69\x6f\x6e\x73"}($      );$this->{"\x73\x65\x74\x43\x68\x69\x6c\x64"}(chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(115),$       );$this->{"\x73\x65\x74\x43\x68\x69\x6c\x64"}(chr(115).chr(116).chr(121).chr(108).chr(101).chr(95).chr(100).chr(101).chr(115).chr(99).chr(114).chr(105).chr(112).chr(116).chr(105).chr(111).chr(110),$        );return parent::_prepareLayout();}}