<?php
// ini_set("display_errors",0);
define('__ROOT__', dirname(dirname(__FILE__))); 

require_once(__ROOT__.'./src/config/db_config.php');
require_once(__ROOT__.'/src/lib/SpreadsheetReader.php');
require_once(__ROOT__.'/src/lib/SpreadsheetReader_XLSX.php');
require_once(__ROOT__.'/src/config/db_config.php');


$data = new SpreadsheetReader(__ROOT__.'/files/excelfile.xlsx');
$Sheets = $data -> Sheets();

$td = array(); // cells data - actual data will be store in td = table data
$msg = ''; //message to user

foreach ($Sheets as $Index => $Name)
{
	// echo 'Sheet #'.$Index.': '.$Name;
	echo '
		<table id="customers">
			<caption>'. $Name .'</caption>
	';	
	$data -> ChangeSheet($Index);

	foreach ($data as $Row)
	{ 
		
	echo '
			<tr>
				<td >'. $Row[0] .'</th>
				<td >'. $Row[1] .'</th>
				<td >'. $Row[2] .'</th>
				<td >'. $Row[3] .'</th>
			</tr>';
			
			$sql = "INSERT INTO excel_table (slide_a, slide_b, slide_c, slide_d)
							VALUES ('$Row[0]','$Row[1]','$Row[2]', '$Row[3]')";			

			$result = mysqli_query($link, $sql);

			if($result){
				$msg = 'Data successfully inserted into the database';
			}else{
				$msg = 'Problem in query';
			}

			
			// foreach($Row as $dataCell)
			// {

				
			// 	// if( $dataCell !== 'Slide A' &&
			// 	// 	$dataCell !== 'Slide B' &&
			// 	// 	$dataCell !== 'Slide C' &&
			// 	// 	$dataCell !== 'Slide D'){
			// 	// 		$total_col = 4;
			// 	// 		while($total_col < 4){

			// 	// 		}
			// 	// 	}else{
			// 	// 		// echo $dataCell.', RSS <br>';
			// 	// 	}
				
			// }
		
	}

}

echo '</table>';
echo "<strong>".$msg."</strong>";