<?php

	class CommonFunctions 
	{
		function dataMapping($data=array(), $key='')
		{
			$returnData = array();
			if(count($data)>0 && $key!='')
			{
				foreach($data as $val)
				{
					$returnData[$val['id']] = $val;
				}
			}
			return $returnData;
		}
		/* ================ Custom ========== */
			/* ====== Set Property Id ===== */
				function getPropertyId($num=0)
				{
					$numlength = mb_strlen($num);
					switch($numlength)
					{
						case 1: 
							$num = "GA00000".$num;
							break;
						case 2: 
							$num = "GA0000".$num;
							break;
						case 3: 
							$num = "GA000".$num;
							break;
						case 4: 
							$num = "GA00".$num;
							break;
						case 5: 
							$num = "GA0".$num;
							break;
						case 6: 
							$num = "GA".$num;
							break;
					}
					return $num;
				}
			/* ====== Set Property Id ===== */
			function createEmpId($num=0)
			{
				$numlength = mb_strlen($num);
				switch($numlength)
				{
					case 1: 
						$num = "GAEMP0000".$num;
						break;
					case 2: 
						$num = "GAEMP000".$num;
						break;
					case 3: 
						$num = "GAEMP00".$num;
						break;
					case 4: 
						$num = "GAEMP0".$num;
						break;
					case 5: 
						$num = "GAEMP".$num;
						break;
				}
				return $num;
			}
			function getCurrentSlug () 
			{
				$slugs = array();
				$str = "";
				global $siteUrl;
				$urlArr =  explode("/", $_SERVER['REQUEST_URI']);
				/* $slugs = array();
				$urlArr =  explode("/", $_SERVER['REQUEST_URI']);
				foreach($urlArr as $val) {
					if($val!='') {
						array_push($slugs, $val);
					}				
				}
				if(count($slugs)>0) {
					foreach($slugs as $key => $slug) {
						if($key==(count($slugs)-1)) {
							return array('slugs' => $slugs, 'currentSlug' => $slug);
						}			
					}
					//return $slugs[count($slugs)-1)];
				}
				return array('slugs' => $slugs, 'currentSlug' => ''); */
			}
			
			/* ======== Pagination =========== */
			function createPagination($criteria=array(), $searchCriteria = array())
			{
				if($criteria['totalRecords']>0)
				{
					$pages = array();
					$PageLimit = $criteria['pageLimit'];
					$pageNo = $criteria['pageNo'];
					$baseUrl = $criteria['baseUrl'];
					$totalPages = ceil($criteria['totalRecords']/$criteria['recordsLimit']);
					if($totalPages > 0) 
					{
						
						if($pageNo<=3)
						{
							if($totalPages > 1) {
								for($i=1; $i<=$totalPages; $i++) {
									array_push($pages, $i);
								}
							}
						}
						else if($pageNo>=($totalPages-2))
						{
							$i = (($totalPages-4)>0)? ($totalPages-4) : 1;
							for($i; $i<=$totalPages; $i++) {
								array_push($pages, $i);
							}
						}
						else
						{
							$i = $pageNo-2;
							for($i; $i<=$totalPages; $i++) {
								array_push($pages, $i);
							}
						}
					}
					$paginationStr = '';
					if(count($pages)>1)
					{
						echo '<form name="paginationform" id="pagination_form" method="POST">'; //action="'.$baseUrl.'"
							//echo '<input type="hidden" name="pageNo" id="pageNo" value="" />';
							echo '<input type="hidden" name="baseUrl" id="baseUrl" value="'.$baseUrl.'" />';
							
							foreach($searchCriteria as $val)
							{
								echo '<input type="hidden" name="'.$val["name"].'" id="'.$val["name"].'" value="'.$val["value"].'" />';
							}					
						echo '</form>';
						
						echo '<div class="text-center">';
							echo '<ul class="pagination">';
								echo '<li class="page-item '.(($pageNo==1)? "disabled" : "").'"><a class="page-link" href="javascript:void(0);" onclick="submitAction(1);">&laquo;</a></li>';
								echo '<li class="page-item '.(($pageNo==1)? "disabled" : "").'"><a class="page-link" href="javascript:void(0);" onclick="submitAction('.(($pageNo>1)? ($pageNo-1):1).');">&lsaquo;</a></li>';
								
								foreach($pages as $value) {
									if($PageLimit>0)
									{
										echo '<li class="page-item '.(($value==$pageNo)? "active" : "").'"><a class="page-link" href="javascript:void(0);" onclick="submitAction('.$value.');">'.$value.'</a></li>';
									}
									$PageLimit--;
								}
								
								echo '<li class="page-item '.(($pageNo==$totalPages)? "disabled" : "").'"><a class="page-link" href="javascript:void(0);" onclick="submitAction('.(($pageNo<$totalPages)? ($pageNo+1):$totalPages).');">&rsaquo;</a></li>';
								echo '<li class="page-item '.(($pageNo==$totalPages)? "disabled" : "").'"><a class="page-link" href="javascript:void(0);" onclick="submitAction('.$totalPages.');">&raquo;</a></li>';
							echo '</ul>';
						echo '</div>';
						
						
						/* echo '<div class="text-center">';
							echo '<ul class="pagination">';
								echo '<li class="page-item '.(($pageNo==1)? "disabled" : "").'"><a class="page-link" href="'.$baseUrl.'/1">&laquo;</a></li>';
								echo '<li class="page-item '.(($pageNo==1)? "disabled" : "").'"><a class="page-link" href="'.$baseUrl.'/'.(($pageNo>1)? ($pageNo-1):1).'">&lsaquo;</a></li>';
								
								foreach($pages as $value) {
									if($PageLimit>0)
									{
										echo '<li class="page-item '.(($value==$pageNo)? "active" : "").'"><a class="page-link" href="'.$baseUrl.'/'.$value.'">'.$value.'</a></li>';
									}
									$PageLimit--;
								}
								
								echo '<li class="page-item '.(($pageNo==$totalPages)? "disabled" : "").'"><a class="page-link" href="'.$baseUrl.'/'.(($pageNo<$totalPages)? ($pageNo+1):$totalPages).'">&rsaquo;</a></li>';
								echo '<li class="page-item '.(($pageNo==$totalPages)? "disabled" : "").'"><a class="page-link" href="'.$baseUrl.'/'.$totalPages.'">&raquo;</a></li>';
							echo '</ul>';
						echo '</div>'; */
					}
				}		
			}
			/* ======== Pagination =========== */
			
			/* ========= Create Directory Path ======== */
			function createDirectoryPath($type='user')
			{
				$dateAdded = date('Y-m-d');
				$parentDir = AJAX_UPLOAD_FILE_PATH;//($type=='emp')? EMP_PROFILE_PATH : AJAX_UPLOAD_FILE_PATH;
				$dirPath = ($type=='emp')? EMP_PROFILE_PATH : USER_PROFILE_PATH;
				$dt_exp = explode('-', $dateAdded);
				$subDir =  $dt_exp[0];
				$dir_name = $dt_exp[1];
				$dir_path = $parentDir.$dirPath.$subDir;
				$dir_exists = is_dir($dir_path);
				
				if(!$dir_exists)
				{
					mkdir($dir_path); 
					chmod($dir_path,0777);
				}
				$dir_path = $parentDir.$dirPath.$subDir.'/'.$dir_name;
				$dir_exists = is_dir($dir_path);
				if(!$dir_exists)
				{
					mkdir($dir_path); 
					chmod($dir_path,0777);
				}

				return $dirPath.$subDir.'/'.$dir_name;
			}
			/* ========= Create Directory Path ======== */
			
			
			function insertImage($path, $file, $width=770, $height=330, $prevFile='', $fileSize = 0)
			{
				$status = array();
				if(!is_dir($path))
				{
					mkdir($path, 0777, true); 
					//chmod(ROOT.UPLOAD_PATH.$directory.'/', 0777);
				}
				$dirPath = $path;

					/* return array($file['size'], $fileSize);
					die(); */
				/* echo $dirPath;
				return; */
				if (isset($file)) {
					if($file['size'] > $fileSize)
					{
						$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Document not uploaded. File size should not exceed '.(FILE_SIZE/(1024*1000)).' MB');
						
					} else if($file['tmp_name'] != '') {

						$fileNameParts = explode('.',$file['name']);

						if(count($fileNameParts) > 2)
						{
							$fileExtension = $fileNameParts[count($fileNameParts) - 1];
						}
						else
						{
							$fileExtension = $fileNameParts[1];
						}

						$fileArray = array('gif','jpeg','jpg','png', 'PNG');

						if(in_array($fileExtension, $fileArray))
						{
							$repArray = array('.',' ','-',',');
							$filename = str_replace('.'.$fileExtension, '', $file['name']);
							$filename = str_replace($repArray, '_', $filename);
							$cntFile = count(glob($dirPath."*"));
							$cntFile = $cntFile + 1;
							$filename = $filename.'_'.$cntFile.'.'.$fileExtension;
						
									
							if(move_uploaded_file($file['tmp_name'], $dirPath.$filename))
							{

								$file_target_file = $dirPath.$filename;
								$temp_target_file = $dirPath.$filename;

								$image_info = getimagesize($file_target_file); 
								$width_orig  = $image_info[0]; // current width as found in image file
								$height_orig = $image_info[1]; // current height as found in image file
								/* $width = 770; // new image width
								$height = 330; // new image height */
										
								if ($width < $width_orig || $height < $height_orig) {
									$height = round($height_orig * ($width/$width_orig));
								}
								$destination_image = imagecreatetruecolor($width, $height);
		//echo json_encode(array($width, $height));
								switch($fileExtension) {
										
									case 'jpeg':
									case 'jpg':
									
											$orig_image = imagecreatefromjpeg($temp_target_file);
											imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
											// This will just copy the new image over the original at the same filePath.
											imagejpeg($destination_image, $file_target_file, 100);
										
										break;
									case 'PNG':
									case 'png':
										
											$orig_image = imagecreatefrompng($temp_target_file);
											imagealphablending($destination_image, false);
											imagesavealpha($destination_image,true);
											$transparent = imagecolorallocatealpha($destination_image, 255, 255, 255, 127);
											imagefilledrectangle($destination_image, 0, 0, $width, $height, $transparent);
											imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
											// This will just copy the new image over the original at the same filePath.
											imagepng($destination_image, $file_target_file);
										
										break;
											
									case 'gif':
									
											$orig_image = imagecreatefromgif($temp_target_file);
											imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
											// This will just copy the new image over the original at the same filePath.
											imagegif($destination_image, $file_target_file, 100);
										
										break;
											
									}

									if($prevFile!='')	
									{
										unlink($path.$prevFile);
									}								
									
									$status = array('status' => 'success', 'type' => 'text-success', 'message' => 'Image uploaded.', 'file_name' => $filename);
							}
						} else {
							$formats = implode(',', $fileArray);
							$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Document not uploaded. Please upload file with '.$formats.' formats');
						}

					} else {
						$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Document not uploaded. File size should not exceed '.(FILE_SIZE/(1024*1000)).' MB');
					}

				} else {
					$status = array('status' => 'error', 'type' => 'text-danger', 'message' => 'Document not uploaded. File size should not exceed '.(FILE_SIZE/(1024*1000)).' MB');
				}
				return $status;
			}
			function removeImage($link)
			{
				unlink($link);
			}
	
	
		/* ================ Custom ========== */
		
		
		/* =============== Common Setup ================ */
		
		/* =============== Common Setup ================ */

		/* ====== Current Date ======= */
		function currDate() 
		{
			return date("Y-m-d");
		}
		/* ====== Current Date ======= */
		
		/* ====== Current Time ======= */
		function currTime() 
		{
			return date("h:i:s a");
		}
		/* ====== Current Time ======= */
		
		/* ====== Current Date & Time ======= */
		function currDateTime() 
		{
			return date("Y-m-d H:i:s");
		}
		/* ====== Current Date & Time ======= */
		
		/* ======== Get Date Format ======= */
		function getDateFormat($date, $format = 'Y-m-d H:i:s')
		{
			if($date!=null && $date!='')
			{
				return date($format, strtotime($date));
			}
			return '';
		}
		/* ======== Get Date Format ======= */
		
		/* ======= Get Client IP ===== */
		function getClientIP() 
		{
			$ipaddress = '';
			if (isset($_SERVER['HTTP_CLIENT_IP']))
			{
				$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			}
			else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else if(isset($_SERVER['HTTP_X_FORWARDED']))
			{
				$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			}
			else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			{
				$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			}
			else if(isset($_SERVER['HTTP_FORWARDED']))
			{
				$ipaddress = $_SERVER['HTTP_FORWARDED'];
			}
			else if(isset($_SERVER['REMOTE_ADDR']))
			{
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			}
			else
			{
				$ipaddress = 'UNKNOWN';
			}
			return $ipaddress;
		}
		/* ======= Get Client IP ===== */
		
		/* ======= Get Client Browser Info ===== */
		function getBrowserInfo() 
		{
			return $_SERVER['HTTP_USER_AGENT'];
		}
		/* ======= Get Client Browser Info ===== */
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/* ======= Get Page URL ====== */
		function getPageUrl() {
			$https = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')? 'https://' : 'http://';
			$hostname = $_SERVER['HTTP_HOST'].'/';
			
			$splitUrl = explode('?', $_SERVER['REQUEST_URI']);
			$url = '';
			if(count($splitUrl)>0 && isset($splitUrl[0])) {
				$requestURI = explode('/', $splitUrl[0]);
				foreach($requestURI as $val) {
					if($val!='') {
						$url .= $val.'/';
					}			
				}
				return $https.$hostname.$url;
			}
			return $https.$hostname.$_SERVER['REQUEST_URI'];
		}
		/* ======= Get Page URL ====== */

		function safeURL($string){
			$string = strtolower($string); // Makes everything lowercase (just looks tidier).
			$string = preg_replace('/[^a-z0-9]+/', '-', $string); // Replaces all non-alphanumeric characters with a hyphen.
			$string = preg_replace('/[-]{2,}/', '-', $string); // Replaces one or more occurrences of a hyphen, with a single one.
			$string = trim($string, '-'); // This ensures that our string doesn't start or end with a hyphen.
			return $string;
		}
		
		function redirect($path)
		{
			header("Location:".$path);
			die();
		}
		function logout()
		{
			header("Location:".ADMIN_URL.LOGOUT);
			die();
		}
		function toLower($str)
		{
			return strtolower($str);
		}
		function requiredSlug($queryString='', $slugId=0)
		{
			if($queryString!='' && $slugId>0)
			{
				$sArr = explode("/", $queryString);
				return (isset($sArr[$slugId]))? $sArr[$slugId] : '';
			}
			return '';
			
		}
		function splitString($text, $num=0) 
		{
			if($num>0) {
				$text = strip_tags($text);
				if(strlen($text)>$num) {
					$str = str_split($text, $num);
					return $str[0].'...';
				}
				return $text;
			}
			return $text;
		}
		
		
		/*
		*
		*
		*		
		======= Country Phone Code ============ */
		function phoneCodesList($phoneCode) {
		$phone_codes = '
			<option value="+91" '.(($phoneCode == "+91")? 'selected':'').'>IND +91</option>
			<option value="+376"'.(($phoneCode == "+376")? 'selected':'').'>AND  +376</option>
			<option value="+93"'.(($phoneCode == "+93")? 'selected':'').'>AFG  +93</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>ATG  +1</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>AIA  +1</option>
			<option value="+355"'.(($phoneCode == "+355")? 'selected':'').'>ALB  +355</option>
			<option value="+374"'.(($phoneCode == "+374")? 'selected':'').'>ARM  +374</option>
			<option value="+599"'.(($phoneCode == "+599")? 'selected':'').'>ANT  +599</option>
			<option value="+244"'.(($phoneCode == "+244")? 'selected':'').'>AGO  +244</option>
			<option value="+672"'.(($phoneCode == "+672")? 'selected':'').'>ATA  +672</option>
			<option value="+54"'.(($phoneCode == "+54")? 'selected':'').'>ARG  +54</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>ASM  +1</option>
			<option value="+43"'.(($phoneCode == "+43")? 'selected':'').'>AUT  +43</option>
			<option value="+61"'.(($phoneCode == "+61")? 'selected':'').'>AUS  +61</option>
			<option value="+297"'.(($phoneCode == "+297")? 'selected':'').'>ABW  +297</option>
			<option value="+358"'.(($phoneCode == "+358")? 'selected':'').'>ALA  +358</option>
			<option value="+994"'.(($phoneCode == "+994")? 'selected':'').'>AZE  +994</option>
			<option value="+387"'.(($phoneCode == "+387")? 'selected':'').'>BIH  +387</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>BRB  +1</option>
			<option value="+880"'.(($phoneCode == "+880")? 'selected':'').'>BGD  +880</option>
			<option value="+32"'.(($phoneCode == "+32")? 'selected':'').'>BEL  +32</option>
			<option value="+226"'.(($phoneCode == "+226")? 'selected':'').'>BFA  +226</option>
			<option value="+359"'.(($phoneCode == "+359")? 'selected':'').'>BGR  +359</option>
			<option value="+973"'.(($phoneCode == "+973")? 'selected':'').'>BHR  +973</option>
			<option value="+257"'.(($phoneCode == "+257")? 'selected':'').'>BDI  +257</option>
			<option value="+229"'.(($phoneCode == "+229")? 'selected':'').'>BEN  +229</option>
			<option value="+590"'.(($phoneCode == "+590")? 'selected':'').'>BLM  +590</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>BMU  +1</option>
			<option value="+673"'.(($phoneCode == "+673")? 'selected':'').'>BRN  +673</option>
			<option value="+591"'.(($phoneCode == "+591")? 'selected':'').'>BOL  +591</option>
			<option value="+599"'.(($phoneCode == "+599")? 'selected':'').'>BES  +599</option>
			<option value="+55"'.(($phoneCode == "+55")? 'selected':'').'>BRA  +55</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>BHS  +1</option>
			<option value="+975"'.(($phoneCode == "+975")? 'selected':'').'>BTN  +975</option>
			<option value="+267"'.(($phoneCode == "+267")? 'selected':'').'>BWA  +267</option>
			<option value="+375"'.(($phoneCode == "+375")? 'selected':'').'>BLR  +375</option>
			<option value="+501"'.(($phoneCode == "+501")? 'selected':'').'>BLZ  +501</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>CAN  +1</option>
			<option value="+243"'.(($phoneCode == "+243")? 'selected':'').'>COD  +243</option>
			<option value="+236"'.(($phoneCode == "+236")? 'selected':'').'>CAF  +236</option>
			<option value="+242"'.(($phoneCode == "+242")? 'selected':'').'>COG  +242</option>
			<option value="+41"'.(($phoneCode == "+41")? 'selected':'').'>CHE  +41</option>
			<option value="+225"'.(($phoneCode == "+225")? 'selected':'').'>CIV  +225</option>
			<option value="+682"'.(($phoneCode == "+682")? 'selected':'').'>COK  +682</option>
			<option value="+56"'.(($phoneCode == "+56")? 'selected':'').'>CHL  +56</option>
			<option value="+237"'.(($phoneCode == "+237")? 'selected':'').'>CMR  +237</option>
			<option value="+86"'.(($phoneCode == "+86")? 'selected':'').'>CHN  +86</option>
			<option value="+57"'.(($phoneCode == "+57")? 'selected':'').'>COL  +57</option>
			<option value="+506"'.(($phoneCode == "+506")? 'selected':'').'>CRI  +506</option>
			<option value="+53"'.(($phoneCode == "+53")? 'selected':'').'>CUB  +53</option>
			<option value="+238"'.(($phoneCode == "+238")? 'selected':'').'>CPV  +238</option>
			<option value="+599"'.(($phoneCode == "+599")? 'selected':'').'>CUW  +599</option>
			<option value="+61"'.(($phoneCode == "+61")? 'selected':'').'>CXR  +61</option>
			<option value="+357"'.(($phoneCode == "+357")? 'selected':'').'>CYP  +357</option>
			<option value="+420"'.(($phoneCode == "+420")? 'selected':'').'>CZE  +420</option>
			<option value="+49"'.(($phoneCode == "+49")? 'selected':'').'>DEU  +49</option>
			<option value="+253"'.(($phoneCode == "+253")? 'selected':'').'>DJI  +253</option>
			<option value="+45"'.(($phoneCode == "+45")? 'selected':'').'>DNK  +45</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>DMA  +1</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>DOM  +1</option>
			<option value="+213"'.(($phoneCode == "+213")? 'selected':'').'>DZA  +213</option>
			<option value="+593"'.(($phoneCode == "+593")? 'selected':'').'>ECU  +593</option>
			<option value="+372"'.(($phoneCode == "+372")? 'selected':'').'>EST  +372</option>
			<option value="+20"'.(($phoneCode == "+20")? 'selected':'').'>EGY  +20</option>
			<option value="+212"'.(($phoneCode == "+212")? 'selected':'').'>ESH  +212</option>
			<option value="+291"'.(($phoneCode == "+291")? 'selected':'').'>ERI  +291</option>
			<option value="+34"'.(($phoneCode == "+34")? 'selected':'').'>ESP  +34</option>
			<option value="+251"'.(($phoneCode == "+251")? 'selected':'').'>ETH  +251</option>
			<option value="+358"'.(($phoneCode == "+358")? 'selected':'').'>FIN  +358</option>
			<option value="+679"'.(($phoneCode == "+679")? 'selected':'').'>FJI  +679</option>
			<option value="+691"'.(($phoneCode == "+691")? 'selected':'').'>FSM  +691</option>
			<option value="+298"'.(($phoneCode == "+298")? 'selected':'').'>FRO  +298</option>
			<option value="+33"'.(($phoneCode == "+33")? 'selected':'').'>FRA  +33</option>
			<option value="+241"'.(($phoneCode == "+241")? 'selected':'').'>GAB  +241</option>
			<option value="+44"'.(($phoneCode == "+44")? 'selected':'').'>GBR  +44</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>GRD  +1</option>
			<option value="+995"'.(($phoneCode == "+995")? 'selected':'').'>GEO  +995</option>
			<option value="+594"'.(($phoneCode == "+594")? 'selected':'').'>GUF  +594</option>
			<option value="+44"'.(($phoneCode == "+44")? 'selected':'').'>GGY  +44</option>
			<option value="+233"'.(($phoneCode == "+233")? 'selected':'').'>GHA  +233</option>
			<option value="+350"'.(($phoneCode == "+350")? 'selected':'').'>GIB  +350</option>
			<option value="+299"'.(($phoneCode == "+299")? 'selected':'').'>GRL  +299</option>
			<option value="+220"'.(($phoneCode == "+220")? 'selected':'').'>GMB  +220</option>
			<option value="+224"'.(($phoneCode == "+224")? 'selected':'').'>GIN  +224</option>
			<option value="+590"'.(($phoneCode == "+590")? 'selected':'').'>GLP  +590</option>
			<option value="+240"'.(($phoneCode == "+240")? 'selected':'').'>GNQ  +240</option>
			<option value="+30"'.(($phoneCode == "+30")? 'selected':'').'>GRC  +30</option>
			<option value="+500"'.(($phoneCode == "+500")? 'selected':'').'>SGS  +500</option>
			<option value="+502"'.(($phoneCode == "+502")? 'selected':'').'>GTM  +502</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>GUM  +1</option>
			<option value="+245"'.(($phoneCode == "+245")? 'selected':'').'>GNB  +245</option>
			<option value="+592"'.(($phoneCode == "+592")? 'selected':'').'>GUY  +592</option>
			<option value="+852"'.(($phoneCode == "+852")? 'selected':'').'>HKG  +852</option>
			<option value="+504"'.(($phoneCode == "+504")? 'selected':'').'>HND  +504</option>
			<option value="+385"'.(($phoneCode == "+385")? 'selected':'').'>HRV  +385</option>
			<option value="+509"'.(($phoneCode == "+509")? 'selected':'').'>HTI  +509</option>
			<option value="+36"'.(($phoneCode == "+36")? 'selected':'').'>HUN  +36</option>
			<option value="+62"'.(($phoneCode == "+62")? 'selected':'').'>IDN  +62</option>
			<option value="+353"'.(($phoneCode == "+353")? 'selected':'').'>IRL  +353</option>
			<option value="+972"'.(($phoneCode == "+972")? 'selected':'').'>ISR  +972</option>
			<option value="+44"'.(($phoneCode == "+44")? 'selected':'').'>IMN  +44</option>
			<option value="+246"'.(($phoneCode == "+246")? 'selected':'').'>IOT  +246</option>
			<option value="+964"'.(($phoneCode == "+964")? 'selected':'').'>IRQ  +964</option>
			<option value="+98"'.(($phoneCode == "+98")? 'selected':'').'>IRN  +98</option>
			<option value="+354"'.(($phoneCode == "+354")? 'selected':'').'>ISL  +354</option>
			<option value="+39"'.(($phoneCode == "+39")? 'selected':'').'>ITA  +39</option>
			<option value="+44"'.(($phoneCode == "+44")? 'selected':'').'>JEY  +44</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>JAM  +1</option>
			<option value="+962"'.(($phoneCode == "+962")? 'selected':'').'>JOR  +962</option>
			<option value="+81"'.(($phoneCode == "+81")? 'selected':'').'>JPN  +81</option>
			<option value="+254"'.(($phoneCode == "+254")? 'selected':'').'>KEN  +254</option>
			<option value="+996"'.(($phoneCode == "+996")? 'selected':'').'>KGZ  +996</option>
			<option value="+855"'.(($phoneCode == "+855")? 'selected':'').'>KHM  +855</option>
			<option value="+686"'.(($phoneCode == "+686")? 'selected':'').'>KIR  +686</option>
			<option value="+269"'.(($phoneCode == "+269")? 'selected':'').'>COM  +269</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>KNA  +1</option>
			<option value="+850"'.(($phoneCode == "+850")? 'selected':'').'>PRK  +850</option>
			<option value="+82"'.(($phoneCode == "+82")? 'selected':'').'>KOR  +82</option>
			<option value="+965"'.(($phoneCode == "+965")? 'selected':'').'>KWT  +965</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>CYM  +1</option>
			<option value="+7"'.(($phoneCode == "+7")? 'selected':'').'>KAZ  +7</option>
			<option value="+856"'.(($phoneCode == "+856")? 'selected':'').'>LAO  +856</option>
			<option value="+961"'.(($phoneCode == "+961")? 'selected':'').'>LBN  +961</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>LCA  +1</option>
			<option value="+423"'.(($phoneCode == "+423")? 'selected':'').'>LIE  +423</option>
			<option value="+94"'.(($phoneCode == "+94")? 'selected':'').'>LKA  +94</option>
			<option value="+231"'.(($phoneCode == "+231")? 'selected':'').'>LBR  +231</option>
			<option value="+266"'.(($phoneCode == "+266")? 'selected':'').'>LSO  +266</option>
			<option value="+370"'.(($phoneCode == "+370")? 'selected':'').'>LTU  +370</option>
			<option value="+352"'.(($phoneCode == "+352")? 'selected':'').'>LUX  +352</option>
			<option value="+371"'.(($phoneCode == "+371")? 'selected':'').'>LVA  +371</option>
			<option value="+218"'.(($phoneCode == "+218")? 'selected':'').'>LBY  +218</option>
			<option value="+212"'.(($phoneCode == "+212")? 'selected':'').'>MAR  +212</option>
			<option value="+377"'.(($phoneCode == "+377")? 'selected':'').'>MCO  +377</option>
			<option value="+373"'.(($phoneCode == "+373")? 'selected':'').'>MDA  +373</option>
			<option value="+382"'.(($phoneCode == "+382")? 'selected':'').'>MNE  +382</option>
			<option value="+590"'.(($phoneCode == "+590")? 'selected':'').'>MAF  +590</option>
			<option value="+261"'.(($phoneCode == "+261")? 'selected':'').'>MDG  +261</option>
			<option value="+692"'.(($phoneCode == "+692")? 'selected':'').'>MHL  +692</option>
			<option value="+389"'.(($phoneCode == "+389")? 'selected':'').'>MKD  +389</option>
			<option value="+223"'.(($phoneCode == "+223")? 'selected':'').'>MLI  +223</option>
			<option value="+95"'.(($phoneCode == "+95")? 'selected':'').'>MMR  +95</option>
			<option value="+976"'.(($phoneCode == "+976")? 'selected':'').'>MNG  +976</option>
			<option value="+853"'.(($phoneCode == "+853")? 'selected':'').'>MAC  +853</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>MNP  +1</option>
			<option value="+596"'.(($phoneCode == "+596")? 'selected':'').'>MTQ  +596</option>
			<option value="+222"'.(($phoneCode == "+222")? 'selected':'').'>MRT  +222</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>MSR  +1</option>
			<option value="+356"'.(($phoneCode == "+356")? 'selected':'').'>MLT  +356</option>
			<option value="+230"'.(($phoneCode == "+230")? 'selected':'').'>MUS  +230</option>
			<option value="+960"'.(($phoneCode == "+960")? 'selected':'').'>MDV  +960</option>
			<option value="+265"'.(($phoneCode == "+265")? 'selected':'').'>MWI  +265</option>
			<option value="+52"'.(($phoneCode == "+52")? 'selected':'').'>MEX  +52</option>
			<option value="+60"'.(($phoneCode == "+60")? 'selected':'').'>MYS  +60</option>
			<option value="+258"'.(($phoneCode == "+258")? 'selected':'').'>MOZ  +258</option>
			<option value="+264"'.(($phoneCode == "+264")? 'selected':'').'>NAM  +264</option>
			<option value="+687"'.(($phoneCode == "+687")? 'selected':'').'>NCL  +687</option>
			<option value="+227"'.(($phoneCode == "+227")? 'selected':'').'>NER  +227</option>
			<option value="+672"'.(($phoneCode == "+672")? 'selected':'').'>NFK  +672</option>
			<option value="+234"'.(($phoneCode == "+234")? 'selected':'').'>NGA  +234</option>
			<option value="+505"'.(($phoneCode == "+505")? 'selected':'').'>NIC  +505</option>
			<option value="+31"'.(($phoneCode == "+31")? 'selected':'').'>NLD  +31</option>
			<option value="+47"'.(($phoneCode == "+47")? 'selected':'').'>NOR  +47</option>
			<option value="+977"'.(($phoneCode == "+977")? 'selected':'').'>NPL  +977</option>
			<option value="+674"'.(($phoneCode == "+674")? 'selected':'').'>NRU  +674</option>
			<option value="+683"'.(($phoneCode == "+683")? 'selected':'').'>NIU  +683</option>
			<option value="+64"'.(($phoneCode == "+64")? 'selected':'').'>NZL  +64</option>
			<option value="+968"'.(($phoneCode == "+968")? 'selected':'').'>OMN  +968</option>
			<option value="+507"'.(($phoneCode == "+507")? 'selected':'').'>PAN  +507</option>
			<option value="+51"'.(($phoneCode == "+51")? 'selected':'').'>PER  +51</option>
			<option value="+689"'.(($phoneCode == "+689")? 'selected':'').'>PYF  +689</option>
			<option value="+675"'.(($phoneCode == "+675")? 'selected':'').'>PNG  +675</option>
			<option value="+63"'.(($phoneCode == "+63")? 'selected':'').'>PHL  +63</option>
			<option value="+92"'.(($phoneCode == "+92")? 'selected':'').'>PAK  +92</option>
			<option value="+48"'.(($phoneCode == "+48")? 'selected':'').'>POL  +48</option>
			<option value="+508"'.(($phoneCode == "+508")? 'selected':'').'>SPM  +508</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>PRI  +1</option>
			<option value="+970"'.(($phoneCode == "+970")? 'selected':'').'>PSE  +970</option>
			<option value="+351"'.(($phoneCode == "+351")? 'selected':'').'>PRT  +351</option>
			<option value="+680"'.(($phoneCode == "+680")? 'selected':'').'>PLW  +680</option>
			<option value="+595"'.(($phoneCode == "+595")? 'selected':'').'>PRY  +595</option>
			<option value="+974"'.(($phoneCode == "+974")? 'selected':'').'>QAT  +974</option>
			<option value="+262"'.(($phoneCode == "+262")? 'selected':'').'>REU  +262</option>
			<option value="+40"'.(($phoneCode == "+40")? 'selected':'').'>ROU  +40</option>
			<option value="+381"'.(($phoneCode == "+381")? 'selected':'').'>SRB  +381</option>
			<option value="+7"'.(($phoneCode == "+7")? 'selected':'').'>RUS  +7</option>
			<option value="+250"'.(($phoneCode == "+250")? 'selected':'').'>RWA  +250</option>
			<option value="+966"'.(($phoneCode == "+966")? 'selected':'').'>SAU  +966</option>
			<option value="+677"'.(($phoneCode == "+677")? 'selected':'').'>SLB  +677</option>
			<option value="+248"'.(($phoneCode == "+248")? 'selected':'').'>SYC  +248</option>
			<option value="+249"'.(($phoneCode == "+249")? 'selected':'').'>SDN  +249</option>
			<option value="+46"'.(($phoneCode == "+46")? 'selected':'').'>SWE  +46</option>
			<option value="+65"'.(($phoneCode == "+65")? 'selected':'').'>SGP  +65</option>
			<option value="+290"'.(($phoneCode == "+290")? 'selected':'').'>SHN  +290</option>
			<option value="+386"'.(($phoneCode == "+386")? 'selected':'').'>SVN  +386</option>
			<option value="+47"'.(($phoneCode == "+47")? 'selected':'').'>SJM  +47</option>
			<option value="+421"'.(($phoneCode == "+421")? 'selected':'').'>SVK  +421</option>
			<option value="+232"'.(($phoneCode == "+232")? 'selected':'').'>SLE  +232</option>
			<option value="+378"'.(($phoneCode == "+378")? 'selected':'').'>SMR  +378</option>
			<option value="+221"'.(($phoneCode == "+221")? 'selected':'').'>SEN  +221</option>
			<option value="+252"'.(($phoneCode == "+252")? 'selected':'').'>SOM  +252</option>
			<option value="+597"'.(($phoneCode == "+597")? 'selected':'').'>SUR  +597</option>
			<option value="+211"'.(($phoneCode == "+211")? 'selected':'').'>SSD  +211</option>
			<option value="+239"'.(($phoneCode == "+239")? 'selected':'').'>STP  +239</option>
			<option value="+503"'.(($phoneCode == "+503")? 'selected':'').'>SLV  +503</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>SXM  +1</option>
			<option value="+963"'.(($phoneCode == "+963")? 'selected':'').'>SYR  +963</option>
			<option value="+268"'.(($phoneCode == "+268")? 'selected':'').'>SWZ  +268</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>TCA  +1</option>
			<option value="+235"'.(($phoneCode == "+235")? 'selected':'').'>TCD  +235</option>
			<option value="+228"'.(($phoneCode == "+228")? 'selected':'').'>TGO  +228</option>
			<option value="+66"'.(($phoneCode == "+66")? 'selected':'').'>THA  +66</option>
			<option value="+992"'.(($phoneCode == "+992")? 'selected':'').'>TJK  +992</option>
			<option value="+690"'.(($phoneCode == "+690")? 'selected':'').'>TKL  +690</option>
			<option value="+670"'.(($phoneCode == "+670")? 'selected':'').'>TLS  +670</option>
			<option value="+993"'.(($phoneCode == "+993")? 'selected':'').'>TKM  +993</option>
			<option value="+216"'.(($phoneCode == "+216")? 'selected':'').'>TUN  +216</option>
			<option value="+676"'.(($phoneCode == "+676")? 'selected':'').'>TON  +676</option>
			<option value="+90"'.(($phoneCode == "+90")? 'selected':'').'>TUR  +90</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>TTO  +1</option>
			<option value="+688"'.(($phoneCode == "+688")? 'selected':'').'>TUV  +688</option>
			<option value="+886"'.(($phoneCode == "+886")? 'selected':'').'>TWN  +886</option>
			<option value="+255"'.(($phoneCode == "+255")? 'selected':'').'>TZA  +255</option>
			<option value="+971"'.(($phoneCode == "+971")? 'selected':'').'>UAE  +971</option>
			<option value="+380"'.(($phoneCode == "+380")? 'selected':'').'>UKR  +380</option>
			<option value="+256"'.(($phoneCode == "+256")? 'selected':'').'>UGA  +256</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>USA  +1</option>
			<option value="+598"'.(($phoneCode == "+598")? 'selected':'').'>URY  +598</option>
			<option value="+998"'.(($phoneCode == "+998")? 'selected':'').'>UZB  +998</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>VCT  +1</option>
			<option value="+58"'.(($phoneCode == "+58")? 'selected':'').'>VEN  +58</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>VGB  +1</option>
			<option value="+1"'.(($phoneCode == "+1")? 'selected':'').'>VIR  +1</option>
			<option value="+84"'.(($phoneCode == "+84")? 'selected':'').'>VNM  +84</option>
			<option value="+678"'.(($phoneCode == "+678")? 'selected':'').'>VUT  +678</option>
			<option value="+681"'.(($phoneCode == "+681")? 'selected':'').'>WLF  +681</option>
			<option value="+685"'.(($phoneCode == "+685")? 'selected':'').'>WSM  +685</option>
			<option value="+967"'.(($phoneCode == "+967")? 'selected':'').'>YEM  +967</option>
			<option value="+262"'.(($phoneCode == "+262")? 'selected':'').'>MYT  +262</option>
			<option value="+27"'.(($phoneCode == "+27")? 'selected':'').'>ZAF  +27</option>
			<option value="+260"'.(($phoneCode == "+260")? 'selected':'').'>ZMB  +260</option>
			<option value="+263"'.(($phoneCode == "+263")? 'selected':'').'>ZWE  +263</option>';
		return $phone_codes;
	}
	
		/* ======= Country Phone Code ============ */
		function resizeImage($SrcImage,$DestImage, $thumb_width,$thumb_height,$Quality)
		{
			list($width,$height,$type) = getimagesize($SrcImage);
			switch(strtolower(image_type_to_mime_type($type)))
			{
				case 'image/gif':
					$NewImage = imagecreatefromgif($SrcImage);
					break;
				case 'image/png':
					$NewImage = imagecreatefrompng($SrcImage);
					break;
				case 'image/jpeg':
					$NewImage = imagecreatefromjpeg($SrcImage);
					break;
				default:
					return false;
					break;
			}
			$original_aspect = $width / $height;
			$positionwidth = 0;
			$positionheight = 0;
			if($original_aspect > 1)    
			{
				$new_width = $thumb_width;
				$new_height = $new_width/$original_aspect;
				while($new_height > $thumb_height) {
					$new_height = $new_height - 0.001111;
					$new_width  = $new_height * $original_aspect;
					while($new_width > $thumb_width) {
						$new_width = $new_width - 0.001111;
						$new_height = $new_width/$original_aspect;
					}

				}
			} 
			else 
			{
				$new_height = $thumb_height;
				$new_width = $new_height/$original_aspect;
				while($new_width > $thumb_width) {
					$new_width = $new_width - 0.001111;
					$new_height = $new_width/$original_aspect;
					while($new_height > $thumb_height) {
						$new_height = $new_height - 0.001111;
						$new_width  = $new_height * $original_aspect;
					}
				}
			}
			if($width < $new_width && $height < $new_height)
			{
				$new_width = $width;
				$new_height = $height;
				$positionwidth = ($thumb_width - $new_width) / 2;
				$positionheight = ($thumb_height - $new_height) / 2;
			}
			elseif($width < $new_width && $height > $new_height)
			{
				$new_width = $width;
				$positionwidth = ($thumb_width - $new_width) / 2;
				$positionheight = 0;
			}
			elseif($width > $new_width && $height < $new_height)
			{
				$new_height = $height;
				$positionwidth = 0;
				$positionheight = ($thumb_height - $new_height) / 2;
			} 
			elseif($width > $new_width && $height > $new_height)
			{
				if($new_width < $thumb_width) 
				{
					$positionwidth = ($thumb_width - $new_width) / 2;
				} 
				elseif($new_height < $thumb_height) 
				{
					$positionheight = ($thumb_height - $new_height) / 2;
				}
			}
			$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
			/********************* FOR WHITE BACKGROUND  *************************/
				$white = imagecolorallocate($thumb, 255,255,255);
				imagefill($thumb, 0, 0, $white);
			/********************* FOR WHITE BACKGROUND  *************************/
			if(imagecopyresampled($thumb, $NewImage,$positionwidth, $positionheight,0, 0, $new_width, $new_height, $width, $height)) {
				if(imagejpeg($thumb,$DestImage,$Quality)) {
					imagedestroy($thumb);
					return true;
				}
			}
		}
		function resize($source,$destination,$newWidth,$newHeight)
		{
			ini_set('max_execution_time', 0);
			$ImagesDirectory = $source;
			$DestImagesDirectory = $destination;
			$NewImageWidth = $newWidth;
			$NewImageHeight = $newHeight;
			$Quality = 100;
			$imagePath = $ImagesDirectory;
			$destPath = $DestImagesDirectory;
			$checkValidImage = getimagesize($imagePath);
			if(file_exists($imagePath) && $checkValidImage)
			{
				if($this->resizeImage($imagePath,$destPath,$NewImageWidth,$NewImageHeight,$Quality))
				{
					//echo " --> ".$source.'  --> Resize Successful!<BR><BR>';
				}
				else
				{
					echo " --> ".$source.'  --> Resize Failed!<BR><BR>';
				}
			}
			return $source;
		}
		/* function getDirContents($filter = '', &$results = array(), $imgPath = '', $width = 0, $height = 0) 
		{
			$results = array();
			if($imgPath!='' && $width>0 && $height>0)
			{
				// Source FOLDER
				$files = scandir($imgPath);
				$fileCount = 1;
				foreach($files as $key => $value){
					$ext = explode(".",$value);
					$fname = $ext[0].round(microtime(true)*1000);
					$filename = $fname.".".$ext[1];
					// Source PATH
					$path = realpath($imgPath.$value); 

					if(!is_dir($path)) {
						if(empty($filter) || preg_match($filter, $path)){ 
							echo "Image # ".$fileCount;
							$results[] = $path;
							// Destination PATH
							$destination = $imgPath.$value;

							// Change the desired "WIDTH" and "HEIGHT"
							$newWidth = $width; //400; // Desired WIDTH
							$newHeight = $height; //350; // Desired HEIGHT

							$this->resize($path,$destination,$newWidth,$newHeight);
							$fileCount++;
						}
					} elseif($value != "." && $value != "..") {
						$this->getDirContents($path, $filter, $results);
					}
				}
			}
			return $results;
		} */
		
		
		function removeExistingImage($existedFileDetails='', $path = '', $folder = '')
		{
			if($existedFileDetails!='' && $path!='')
			{
				$target_dir = $path.$folder;
				if(!is_dir($target_dir)) {
					mkdir($target_dir, true); 
					chmod($target_dir, 0777);
				}
				$remove_file = $target_dir.basename($existedFileDetails);
				if (file_exists($remove_file)) {
					unlink($remove_file);
				}
			}
		}
		function imageCopyToRequiredPath($target_file = '', $existedFileDetails='', $target_dir = '', $folder = '', $file_name = '', $imageFileType = '', $file_tmp = '', $requiredSizes = array())
		{
			$imgsArray = array('image_large' => '', 'image_medium' => '', 'image_small' => '', 'image_thumbnail' => '');
			$mimitypes = array('jpg', 'jpeg', 'png');
			$original_target_dir = $target_dir;
			$target_dir = $target_dir.$folder;
			if (file_exists($target_file)) {
				$nameArr = explode(".", $file_name);
				$file_name = $nameArr[0].'_'.date('U').'.'.$imageFileType;
				$target_file = $target_dir.basename($file_name);
			}
			
			if(in_array($imageFileType, $mimitypes)) 
			{
				move_uploaded_file($file_tmp,$target_file);	
				$this->removeExistingImage($existedFileDetails, $original_target_dir, LARGE_FOLDER);
				if(count($requiredSizes)>0)
				{			
					foreach($requiredSizes as $key => $sizes)
					{
						$destinationPath = $imgPath = $original_target_dir.$sizes['folder'].$file_name;
						copy($target_file , $imgPath);
						$this->resize($imgPath, $destinationPath, $sizes['width'], $sizes['height']);
						$this->removeExistingImage($existedFileDetails, $original_target_dir, $sizes['folder']);
					}
				}				
			}
			return $file_name;
		}
		function imageUpload($files, $existedFileDetails='', $path='', $folder='', $requiredSizes = array()) 
		{
			
			$mimitypes = array('jpg', 'jpeg', 'png');		

			$target_dir = $path.$folder;
			$file_tmp = $files["tmp_name"];
			$file_name = $files["name"];
			$target_file = $target_dir.basename($file_name);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
			$file_name = $this->imageCopyToRequiredPath($target_file, $existedFileDetails, $path, $folder, $file_name, $imageFileType, $file_tmp, $requiredSizes);
			return $file_name;
		}
	
		function imageUploadAndResize($files, $existedFileDetails, $path = '', $requiredSizes = array()) 
		{
			$file_name = '';
			if($path!='')
			{			
				$file_name =$this->imageUpload($files, $existedFileDetails, $path, LARGE_FOLDER, $requiredSizes);
			}
			return $file_name;
		}
		
		function removeGalleryImages($foldersList = array(), $existedFileDetails = '', $original_target_dir = '')
		{
			if(count($foldersList)>0 && $original_target_dir!='' && $existedFileDetails!='')
			{			
				foreach($foldersList as $folder)
				{
					$this->removeExistingImage($existedFileDetails, $original_target_dir, $folder);
				}
			}
		}

		function sendEnquiryMail($data=array(), $isAlert=false)
		{
			if(count($data)>0)
			{
				$name = (isset($data['name']) && $data['name'])? $data['name'] : '';
				$email = ((isset($data['email']) && $data['email']!='')? trim($data['email']) : '');
				$phone = ((isset($data['phone']) && $data['phone']!='')? $data['phone'] : '');
				$message = trim($data['message']);
				$date = date("Y-m-d H:i:s");

				if($email!='' || $phone!='') 
				{
					/* $mail_body="<style type='text/css'>
					body,td,th { font-family: Verdana; font-size:12px; color:#333333; }
					.borblue{ border-bottom: 2px solid #CCCCCC; }
					.topblue{ border-top: 2px solid #CCCCCC; }
					.textfont{ font-family:Verdana; font-size:13px; color:#000000; padding-left:10px; line-height:28px;}
					.givendata{ font-family:Verdana; font-size:12px; font-size:bold; color:#ffffff;}
					.tdbg{ background-color:#44AFD5; }
					.heading{ color:#5C5C5C; background-color:#F2FBFF; font-size:12px;padding-left:8px;}
					.color{ color:black;}
					</style>
					
					<table width='600' border='0' align='center' cellpadding='0' cellspacing='0'>
					  <tr>
						<td colspan='2' align='center' valign='top' bgcolor='#F2F2F2'>  
						<table width='600'  border='0' align='center' cellpadding='3' cellspacing='0' class='borblue'>
						  <tr bgcolor='#C50909' height='30'>
						<td colspan='3' align='left' valign='middle' bgcolor='#C50909' style='color:#FFF; font:bold 14px Verdana, Arial, Helvetica, sans-serif'>&nbsp;Enquiry Details From AdMaiora WWTP Components Agency</td>
						  </tr>
						  <tr >
							<td width='25%' align='left'  class='textfont'>Name</td>
							<td width='5%' align='center'><strong>:</strong></td>
							<td align='left' class='color'>".$name."</td>
						  </tr>
						  <tr >
							<td width='25%' align='left'  class='textfont'>E-Mail</td>
							<td width='5%' align='center'><strong>:</strong></td>
							<td align='left' class='color'>".$email."</td>
						  </tr>
						  <tr >
							<td width='25%' align='left'  class='textfont'>Phone</td>
							<td width='5%' align='center'><strong>:</strong></td>
							<td align='left' class='color'> ".$phone."</td>
						  </tr>
						  <!--<tr >
							<td width='25%' align='left'  class='textfont'>Subject</td>
							<td width='5%' align='center'><strong>:</strong></td>
							<td align='left' class='color'>".$subject."</td>
						  </tr>-->
						  <tr >
							<td width='25%' align='left' valign='top' class='textfont'>Message</td>
							<td width='5%' align='center' valign='top'><strong>:</strong></td>
							<td align='justify' class='color'>".$message."</td>
						  </tr>
						  </table></td>
					  </tr>
					</table>"; 

					//$mailto = "admaiorastatystics@gmail.com";
					$mailto = "vjpithani@gmail.com";
					$mailheader = 'MIME-Version: 1.0' . "\r\n";
					$mailheader.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$mailheader.="From: ".$name." <".$email.">\r\n";
					if(!$isAlert)
					{
						$message="Enquiry Details From AdMaiora WWTP Components Agency";
					}
					else
					{
						$message="Enquiry Alert From AdMaiora WWTP Components Agency";
					}
					@mail($mailto,$message,$mail_body,$mailheader);
					
					return true; */
				}
			}
			return false;
		}
	}
?>