<?php
								$info = selectuser($_SESSION['user']);
								$user_id = $info["id"];
									if(isset($_POST['question_post'])){
										$question = $_POST['question'];
										$query = "INSERT into question (question , user_id)
											VALUES ('$question', '$user_id')";
										$res = mysqli_query($db, $query);
											if($res){
												$questionsucces = "Your question has been posted successfully :D";
												  echo "<p style='color: #33cabb; font-size: 12px; margin-left: auto; margin-top: 20px;'>$questionsucces</p>";
											}
									}		
							?>