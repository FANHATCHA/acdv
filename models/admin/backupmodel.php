<?php
     
class Backupmodel extends CI_Model{
     
    var $table_name = "";
    
    function __construct()
    {
		$this->backup_table = "";
		$this->load->database();
    }
     
    function getbackupdata()
    {
		$Filename = array();
		$dir = "application/database_backup/";	
		if (is_dir($dir)){
			if ($dh = opendir($dir)){
				while (($file = readdir($dh)) !== false){
				
					if($file != "." && $file != "..")
					$Filename[] = $file; 
					
				}
				closedir($dh);
			}
		}
		return $Filename;
    }
     
    function create_backup()
    {
		$return="";
		//$succ = 0;
		$allTables = array();
        $result = mysql_query('SHOW TABLES');
		// GET All DB TABLES
        while($row = mysql_fetch_row($result))
        {
            $allTables[] = $row[0];
        }
		foreach($allTables as $table)
        {
            $result = mysql_query('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($result);
			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			for ($i = 0; $i < $num_fields; $i++) 
			{
                while($row = mysql_fetch_row($result))
                {
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                    for($j=0; $j<$num_fields; $j++)
					{
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n","\\n",$row[$j]);
						if (isset($row[$j]))
						{
							$return.= '"'.$row[$j].'"' ; } 
                        else
						{
							$return.= '""'; 
						}	
						if ($j<($num_fields-1))
						{
							$return.= ',';
						}
                    }
                    $return.= ");\n";
                }
            }
			$return.="\n\n";
		}
		// Create Backup Folder
        $folder = 'application/database_backup/';
        if (!is_dir($folder))
            mkdir($folder, 0755, true);
            chmod($folder, 0755);
            $date = date('d-m-Y-H-i-s'); 
			$dbfilename = "acdvoyage-".$date;
            $filename = $folder."acdvoyage-".$date; 
            $handle = fopen($filename.'.sql','w+');
			fwrite($handle,$return);
            fclose($handle);
			return $dbfilename;

	}
   
   
    
    function delete_backup($file)
    {
		$folder = 'application/database_backup/';
    	@unlink($folder.$file);
		return 1;
    }
     
}
?>