<?php
/*
Copyright (C) 2011, WebAndPeople.com
*/
?>
<?php
 class WP_AdvancedSlider_Model_Slides extends Mage_Core_Model_Abstract{public function _construct(){parent::_construct();$this->{"\x5f\x69\x6e\x69\x74"}(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114).chr(47).chr(115).chr(108).chr(105).chr(100).chr(101).chr(115));}public function deleteImage(){$   =$this->{"\x67\x65\x74\x49\x6d\x61\x67\x65"}();if ($   ){$    =Mage::helper(chr(97).chr(100).chr(118).chr(97).chr(110).chr(99).chr(101).chr(100).chr(115).chr(108).chr(105).chr(100).chr(101).chr(114));$    ->{"\x72\x65\x6d\x6f\x76\x65\x52\x65\x73\x69\x7a\x65\x64\x49\x6d\x61\x67\x65\x46\x69\x6c\x65"}(Mage::getBaseDir(chr(109).chr(101).chr(100).chr(105).chr(97)).DS.$    ->{"\x6e\x6f\x72\x6d\x61\x6c\x69\x7a\x65\x50\x61\x74\x68\x53\x65\x70\x61\x72\x61\x74\x6f\x72"}($   ));}$this->{"\x73\x65\x74\x49\x6d\x61\x67\x65"}('');$this->{"\x73\x65\x74\x53\x68\x6f\x72\x74\x44\x65\x73\x63\x72\x69\x70\x74\x69\x6f\x6e"}('');$this->{"\x73\x65\x74\x44\x65\x73\x63\x72\x69\x70\x74\x69\x6f\x6e"}('');}protected function _afterDeleteCommit(){$this->{"\x64\x65\x6c\x65\x74\x65\x49\x6d\x61\x67\x65"}();return $this;}}