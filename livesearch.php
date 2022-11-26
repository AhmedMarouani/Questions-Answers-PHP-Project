<?php
    $db_username = 'root';
    $db_password = '';
    $db_name = 'rocket';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name);
    include 'functions.php';
    
							if(isset($_POST['search'])){
								$query = $_POST['search']; 
                                $run_querry = "SELECT question FROM question
                                WHERE question LIKE '%$query%'";
								$raw_results =mysqli_query($db, $run_querry);
								echo '
								<ul>
									';
									while ($results = MySQLi_fetch_array($raw_results)) {
										$searchedQuestions = $results["question"];
										$searchedusername = $results["username"];
                                        $searchedcategory = $results["category_name"];
										?>
										<li onclick='fill("<?php echo $results["question"]; ?>")'>
										<a href="singlequestion.php?question=<?php echo $searchedQuestions; ?>&userquestion=<?php echo $searchedQuestionname; ?>">
											<?php echo $searchedQuestions; ?>
										</li></a>
						<?php
							}}?>
                            						</ul>
