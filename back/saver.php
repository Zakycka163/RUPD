<?php 
    // require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
	function read($uploadfile,$maxColumn) {
		require_once ($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
		$reader->setReadDataOnly(TRUE);
		$spreadsheet = $reader->load($uploadfile);

		$worksheet = $spreadsheet->getActiveSheet();
		// Get the highest row and column numbers referenced in the worksheet
		$highestRow = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn = $maxColumn; // e.g 'F'
		$highestColumn++;

        echo 'INSERT INTO ';
		for ($row = 2; $row <= 1; ++$row) {
			echo 'd' . PHP_EOL;
			echo '<th>№</th>';
			for ($col = 'A'; $col != $highestColumn; ++$col) {
				echo '<th>' .
					$worksheet->getCell($col . $row) ->getValue() .
					'</th>' . PHP_EOL;
			}
			echo '</tr>' . PHP_EOL;
		}
		echo '</thead>' . "\n";
		echo '<tbody>' . "\n";
		for ($row = 2; $row <= $highestRow; ++$row) {
			$rowNum = $row - 1;
			echo '<tr>' . PHP_EOL;
			echo '<td>'.$rowNum.'</td>';
			for ($col = 'A'; $col != $highestColumn; ++$col) {
				echo '<td>' .
					$worksheet->getCell($col . $row) ->getValue() .
					'</td>' . PHP_EOL;
			}
			echo '</tr>' . PHP_EOL;
		}
		echo '</thead>' . "\n";
		echo '</table>' . PHP_EOL;
	};
	
?> 