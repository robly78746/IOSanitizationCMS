<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    // Function can be improved later to check for
    // more than just '@'.
    return strpos($value, '@') !== false;
  }
  
  function has_valid_phone_format($value) {
	 $isPhoneNum = false;
	  
	//eliminate every char except 0-9
	$justNums = preg_replace("/[^0-9]/", '', $value);

	//eliminate leading 1 if its there
	if (strlen($justNums) == 11) $justNums = preg_replace("/^1/", '',$justNums);

	//if we have 10 digits left, it's probably valid.
	if (strlen($justNums) == 10) $isPhoneNum = true;
  
	return $isPhoneNum;
  }

?>
