<?php


/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


class ServerDirectory {
  public $path;  // ./img/projects/ OR ./img/articles/yyyy/mm/dd/
  public $name;   // name of the directory folder
  public $exists;  // if the directory exists in the server files

  function __construct(
    $in_path=null,
    $in_name=null
  ) {
    if (!empty($in_path)) { $this->path = $in_path; }
    if (!empty($in_name)) { $this->name = $in_name; }
    if (!empty($in_path) && !empty($in_name)) {
      $this->exists = is_dir($in_path.$in_name);
    }
  }


  /**
  * Function to recursively move files and non-empty directories
  * from a source directory to a destination directory.
  * No return value.
  */
  private function mvdir($src, $dst) {
    if (!file_exists($dst)) {
      // recursively traverse directories
      if (is_dir($src)) {
        mkdir($dst);
        $files = scandir($src);
        foreach ($files as $file)
        if ($file != "." && $file != "..") mvdir("$src/$file", "$dst/$file");
        rmdir($src);
      // files (recursive endpoints - rename copies then deletes)
      } else if (file_exists($src)) rename($src, $dst);
    }
  }

  /**
  * Function to recursively remove files and non-empty directories.
  * No return value.
  */
  private function rrmdir($dir) {
    if (is_dir($dir)) {
      $files = scandir($dir);
      foreach ($files as $file)
      if ($file != "." && $file != "..") rrmdir("$dir/$file");
      rmdir($dir);
    } else if (file_exists($dir)) unlink($dir);
  }

  /**
  * Function to recursively copy files and non-empty directories.
  * No return value.
  */
  private function rcopy($src, $dst) {
    if (!file_exists($dst)) {
      if (is_dir($src)) {
        mkdir($dst);
        $files = scandir($src);
        foreach ($files as $file)
        if ($file != "." && $file != "..") rcopy("$src/$file", "$dst/$file");
      }
      else if (file_exists($src)) copy($src, $dst);
    }
  }


  function create() {
    if (!$this->exists) {
      mkdir($this->path.$this->name, 0777, true);
      $this->exists = true;
      return true;
    } else {
      echo '<script>alert("Directory not created because it already exists!")</script>';
      return false;
    }
  }

  function rename($old_name, $new_name) {
    $this->mvdir($this->path.$old_name, $this->path.$new_name);
    $this->name = $new_name;
  }

  function copy($new_path=null, $new_name=null) {
    if ($new_path != null || $new_name != null) {
      if ($new_path === null) $new_path = $this->path;
      if ($new_name === null) $new_name = $this->name;
      $this->rcopy($this->path.$this->name, $new_path.$new_name);
      $this->path = $new_path;
      $this->name = $new_name;
    }
  }

  function delete() {
    if (!$this->exists) {
      echo '<script>alert("Directory not deleted because it does not exist!")</script>';
      return false;
    } else {
      $this->rrmdir($this->path.$this->name);
      $this->exists = false;
      return true;
    }
  }
}


?>
