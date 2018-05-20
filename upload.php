<?php

class UploadController {
	// folder where files will be saved
	private $upload_dir = __DIR__ . "/uploads/";

	public function upload() {
		
		// check how many files are going to be uploaded
		$files_num = count($_FILES['file']['name']);

		// if uploads folder doesn't exist then create it
		if (!is_dir($this->upload_dir)) {
			mkdir($this->upload_dir);
		}

		// loop through array of files to save each file separately
		for ($i=0; $i < $files_num; $i++) {
			$file = $_FILES['file']['tmp_name'][$i];
			$filename = $_FILES['file']['name'][$i];

			$upload_path = $this->upload_dir . $filename;

			if (move_uploaded_file($file, $upload_path)) {
				echo "File is correct and was uploaded successfully.\n";
			} else {
				echo "Possible attack with file upload manager!\n";
			}
		}
	}
}

$controller = new UploadController();
$controller->upload();