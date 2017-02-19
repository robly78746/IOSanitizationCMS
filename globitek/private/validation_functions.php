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
	if(preg_match('/^[A-Za-z0-9@._-]*$/', $value) === 1) {
		//My custom validation
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}
    return false;
  }
  
  function has_valid_phone_format($value) {
	$isPhoneNum = false;
	  
	if(preg_match('/^[0-9 ()-]*$/', $value) === 1) {
		
		//My custom validation
		//eliminate every char except 0-9
		$justNums = preg_replace("/[^0-9]/", '', $value);

		//eliminate leading 1 if its there
		if (strlen($justNums) == 11) $justNums = preg_replace("/^1/", '',$justNums);

		//if we have 10 digits left, it's probably valid.
		if (strlen($justNums) == 10) $isPhoneNum = true;
	}
	return $isPhoneNum;
  }
  
  //My custom validation
  function has_valid_state_code($value) {
	if(preg_match('/^[A-Za-z]*$/', $value) === 1) {
		return strlen($value) == 2;
	}
	return false;
  }
  
  //My custom validation
  function has_valid_state_id($value) {
	  global $db;
	  $sql = $db->prepare("SELECT * FROM states WHERE id=? LIMIT 1;");
	  $sql->bind_param("i", $value);
	  $results = $sql->execute();
	  $sql->store_result();
	  $sql->bind_result($id, $name, $code, $country_id);
	  $sql->fetch();
	  
	  if($results && $sql->num_rows > 0) {
		return true;
	  }
	  return false;
  }
  
  function has_valid_username($value) {
	if(preg_match('/^[A-Za-z0-9_]*$/', $value) === 1) {
		return true;
	}
	return false;
  }

?>
