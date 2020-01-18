<?php 
	function read($uploadfile, $file_type) {
		require_once ($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
		$reader->setReadDataOnly(TRUE);
		$spreadsheet = $reader->load($uploadfile);

		$worksheet = $spreadsheet->getActiveSheet();
		// Get the highest row and column numbers referenced in the worksheet
		$highestRow = $worksheet->getHighestRow();
		
		if ($file_type =='teachers') {
			$maxColumn = 'G';
		} elseif ($file_type =='disciplines') {
			$maxColumn = 'G';
		} elseif ($file_type =='courses_fgos_profstandards') {
			$maxColumn = 'M';
		} elseif ($file_type =='profstandards_otf_tf_activities') {
			$maxColumn = 'L';
		}

		$highestColumn = $maxColumn; // e.g 'F'
		$highestColumn++;

		echo 	'<div class="form-group">
					<input class="btn btn-success" type="button" id="save" value="Сохранить в системе">
					<input class="btn btn-danger" type="button" id="cancel" value="Отмена">
				</div>' . "\n";
		echo '<table class="table table-bordered table-striped">' . "\n";
		echo '<thead>' . "\n";
		for ($row = 1; $row <= 1; ++$row) {
			echo '<tr>' . PHP_EOL;
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