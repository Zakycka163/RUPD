<?php 
	function read($uploadfile, $maxColumn) {
		require_once ($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
		$reader->setReadDataOnly(TRUE);
		$spreadsheet = $reader->load($uploadfile);

		$worksheet = $spreadsheet->getActiveSheet();
		// Get the highest row and column numbers referenced in the worksheet
		$highestRow = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn = $maxColumn; // e.g 'F'
		$highestColumn++;

        echo "INSERT INTO `teachers` (`second_name`, `first_name`, `middle_name`, `email`, `academic_rank_id`, `academic_degree_id`) VALUES ";
		for ($row = 2; $row <= $highestRow; ++$row) {
			echo ( ($row == 2) ? "(" : ", (" );

			for ($col = 'A'; $col != $highestColumn; ++$col) {
				echo ( ($col == 'A') ? "'" : ", '" );
					
				$value = $worksheet->getCell($col . $row)->getValue();

				if ($col == 'E') {
					connect();
					global $link;
					$result = mysqli_query($link, "SELECT academic_rank_id FROM academic_ranks WHERE UPPER(full_name) = UPPER('".$value."')");
					while($p1 = mysqli_fetch_array($result)){
						echo $p1[0];
					}
					close();
				} elseif ($col == 'F') {
					connect();
					global $link;
					$result = mysqli_query($link, "SELECT academic_degree_id FROM academic_degrees WHERE UPPER(short_name) =UPPER('".$value."')");
					while($p1 = mysqli_fetch_array($result)){
						echo $p1[0];
					}
					close();
				} else {
					echo $value;
				}

				echo "'" . PHP_EOL;
			};
			echo ')' . PHP_EOL;
		};
		echo ";" . PHP_EOL;
	};
	
?> 