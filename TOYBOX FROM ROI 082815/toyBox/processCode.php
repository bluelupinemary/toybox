<?php
				// define variable and set to empty value
				$temp=NULL;
				ini_set('display_errors', 1); // set to 0 for production version 
				error_reporting(E_ALL);
				//echo $_POST["query_input"];
				//echo "<br />";

				$temp = test_input($_POST["query_input"]);
			  	write_to_file($temp);
				
				if(empty($temp)){
					echo("Welcome to Toybox");

				}else{
				exec('./toyBox "'.$temp.'" ', $out);
				//print_r($out);

					$arrSize = sizeof($out);
					
					for($i=0;$i<$arrSize;$i++){
						echo("&nbsp"."&nbsp".$out[$i]."<br>");
						$temp_out = substr($out[0], 0, 5);
							//echo($temp_out);
							if($temp_out!="ERROR"){
								$shell_output = shell_exec('gcc -save-temps -fverbose-asm translated.c');
								$shell_output2 = shell_exec('gcc -o run translated.s');
								$shell_output3 = shell_exec('./run');
								//echo("\nToybox >>\n\t");
								//echo($shell_output3);
								/*echo($shell_output);
								pwede ilagay dito ang ./run para sa textbox mag output, kaso paano ang collect?
								*/
							}
					}

				}
				

				function test_input($data) {
				  $data = trim($data);
				  $data = stripslashes($data);
				  $data = htmlspecialchars($data);
					
				  return $data;
				}

				function write_to_file($data){
					//$file = 'sample2.txt';
					//$data = 'this is your string to write';
					//file_put_contents("sample2.txt", "sampledata");
	
					
					
					$myfile = fopen("/var/www/html/toyBox/samplecode.txt", "w") or die("Unable to open file!");
					
					if (!is_writable("/var/www/html/toyBox/samplecode.txt")) {
   
                				chmod($myfile, 0777);  //this gives true 
        
   						
					} else {
   		
					}
					$data = htmlspecialchars_decode($data);
					fwrite($myfile, $data);
					fclose($myfile);
				}
				
?>
