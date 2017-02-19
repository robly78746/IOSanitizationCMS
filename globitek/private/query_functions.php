<?php

  //
  // COUNTRY QUERIES
  //

  // Find all countries, ordered by name
  function find_all_countries() {
    global $db;
    $sql = "SELECT * FROM countries ORDER BY name ASC;";
    $country_result = db_query($db, $sql);
    return $country_result;
  }

  //
  // STATE QUERIES
  //

  // Find all states, ordered by name
  function find_all_states() {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "ORDER BY name ASC;";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find all states, ordered by name
  function find_states_for_country_id($country_id=0) {
    global $db;
	$sql = $db->prepare("SELECT * FROM states WHERE country_id=? ORDER BY name ASC;");
	$sql->bind_param("i", $country_id);
	$sql->execute();
    $state_result = mysqli_stmt_get_result($sql);
    return $state_result;
  }

  // Find state by ID
  function find_state_by_id($id=0) {
    global $db;
	
	$sql = $db->prepare("SELECT * FROM states WHERE id=?;");
	$sql->bind_param("i", $id);
	$sql->execute();
    $state_result = mysqli_stmt_get_result($sql);
    return $state_result;
  }

  function validate_state($state, $errors=array()) {
	
	if (is_blank($state['name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif (!has_length($state['name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
	
	if (is_blank($state['code'])) {
      $errors[] = "Code cannot be blank.";
    } elseif (!has_length($state['code'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Code must be between 2 and 255 characters.";
    }
	
    return $errors;
  }

  // Add a new state to the table
  // Either returns true or an array of errors
  function insert_state($state) {
    global $db;

    $errors = validate_state($state);
    if (!empty($errors)) {
      return $errors;
    }

	$name = $state['name'];
	$code = $state['code'];
	$country_id = $state['country_id'];
	
    $sql = $db->prepare("INSERT INTO states (name, code, country_id) VALUES (?, ?, ?);"); 
    $sql->bind_param("ssi", $name, $code, $country_id);
    // For INSERT statments, $result is just true/false
    $result = $sql->execute();
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a state record
  // Either returns true or an array of errors
  function update_state($state) {
    global $db;

    $errors = validate_state($state);
    if (!empty($errors)) {
      return $errors;
    }

	$name = $state['name'];
	$code = $state['code'];
	$country_id = $state['country_id'];
	$id = $state['id'];
	
    $sql = $db->prepare("UPDATE states SET name=?, code=?, country_id=? WHERE id=? LIMIT 1;");
	$sql->bind_param("ssii", $name, $code, $country_id, $id);
	
    // For update_state statments, $result is just true/false
    $result = $sql->execute();
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  //
  // TERRITORY QUERIES
  //

  // Find all territories, ordered by state_id
  function find_all_territories() {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "ORDER BY state_id ASC, position ASC;";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  // Find all territories whose state_id (foreign key) matches this id
  function find_territories_for_state_id($state_id=0) {
    global $db;
	$sql = $db->prepare("SELECT * FROM territories WHERE state_id=? ORDER BY position ASC;");
	$sql->bind_param("i", $state_id);
	$sql->execute();
    $territory_result = mysqli_stmt_get_result($sql);
    return $territory_result;
  }

  // Find territory by ID
  function find_territory_by_id($id=0) {
    global $db;
	$sql = $db->prepare("SELECT * FROM territories WHERE id=?;");
	$sql->bind_param("i", $id);
	$sql->execute();
    $territory_result = mysqli_stmt_get_result($sql);
    return $territory_result;
  }

  function validate_territory($territory, $errors=array()) {
    // TODO add validations

    return $errors;
  }

  // Add a new territory to the table
  // Either returns true or an array of errors
  function insert_territory($territory) {
    global $db;

    $errors = validate_territory($territory);
    if (!empty($errors)) {
      return $errors;
    }

	$name = $territory['name'];
	$state_id = $territory['state_id'];
	$position = $territory['position'];
		
    $sql = $db->prepare("INSERT INTO territories (name, state_id, position) VALUES (?, ?, ?);"); // TODO add SQL
    $sql->bind_param("sii", $name, $state_id, $position);
    // For INSERT statments, $result is just true/false
    $result = $sql->execute();
    if($result) {
      return true;
    } else {
      // The SQL INSERT territoryment failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a territory record
  // Either returns true or an array of errors
  function update_territory($territory) {
    global $db;

    $errors = validate_territory($territory);
    if (!empty($errors)) {
      return $errors;
    }

	$name = $territory['name'];
	$position = $territory['position'];
	$state_id = $territory['state_id'];
	$id = $territory['id'];
	
    $sql = $db->prepare("UPDATE territories SET name=?, state_id=?, position=? WHERE id=? LIMIT 1;");
	$sql->bind_param("siii", $name, $state_id, $position, $id);
    // For update_territory statments, $result is just true/false
    $result = $sql->execute();
    if($result) {
      return true;
    } else {
      // The SQL UPDATE territoryment failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  //
  // SALESPERSON QUERIES
  //

  // Find all salespeople, ordered last_name, first_name
  function find_all_salespeople() {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // To find salespeople, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same territory ID.
  function find_salespeople_for_territory_id($territory_id=0) {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (salespeople_territories.salesperson_id = salespeople.id) ";
    $sql .= "WHERE salespeople_territories.territory_id='" . $territory_id . "' ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // Find salesperson using id
  function find_salesperson_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "WHERE id='" . $id . "';";
	$sql = $db->prepare("SELECT * FROM salespeople WHERE id=?;");
	$sql->bind_param("i", $id);
	$sql->execute();
    $salespeople_result = mysqli_stmt_get_result($sql);
    return $salespeople_result;
  }

  function validate_salesperson($salesperson, $errors=array()) {
    if (is_blank($salesperson['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($salesperson['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if (is_blank($salesperson['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($salesperson['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if (is_blank($salesperson['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($salesperson['email'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Email must be between 2 and 255 characters.";
	} elseif (!has_valid_email_format($salesperson['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if (is_blank($salesperson['phone'])) {
      $errors[] = "Phone number cannot be blank.";
    } elseif (!has_length($salesperson['phone'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Phone number must be between 2 and 255 characters.";
    } elseif(!has_valid_phone_format($salesperson['phone'])) {
      $errors[] = "Phone number must be a valid format.";
    }
    return $errors;
  }

  // Add a new salesperson to the table
  // Either returns true or an array of errors
  function insert_salesperson($salesperson) {
    global $db;

    $errors = validate_salesperson($salesperson);
    if (!empty($errors)) {
      return $errors;
    }
	$first_name = $salesperson['first_name'];
	$last_name = $salesperson['last_name'];
	$phone = $salesperson['phone'];
	$email = $salesperson['email'];
    $sql = $db->prepare("INSERT INTO salespeople (first_name, last_name, phone, email) VALUES (?, ?, ?, ?);"); // TODO add SQL
    $sql->bind_param("ssss", $first_name, $last_name, $phone, $email);
	

	// For INSERT statments, $result is just true/false
    $result = $sql->execute();
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a salesperson record
  // Either returns true or an array of errors
  function update_salesperson($salesperson) {
    global $db;

    $errors = validate_salesperson($salesperson);
    if (!empty($errors)) {
      return $errors;
    }

	$first_name = $salesperson['first_name'];
	$last_name = $salesperson['last_name'];
	$phone = $salesperson['phone'];
	$email = $salesperson['email'];
	$id = $salesperson['id'];
	
	$sql = $db->prepare("UPDATE salespeople SET first_name=?, last_name=?, phone=?, email=? WHERE id=? LIMIT 1;");
	$sql->bind_param("ssssi", $first_name, $last_name, $phone, $email, $id);
	
    // For update_salesperson statments, $result is just true/false
    $result = $sql->execute();//db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // To find territories, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same salesperson ID.
  function find_territories_by_salesperson_id($id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (territories.id = salespeople_territories.territory_id) ";
    $sql .= "WHERE salespeople_territories.salesperson_id='" . $id . "' ";
    $sql .= "ORDER BY territories.name ASC;";
    $territories_result = db_query($db, $sql);
    return $territories_result;
  }

  //
  // USER QUERIES
  //

  // Find all users, ordered last_name, first_name
  function find_all_users() {
    global $db;
    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $users_result = db_query($db, $sql);
    return $users_result;
  }

  // Find user using id
  function find_user_by_id($id=0) {
    global $db;
	$sql = $db->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
	$sql->bind_param("i", $user_id);
	
	$user_id = $id;
	$sql->execute();
	
	$users_result = mysqli_stmt_get_result($sql);
    return $users_result;
  }

  function validate_user($user, $errors=array()) {
    if (is_blank($user['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($user['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if (is_blank($user['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if (is_blank($user['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($user['email'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Email must be between 2 and 255 characters.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if (is_blank($user['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user['username'], array('max' => 255))) {
      $errors[] = "Username must be less than 255 characters.";
    } elseif (!has_valid_username($user['username'])) {
	  $errors[] = "Username must be a valid format.";
	}
    return $errors;
  }

  // Add a new user to the table
  // Either returns true or an array of errors
  function insert_user($user) {
    global $db;

    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }
	$first_name = $user['first_name'];
	$last_name = $user['last_name'];
    $email = $user['email'];
	$username = $user['username'];
    $created_at = date("Y-m-d H:i:s");
    $sql = $db->prepare("INSERT INTO users (first_name, last_name, email, username, created_at) VALUES (?, ?, ?, ?, ?);");
	$sql->bind_param("sssss", $first_name, $last_name, $email, $username, $created_at);
    // For INSERT statments, $result is just true/false
    $result = $sql->execute();
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a user record
  // Either returns true or an array of errors
  function update_user($user) {
    global $db;

    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }
	
	$first_name = $user['first_name'];
	$last_name = $user['last_name'];
    $email = $user['email'];
	$username = $user['username'];
	$id = $user['id'];
	
	$sql = $db->prepare("UPDATE users SET first_name=?, last_name=?, email=?, username=? WHERE id=? LIMIT 1;");
	$sql->bind_param("ssssi", $first_name, $last_name, $email, $username, $id);
	
    // For update_user statments, $result is just true/false
    $result = $sql->execute();
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

?>
