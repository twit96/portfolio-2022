<?php


/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


class Image {
  public $path;
  public $name;
  public $exists;  // if the image exists in the server files

  function __construct(
    $in_path=null,
    $in_name=null
  ) {
    if (!empty($in_path)) { $this->path = $in_path; }
    if (!empty($in_name)) { $this->name = $in_name; }
    if (!empty($in_path) && !empty($in_name)) {
      $this->exists = file_exists($in_path.$in_name);
    }
  }


  /**
  * Function to check whether or not an image of the same name as the $new_file
  * object exists at this path in the server files.
  * Returns true if so and false otherwise.
  */
  private function exists($file_name) {
    $path_name = $this->path.$file_name;
    if (file_exists($path_name)) {
      return true;
    } else {
      return false;
    }
  }


  /**
  * Function to rename this object name if it matches the name of an existing
  * image at this object's path in the server files.
  * Appends a number to the end of this name if it doesn't exist,
  * or increments that number up by one if it does exist.
  */
  private function formatFilename($file_name) {
    while (exists($file_name)) {
      $split = explode(".", $file_name);
      $ext = array_pop($split);
      $split = implode(".", $split);
      $split = explode("-", $split);
      (is_numeric(end($split))) ? $num = array_pop($split) + 1 : $num = 0;
      $file_name = implode("-", $split).'-'.$num.'.'.$ext;
    }
    return $file_name;
  }

  /**
  * Function to check whether the $FILES["image"] object is valid for uploading
  * to the server. Returns true if valid and false otherwise.
  */
  private function validate($file) {
    if (!isset($file) || $file["size"] == 0) return false;       // file not set
    if (getimagesize($file["tmp_name"]) === false) return false;   // fake image
    if ($file["size"] > 500000) return false;              // too large (>500kB)

    $file_name = basename($file["name"]);
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $accepted_types = array("jpg", "png", "jpeg", "gif", "webp");
    if (!in_array($file_type, $accepted_types)) return false;     // invalid ext

    return true;                                            // passed all checks
  }


  function upload($new_file) {

    if (empty($this->path)) {
      // missing required $path parameter
      echo '<script>alert("Image not uploaded! Missing path parameter.")</script>';
      return false;

    } else {
      // $new_file is a form submission $_FILE["image"] object.
      if ($this->validate($new_file)) {
        $file_name = basename($new_file["name"]);
        ($this->exists) ? $old_img = $this->path.$this->name : $old_img = null;
        $file_name = formatFilename($file_name);

        if (move_uploaded_file($new_file["tmp_name"], $this->path.$file_name)) {
          // upload succeeded
          if (!empty($old_img)) unlink($old_img);  // unlink existing image
          $this->name = $file_name;                // update this name
          return true;
        } else {
          // upload failed
          echo '<script>alert("Image upload failed!")</script>';
          return false;
        }
      }
    }

  }

  function delete() {
    // Failures
    if (empty($this->path)) {
      echo '<script>alert("Image deletion failed! Missing required path parameter.")</script>';
      return false;
    } else if (empty($this->name)) {
      echo '<script>alert("Image deletion failed! Missing required name parameter.")</script>';
      return false;
    // Deletion
    } else {
      unlink($this->path.$this->name);
      return true;
    }
  }

}


?>
