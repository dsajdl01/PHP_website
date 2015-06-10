<?php
/*
*   data.php file for gallery, page for json data, 
* 	FMA assignment using MySQL and PHP.
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 08/04/2015
*/
	/*
	* include once php file. 
	*/
	require_once 'includes/config.php'; 
	require_once 'includes/functions.php';
	// Content-type of json header
	header('Content-type: application/json');
		$array = array();
		try{ 
				if (isset($_GET['type'])) {
					// checking if receive type is equal to all
					if ($_GET['type'] == 'all') { 
								//if type is is all then retrieve all data from database 
								$sql = 'SELECT img_title, img_description, img_width_lg, img_height_lg
									FROM  dsajdl01db.thumbnails';
								$result = mysqli_query($link, $sql);
								// checking if query has any error 
								if (isQueryAlright($result, $link) === true){
									/*
									* Checking if the query returned any value 
									* if not then get error message.
									*/
									if (mysqli_num_rows($result) == 0){
										echo 'Ops.. gallery does not have any images yet. Please go back to - http://titan.dcs.bbk.ac.uk/~dsajdl01/w1fma/index.php?page=loading and upload some images';
									}
									else {
										// if query returned any value then assign value into array.
										$index = 0;
										while($row = mysqli_fetch_assoc($result)){
												$array[$index] = array('img_title' => htmlentities($row['img_title']), 'img_description' => htmlentities($row['img_description']), 'img_name' => htmlentities($row['img_title']).'.jpeg', 'img_width' => htmlentities($row['img_width_lg']), 'img_height' => htmlentities($row['img_height_lg']));
												$index = $index + 1;
											}
										// 	convert PHP array variable to a JSON encoded and print it out
										echo json_encode($array);
									}
								}
					} else {
							// if  type is NOT equal to all then get type value and assign it into $id variable
							$id = $_GET['type'];
							// get SQL query where $id variable is equal to image id from database
							$sql = 'SELECT img_title, img_description, img_width_lg, img_height_lg
									FROM  dsajdl01db.thumbnails
									WHERE img_title =\''. $id.'\'';
							$result = mysqli_query($link, $sql);
							// checking if query has any error
							if (isQueryAlright($result, $link) === true){
								$row = mysqli_fetch_assoc($result);
								/*
								* Checking if the query returned any value 
								* if not then get error message.
								*/
								if($row == 0){
									echo 'Ops.. the title inserted into the url is not correct. Please go back to - http://titan.dcs.bbk.ac.uk/~dsajdl01/w1fma/index.php - and copy the correct title from the particular image or type http://titan.dcs.bbk.ac.uk/~dsajdl01/w1fma/data.php?type=all!';
								}
								else{
									// if query returned any value then assign value into the array. As it is only one row while loop is not need it
									$array[0] = array('img_title' => htmlentities($row['img_title']), 'img_description' => htmlentities($row['img_description']), 'img_name' => htmlentities($row['img_title']).'.jpeg', 'img_width' => htmlentities($row['img_width_lg']), 'img_height' => htmlentities($row['img_height_lg']));
									// 	convert PHP array variable to a JSON encoded and print it out
									echo json_encode($array);
								}
							}
					}
				}
		// if any exception is thrown catch error here and print it out.	
		}catch(Exception $e) {
			echo $e->getMessage();
		}
?>