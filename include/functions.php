<?php

////////////////////////////////////////////////////////////////////////////////
//// -------- v1.03 April 2016 ---------------------------------------------////
//// -------- www.anamorphics.com ------------------------------------------////
//// -------- © Anamorphics CMS. -------------------------------------------////
////////////////////////////////////////////////////////////////////////////////


if( ! ini_get('date.timezone')){ date_default_timezone_set('America/Phoenix'); }
require 'db.php';



//////////////////////////////////////////////////////////////////////////////////////////////////
//// Parse Values for save JSON formatting
function parse($text) {
    // Damn pesky carriage returns...
    $text = str_replace("\r\n", "<br/>", $text);
    $text = str_replace("\r", "<br/>", $text);
    $text = str_replace("\n", "<br/>", $text);
    return $text;
}
//// Parse Values for the CMS (so you don't have to deal with code)
function parseCMS($text) {
    // Damn pesky carriage returns...
    $text = str_replace("<br/>", "\n", $text);
    return $text;
}


//////////////////////////////////////////////////////////////////////////////////////////////////
//// Parse space out of code-textfields from CMS
function enableCodeCMS($text) {
    // Damn pesky carriage returns...
    $text = htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n","<br/>","<br />","<br>"), "", $text));
    return $text;
}



//////////////////////////////////////////////////////////////////////////////////////////////////
//// Grab items from table and store in numbered array - returns array
function grabItems($sql_tablename, $sql_where, $sql_orderby, $sql_tablefields){
	//// Build the query string
	$sql_select ='';
	foreach ($sql_tablefields as $sql_fieldname){
		$sql_select .= $sql_fieldname.', ';
	}
	$sql_select = substr($sql_select,0,-2);

	//// Send the query
	$sql_query = @mysql_query("SELECT $distinct $sql_select FROM $sql_tablename $sql_where $sql_orderby");
	if (!$sql_query) {exit('<p><b>Error performing query: ' . mysql_error() . '</b></p><hr align="left" width="100%" size="1" noshade>');}

	//// Store all the results in the array called $items
	$items = array();
	$count = 0;
	while ($row = mysql_fetch_array($sql_query)) {
		foreach ($sql_tablefields as $sql_fieldname){

			/////////////////////////////////////////////
			# NOTE: This checks to see if you had to use p.fieldname in your query, and removes the 'p.'
			# Be aware that this can lead to duplicate fieldnames
			# This will probably work 99% of the time
			# At this time I am not sure how to make this prettier
			if (strrchr($sql_fieldname,'.') !== false){
				$cleaner = explode('.',$sql_fieldname);
				$sql_fieldname = $cleaner[1];
			}
			////////////////////////////////////////////

			$items[$count][$sql_fieldname] = parse(htmlspecialchars(stripslashes(CleanupSmartQuotes($row[$sql_fieldname]))));
			// OG ----> $items[$count][$sql_fieldname] = htmlspecialchars(stripslashes(CleanupSmartQuotes($row[$sql_fieldname])));
		}
		$count++;
	}
	return $items;
}




//////////////////////////////////////////////////////////////////////////////////////////////////
//// Grab items from table and store in numbered array - returns array
function grabItemsDistinct($sql_tablename, $sql_where, $sql_orderby, $sql_tablefields){
	//// Build the query string
	$sql_select ='';
	foreach ($sql_tablefields as $sql_fieldname){
		$sql_select .= $sql_fieldname.', ';
	}
	$sql_select = substr($sql_select,0,-2);

	//// Send the query
	$sql_query = @mysql_query("SELECT DISTINCT $distinct $sql_select FROM $sql_tablename $sql_where $sql_orderby");
	if (!$sql_query) {exit('<p><b>Error performing query: ' . mysql_error() . '</b></p><hr align="left" width="100%" size="1" noshade>');}

	//// Store all the results in the array called $items
	$items = array();
	$count = 0;
	while ($row = mysql_fetch_array($sql_query)) {
		foreach ($sql_tablefields as $sql_fieldname){

			/////////////////////////////////////////////
			# NOTE: This checks to see if you had to use p.fieldname in your query, and removes the 'p.'
			# Be aware that this can lead to duplicate fieldnames
			# This will probably work 99% of the time
			# At this time I am not sure how to make this prettier
			if (strrchr($sql_fieldname,'.') !== false){
				$cleaner = explode('.',$sql_fieldname);
				$sql_fieldname = $cleaner[1];
			}
			////////////////////////////////////////////

			$items[$count][$sql_fieldname] = parse(htmlspecialchars(stripslashes(CleanupSmartQuotes($row[$sql_fieldname]))));
			// OG ----> $items[$count][$sql_fieldname] = htmlspecialchars(stripslashes(CleanupSmartQuotes($row[$sql_fieldname])));
		}
		$count++;
	}
	return $items;
}






//////////////////////////////////////////////////////////////////////////////////////////////////
//// Update Table - returns yes/no/error
function updateItem($sql_tablename, $sql_type, $sql_tablefields, $post, $update){
	//// New or Update
	if ($update == 'new') {
		$sql_type  	= 'INSERT INTO '.$sql_tablename.' SET ';
		$sql_where  = '';
	}	else {
		$sql_type		= 'UPDATE '.$sql_tablename.' SET ';
		$sql_where  = ' WHERE 1 AND id='.$update;
	}

	//// Build the query string
	$sql_select ='';
	foreach ($sql_tablefields as $sql_fieldname){
		$sql_select .= $sql_fieldname.'=\''.addslashes(FixSmartQuotes($post[$sql_fieldname])).'\', ';
		//$sql_select .= $sql_fieldname.'=\''.addslashes(str_replace( parse_url( $post[$sql_fieldname], PHP_URL_SCHEME ) . '://', '', $post[$sql_fieldname] )).'\', ';
	}
	$sql_select = substr($sql_select,0,-2);
	$sql_select = preg_replace("/id='', /", ' ', $sql_select);

	//// Send the query
	$sql_query = @mysql_query("$sql_type $sql_select $sql_where");
	if (!$sql_query) { exit('<p><b>Error performing query: ' . mysql_error() . '</b></p><hr align="left" width="100%" size="1" noshade>'. $sql_type.$sql_select.$sql_where); } else { $updateResponse = true; }

	return $updateResponse;
}



//////////////////////////////////////////////////////////////////////////////////////////////////
//// Photo Processing
function processPhoto($photos_uploaded, $actionID, $sql_tablename, $photo_dimensions, $images_dir, $photo_aspect){
	# List of our known photo types
	$known_photo_types = array(
											'image/pjpeg' => 'jpg',
											'image/jpeg' 	=> 'jpg',
											'image/gif' 	=> 'gif',
											'image/bmp' 	=> 'bmp',
											'image/x-png' => 'png'
											);

	# GD Function List
	$gd_function_suffix = array(
											'image/pjpeg' => 'JPEG',
											'image/jpeg' 	=> 'JPEG',
											'image/gif' 	=> 'GIF',
											'image/bmp' 	=> 'WBMP',
											'image/x-png' => 'PNG'
											);

	//////// Process
	if($photos_uploaded['size'] > 0) {
		if(!array_key_exists($photos_uploaded['type'], $known_photo_types)) {
			$sqlfeedback .= "Photo did not meet required filetype.<br />";
		} else {

			$filetype 	= $photos_uploaded['type'];
			$extention 	= $known_photo_types[$filetype];
			$filename 	= $actionID . "." . $extention;

			mysql_query( "UPDATE ".$sql_tablename." SET main='".$actionID."' WHERE id=". $actionID .";" );

			copy($photos_uploaded['tmp_name'], $images_dir."/".$filename);

			//// ------------------- CREATE IMAGE - Thumbnail -------------------------- ////
			$size = GetImageSize( $images_dir."/".$filename ); // 0=width 1=height

			$function_suffix = $gd_function_suffix[$filetype];
			$function_to_read = "ImageCreateFrom".$function_suffix;
			$function_to_write = "Image".$function_suffix;

			$source_handle = $function_to_read ( $images_dir."/".$filename );

			//// ------------------- USE ASPECT RATIO SCALING (uses dimensions as limits)
			if ($photo_aspect != 'fixed'){

				if($size[0] > $size[1]) {
					$display_width = $photo_dimensions['w_thumb'];
					$display_height = (int)($photo_dimensions['w_thumb'] * $size[1] / $size[0]);
				} else {
					$display_width = (int)($photo_dimensions['h_thumb'] * $size[0] / $size[1]);
					$display_height = $photo_dimensions['h_thumb'];
				}

				if($source_handle) {
					$destination_handle = ImageCreateTrueColor ( $display_width, $display_height );
					ImageCopyResampled( $destination_handle, $source_handle, 0, 0, 0, 0, $display_width, $display_height, $size[0], $size[1] );
				}

			//// ------------------- USE STRETCHLESS CROP SCALING (uses exact dimensions, no stretch)
			} else {

				$nw = $photo_dimensions['w_thumb'];
				$nh = $photo_dimensions['h_thumb'];
				$w = $size[0];
				$h = $size[1];
				$wm = $w/$nw;
				$hm = $h/$nh;
				$h_height = $nh/2;
				$w_height = $nw/2;

				if ($w > $h){
					$adjusted_width = $w / $hm;
					$half_width = $adjusted_width / 2;
					$int_width = $half_width - $w_height;

					if($source_handle) {
						$destination_handle = ImageCreateTrueColor ( $nw, $nh );
						ImageCopyResampled( $destination_handle, $source_handle, -$int_width, 0, 0, 0, $adjusted_width, $nh, $w, $h );
					}
				} elseif(($w < $h) || ($w == $h)){
					$adjusted_height = $h /$wm;
					$half_height = $adjusted_height / 2;
					$int_height = $half_height - $h_height;

					if($source_handle) {
						$destination_handle = ImageCreateTrueColor ( $nw, $nh );
						ImageCopyResampled( $destination_handle, $source_handle, 0, -$int_height, 0, 0, $nw, $adjusted_height, $w, $h );
					}
				} else {
					if($source_handle) {
						$destination_handle = ImageCreateTrueColor ( $nw, $nh );
						ImageCopyResampled( $destination_handle, $source_handle, 0, 0, 0, 0, $nw, $h, $w, $h );
					}
				}
			}

			$function_to_write( $destination_handle, $images_dir.'/'.$actionID.'_thumb.'.$extention, 95 );
			ImageDestroy($destination_handle );


			//// ------------------- CREATE IMAGE - Display Size ----------------------- ////
			$size = GetImageSize( $images_dir."/".$filename ); // 0=width 1=height

			$function_suffix = $gd_function_suffix[$filetype];
			$function_to_read = "ImageCreateFrom".$function_suffix;
			$function_to_write = "Image".$function_suffix;

			$source_handle = $function_to_read ( $images_dir."/".$filename );

			//// ------------------- USE ASPECT RATIO SCALING
			if ($photo_aspect != 'fixed'){

				if($size[0] > $size[1]) {
					$display_width = $photo_dimensions['w_large'];
					$display_height = (int)($photo_dimensions['w_large'] * $size[1] / $size[0]);
				} else {
					$display_width = (int)($photo_dimensions['h_large'] * $size[0] / $size[1]);
					$display_height = $photo_dimensions['h_large'];
				}

				if($source_handle) {
					$destination_handle = ImageCreateTrueColor ( $display_width, $display_height );
					ImageCopyResampled( $destination_handle, $source_handle, 0, 0, 0, 0, $display_width, $display_height, $size[0], $size[1] );
				}

			//// ------------------- USE STRETCHLESS CROP SCALING
			} else {

				$nw = $photo_dimensions['w_large'];
				$nh = $photo_dimensions['h_large'];
				$w = $size[0];
				$h = $size[1];
				$wm = $w/$nw;
				$hm = $h/$nh;
				$h_height = $nh/2;
				$w_height = $nw/2;

				if ($w > $h){
					$adjusted_width = $w / $hm;
					$half_width = $adjusted_width / 2;
					$int_width = $half_width - $w_height;

					if($source_handle) {
						$destination_handle = ImageCreateTrueColor ( $nw, $nh );
						ImageCopyResampled( $destination_handle, $source_handle, -$int_width, 0, 0, 0, $adjusted_width, $nh, $w, $h );
					}
				} elseif(($w < $h) || ($w == $h)){
					$adjusted_height = $h /$wm;
					$half_height = $adjusted_height / 2;
					$int_height = $half_height - $h_height;

					if($source_handle) {
						$destination_handle = ImageCreateTrueColor ( $nw, $nh );
						ImageCopyResampled( $destination_handle, $source_handle, 0, -$int_height, 0, 0, $nw, $adjusted_height, $w, $h );
					}
				} else {
					if($source_handle) {
						$destination_handle = ImageCreateTrueColor ( $nw, $nh );
						ImageCopyResampled( $destination_handle, $source_handle, 0, 0, 0, 0, $nw, $h, $w, $h );
					}
				}
			}

			$function_to_write( $destination_handle, $images_dir.'/'.$actionID.'_large.'.$extention, 95 );
			ImageDestroy($destination_handle );


			//////// Destroy the original file
			unlink($images_dir."/".$filename);

			//// Provide some feedback
			if (file_exists($images_dir.'/'.$actionID.'_large.'.$extention)){
				return '<div class="success">Photo processed.</div>';
			} else {
				return '<div class="error">Photo processing error!</div>';
			}
		}
	}
}



//////////////////////////////////////////////////////////////////////////////////////////////////
//// File Uploads
function UploadFile($filename, $upload_directory, $id, $files_dir, $sql_tablename){
	if($filename['size'] > 0) {
		$filename_clean = strtolower($filename['name']);
		$filename_clean = preg_replace("/\s+/i", "_", $filename_clean);
		$filename_clean = preg_replace("/\"/i", "", 	$filename_clean);
		$filename_clean = preg_replace("/\\\'/i", "", $filename_clean);
		$filename_clean = preg_replace("/\?/i", "", 	$filename_clean);
		$filename_clean = preg_replace("/\</i", "", 	$filename_clean);
		$filename_clean = preg_replace("/\//i", "-", 	$filename_clean);

		//// ------------------- create unique filename using date and sql ID
		$ext = explode('.', $filename_clean);
		$filename_final = $ext[0] . date("_ymd") . 'id' . $id . '.' . $ext[1];
		$uploadfile =  $files_dir. '/' . $filename_final;

		//// ------------------- delete pre-existing file
		//$sql = 'SELECT filename FROM '.$sql_tablename.' WHERE id=' . $id;
		//$result = mysql_query($sql);
		//$row = mysql_fetch_array($result);
		//if (isset($row[0])) unlink($files_dir. "/" .$row[0]);

		//// ------------------- Upload & Add Filename into DB then provide feedback
		if (move_uploaded_file($filename['tmp_name'], $uploadfile)) {
			mysql_query( "UPDATE ".$sql_tablename." SET filename1='".$filename_final."' WHERE id=". $id .";" );
			return '<div class="success">Upload processed.</div>';
		} else {
			echo "error: file upload failed. " . $_FILES['file']['error'];
			return '<div class="error">Upload processing error!</div>';
		}
	}
}

//// File Uploads (Fix for secondary file upload - make this better in the future
function UploadFile2($filename, $upload_directory, $id, $files_dir, $sql_tablename){
	if($filename['size'] > 0) {
		$filename_clean = strtolower($filename['name']);
		$filename_clean = preg_replace("/\s+/i", "_", $filename_clean);
		$filename_clean = preg_replace("/\"/i", "", 	$filename_clean);
		$filename_clean = preg_replace("/\\\'/i", "", $filename_clean);
		$filename_clean = preg_replace("/\?/i", "", 	$filename_clean);
		$filename_clean = preg_replace("/\</i", "", 	$filename_clean);
		$filename_clean = preg_replace("/\//i", "-", 	$filename_clean);

		//// ------------------- create unique filename using date and sql ID
		$ext = explode('.', $filename_clean);
		$filename_final = $ext[0] . date("_ymd") . 'id' . $id . '.' . $ext[1];
		$uploadfile =  $files_dir. '/' . $filename_final;

		//// ------------------- delete pre-existing file
		//$sql = 'SELECT filename FROM '.$sql_tablename.' WHERE id=' . $id;
		//$result = mysql_query($sql);
		//$row = mysql_fetch_array($result);
		//if (isset($row[0])) unlink($files_dir. "/" .$row[0]);

		//// ------------------- Upload & Add Filename into DB then provide feedback
		if (move_uploaded_file($filename['tmp_name'], $uploadfile)) {
			mysql_query( "UPDATE ".$sql_tablename." SET filename2='".$filename_final."' WHERE id=". $id .";" );
			return '<div class="success">Upload processed.</div>';
		} else {
			echo "error: file upload failed. " . $_FILES['file']['error'];
			return '<div class="error">Upload processing error!</div>';
		}
	}
}



//////////////////////////////////////////////////////////////////////////////////////////////////
//// Shorten a String without breaking words
function NeatTrim($string, $length){
	$string = substr($string,0,$length);
	$string = substr($string,0,strrpos($string," "));
	return $string;
}




//////////////////////////////////////////////////////////////////////////////////////////////////
//// Fix smartquotes (thanks PC)
function CleanupSmartQuotes($text){
	$badwordchars=array(chr(145),
											chr(146),
											chr(147),
											chr(148),
											chr(151),
											chr(150),
											chr(149),
											chr(153),
											chr(161),
											chr(174),
											chr(186),
											chr(176)
											);
	$fixedwordchars=array("'",
											"'",
											'&quot;',
											'&quot;',
											'&mdash;',
											"&mdash;",
											"&bull;",
											"&trade;",
											"&copy;",
											"&reg;",
											"&ordm;",
											"&ordm;"
											);
	return str_replace($badwordchars,$fixedwordchars,$text);
}



//////////////////////////////////////////////////////////////////////////////////////////////////
//// Fix smartquotes Version 2 (thanks PC)
function FixSmartQuotes($text){
	$search = [                 // www.fileformat.info/info/unicode/<NUM>/ <NUM> = 2018
	                "\xC2\xAB",     // « (U+00AB) in UTF-8
	                "\xC2\xBB",     // » (U+00BB) in UTF-8
	                "\xE2\x80\x98", // ‘ (U+2018) in UTF-8
	                "\xE2\x80\x99", // ’ (U+2019) in UTF-8
	                "\xE2\x80\x9A", // ‚ (U+201A) in UTF-8
	                "\xE2\x80\x9B", // ‛ (U+201B) in UTF-8
	                "\xE2\x80\x9C", // “ (U+201C) in UTF-8
	                "\xE2\x80\x9D", // ” (U+201D) in UTF-8
	                "\xE2\x80\x9E", // „ (U+201E) in UTF-8
	                "\xE2\x80\x9F", // ‟ (U+201F) in UTF-8
	                "\xE2\x80\xB9", // ‹ (U+2039) in UTF-8
	                "\xE2\x80\xBA", // › (U+203A) in UTF-8
	                "\xE2\x80\x93", // – (U+2013) in UTF-8
	                "\xE2\x80\x94", // — (U+2014) in UTF-8
	                "\xE2\x80\xA6"  // … (U+2026) in UTF-8
	    ];
	$replacements = [
	                "<<", 
	                ">>",
	                "'",
	                "'",
	                "'",
	                "'",
	                '"',
	                '"',
	                '"',
	                '"',
	                "<",
	                ">",
	                "-",
	                "-",
	                "..."
    ];
	return str_replace($search, $replacements, $text);
}



//////////////////////////////////////////////////////////////////////////////////////////////////
//// Replaces double line-breaks with paragraph elements.
function nl2p($pee, $br = 1) {
	if ( trim($pee) === '' )
		return '';
	$pee = $pee . "\n"; // just to make things a little easier, pad the end
	$pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
	// Space things out a little
	$allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|option|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr|fieldset|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';
	$pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
	$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
	$pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
	if ( strpos($pee, '<object') !== false ) {
		$pee = preg_replace('|\s*<param([^>]*)>\s*|', "<param$1>", $pee); // no pee inside object/embed
		$pee = preg_replace('|\s*</embed>\s*|', '</embed>', $pee);
	}
	$pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
	// make paragraphs, including one at the end
	$pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
	$pee = '';
	foreach ( $pees as $tinkle )
		$pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
	$pee = preg_replace('|<p>\s*</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
	$pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);
	$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
	$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
	$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
	$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
	$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
	$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
	if ($br) {
		$pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', create_function('$matches', 'return str_replace("\n", "<WPPreserveNewline />", $matches[0]);'), $pee);
		$pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
		$pee = str_replace('<WPPreserveNewline />', "\n", $pee);
	}
	$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
	$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
	if (strpos($pee, '<pre') !== false)
		$pee = preg_replace_callback('!(<pre[^>]*>)(.*?)</pre>!is', 'clean_pre', $pee );
	$pee = preg_replace( "|\n</p>$|", '</p>', $pee );
	return $pee;
}



//////////////////////////////////////////////////////////////////////////////////////////////////
//// Replaces double line-breaks with paragraph elements.
function nl2li($inputtext, $br = 1) {
	$inputtext = '<ul><li>' . str_replace(array("\r\n", "\r", "\n","<br/>","<br />","<br>"), '</li><li>', $inputtext) . '</li></ul>';
	return $inputtext;
}


//////////////////////////////////////////////////////////////////////////////////////////////////
//// Replaces double line-breaks with paragraph elements.
function nl2li2($inputtext, $br = 1) {
	$inputtext = '<li>' . str_replace(array("\r\n", "\r", "\n","<br/>","<br />","<br>"), '</li><li>', $inputtext) . '</li>';
	return $inputtext;
}



//////////////////////////////////////////////////////////////////////////////////////////////////
//// Emailizer
function emailize($text) {
    $regex = '/(\S+@\S+\.\S+)/';
    $replace = '<a href="mailto:$1">$1</a>';
    return preg_replace($regex, $replace, $text);
}



//////////////////////////////////////////////////////////////////////////////////////////////////
//// XML FEEDS
function getXMLRSSFeed($url){
	$xml = simplexml_load_file($url, 'SimpleXMLElement', LIBXML_NOCDATA);
	if ($xml === false) {
	    echo "Failed loading XML\n";
	    foreach(libxml_get_errors() as $error) {
	        echo "<br />", $error->message;
	    }
	} else {
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);

		$units = $array['Property']['Floorplan'];
	}
	return $units;
}



////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// � Anamorphics Inc. All Rights Reserved. /////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
?>