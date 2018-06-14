<?php

/**SUBJECTS */

  function find_all_subjects() {
    global $db;

    $sql = "SELECT * FROM subjects ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_all_subjects_id() {
    global $db;

    $sql = "SELECT id FROM subjects ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }  

  function insert_subject($subject){
    global $db;

    $errors = validate_subject($subject);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $subject['menu_name']) . "', ";
    $sql .= "'" . db_escape($db, $subject['position']) . "', ";
    $sql .= "'" . db_escape($db, $subject['visible']) . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);
    //For INSERT statements, $result is true/false ..

    if($result){
      return true;
    }else{
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_subject($subject){
    global $db;

    $errors = validate_subject($subject);
    if(!empty($errors)){
      return $errors;
      //This return stop the function and the rest of code doesn´t execute..
    }

    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . db_escape($db, $subject['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db, $subject['position']) . "', ";
    $sql .= "visible='" . db_escape($db, $subject['visible']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $subject['id']) . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    //For UPDATE statements, $result is true/false ..

    if($result){
      return true;
    }else{
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  function find_subject_by_id($id){
    global $db;

    $sql = "SELECT * FROM subjects WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // return an assoc. array
  }

  function delete_subject($id){
    global $db;

    $sql = "DELETE FROM subjects WHERE id='" . db_escape($db, $id) . "' LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result){
      return true;

    }else{      
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function subject_num_rows(){
    $subject_set = find_all_subjects();
    $subject_count = mysqli_num_rows($subject_set) + 1; // (+1) I´m createing a new record..
    mysqli_free_result($subject_set);
    return $subject_count;
  }

  /**VALIDATE SUBJECT from functions in query_functions.php*/

  function validate_subject($subject) {
    $errors = [];

    // menu_name
    if(is_blank($subject['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    if(!has_unique_subject_menu_name($subject['menu_name'])){
      $errors[] = "Subject Menu name must be unique.";
    }

    // position
    // Make sure we are working with an integer
    //I put in database only 3 digits
    $postion_int = (int) $subject['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    return $errors;
  }



  /**PAGES */

  function find_all_pages() {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  

  function page_num_rows(){
    $page_set = find_all_pages();
    $page_count = mysqli_num_rows($page_set) + 1; // (+1) I´m createing a new record..
    mysqli_free_result($page_set);
    return $page_count;
  }

  function find_page_by_id($id){
    global $db;

    $sql = "SELECT * FROM pages WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page; // return an assoc. array
  }

  function insert_page($page){
    global $db;

    $errors = validate_page($page);
    if(!empty($errors)){
      return $errors;
    }

    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id, menu_name, position, visible, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $page['subject_id']) . "', ";
    $sql .= "'" . db_escape($db, $page['menu_name']) . "', ";
    $sql .= "'" . db_escape($db, $page['position']) . "', ";
    $sql .= "'" . db_escape($db, $page['visible']) . "', ";
    $sql .= "'" . db_escape($db, $page['content']) . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);
    //For INSERT statements, $result is true/false ..

    if($result){
      return true;
    }else{
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function update_page($page){

    global $db;

    $errors = validate_page($page);
    if(!empty($errors)){
      return $errors;
      //This return stop the function and the rest of code doesn´t execute..
    }

    $sql = "UPDATE pages SET ";
    $sql .= "subject_id='" . db_escape($db, $page['subject_id']) . "', ";
    $sql .= "menu_name='" .  db_escape($db, $page['menu_name']) . "', ";
    $sql .= "position='" .   db_escape($db, $page['position']) . "', ";
    $sql .= "visible='" .    db_escape($db, $page['visible']) . "', ";
    $sql .= "content='" .    db_escape($db, $page['content']) . "' ";
    $sql .= "WHERE id='" .   db_escape($db, $page['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    //For UPDATE statements, $result is true/false ..

    if($result){
      return true;
    }else{
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_page($id){
    global $db;

    $sql = "DELETE FROM pages WHERE id='" . db_escape($db, $id) . "' LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result){
      return true;

    }else{      
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }


  /**VALIDATE PAGE from functions in query_functions.php*/

  function validate_page($page) {
    $errors = [];

    // subject_id
    if(is_blank($page['subject_id'])) {
      $errors[] = "Subject cannot be blank.";
    }

    // menu_name
    if(is_blank($page['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    $current_id = $page['id'] ?? '0';
    if(!has_unique_page_menu_name($page['menu_name'], $current_id)) {
      $errors[] = "Menu name must be unique.";
    }

    // position
    // Make sure we are working with an integer
    //I put in database only 3 digits
    $postion_int = (int) $page['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    // content
    if(is_blank($page['content'])) {
      $errors[] = "Content cannot be blank.";
    } 

    return $errors;
  }

  function find_pages_by_subject_id($subject_id){
    global $db;

    $sql = "SELECT * FROM pages WHERE subject_id='" . db_escape($db, $subject_id) . "' ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;  //return just one page..
  }

?>
