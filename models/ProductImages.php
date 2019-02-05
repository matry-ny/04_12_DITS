<?php

namespace models;

use components\App;
use components\db\AbstractModel;

class ProductImages extends AbstractModel
{
  /**
   * @return string
   */
  public function tableName(): string
  {
    return 'product_images';
  }

  /**
   * @param int $productId
   * @param array $files
   * @throws \Exception
   */
  public function uploadImages(int $productId, array $files)
  {
    $rows = [];

    foreach($files as $file) {
      $hashedFile = $this->generateFileName($file['name']);
      $destination = vsprintf('%s/%s', [
        App::get()->config()['storage'],
        $hashedFile
      ]);
      move_uploaded_file($file['tmp_name'], $destination);

      $rows[] = "('{$file['name']}', '{$hashedFile}', {$productId})";
    }

    $sql = "INSERT INTO {$this->tableName()} (url, file, product_id) VALUES " . implode(', ', $rows);

    $query = App::get()->db()->getQueryBuilder()->prepare($sql);
    $query->execute();
  }

  /**
   * @param string $file
   * @return string
   */
  private function generateFileName(string $file)
  {
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $salt = time() . mt_rand();

    return md5($file . $salt) . ".{$ext}";
  }
}