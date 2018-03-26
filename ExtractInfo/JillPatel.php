<?php


			 
		 function ExtractInfo($filetext,$InputFileName,$OutputFileName)
		 {
         $file = fopen( $InputFileName, "r" );
         
         if( $file == false ) {
            echo ( "Error in opening file" );
            exit();
         }
         
         $filesize = filesize( $InputFileName );
         $filetext = fread( $file, $filesize );
         fclose( $file );
        
		echo "<br>";
		 
		 if(preg_match("/class\=\"heading\-title\ pull\-left\"\>\n.+\n.\ *([a-zA-Z\.*]*)\n.+\n.+\n.\ *([a-zA-Z\.*]*)\n.+\n.+\n.\ *([a-zA-Z\.*]*)/",$filetext, $Name)){
			 
			$FacultyName= 'Name: '.$Name[1].' '.$Name[2].' '.$Name[3];
			//echo "Faculty Name: $FacultyName <br />";
           
		 }
		 
		 if(preg_match('/Research\ Interests<\/h3>\n+.\ *<\/div>\n+.\ *<div\ class="panel-body"><p>*([\n*\s*a-zA-Z\ \,\.\/*]*)/',$filetext, $Research)){
		 
			$FacultyResearchInterest= 'Research Interests: '.$Research[1];
		    //echo "Research Interests: ".$Research[1]."<br />";
		 }
		 
		 if(preg_match('/Education<\/h3>\n+.\ *<\/div>\n+.\ *<div\ class="panel-body"><p>+([\n*\s*a-zA-Z\ \,\.*]*)/',$filetext, $Education)){
			
			$FacultyEducation= 'Education: '.$Education[1];
		    //echo "Education: ".$Education[1]."<br />";
		 }
		 
		 if(preg_match('/<\!\-\-\ saved\ from\ url\=\(\d*\)+(.[a-z:]*\/\/[a-z.]*)\/[a-z]*\/[a-z]*\/([a-zA-z0-9]*)/',$filetext,$URL)){
			
			$FacultyWebpage= 'Webpage: '.$URL[1]."/~".$URL[2];
			//echo "Webpage: ".$URL[1]."/~".$URL[2]."<br />"; 
			 
		 }
		 
		 $FacultyEmailId='Email-id: '.$URL[2].'@txstate.edu';
		 //echo "Email: ".$URL[2]."@txstate.edu</br>";
		 
		 $Data= $FacultyName."\n".$FacultyEducation."\n".$FacultyResearchInterest."\n".$FacultyEmailId."\n".$FacultyWebpage."\n";
		 
		$file = fopen( $OutputFileName, "w" );
   
		if( $file == false ) {
		echo ( "Error in opening new file" );
		exit();
		}
		fwrite( $file,$Data);
		fclose( $file );
		echo "Check the outputfile $OutputFileName.\n";
		//return $Data;
		 }
		 $filetext="";
		 ExtractInfo($filetext,"Faculty1.html","Faculty1Output.txt");
		 ExtractInfo($filetext,"Faculty2.html","Faculty2Output.txt");
		 ExtractInfo($filetext,"Faculty3.html","Faculty3Output.txt");

		
		 
?>

