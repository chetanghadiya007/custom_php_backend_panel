<?php
    class gcr{
        public function gc_query($query){
            $_SESSION['last_query'] = $query;
		    return mysqli_query($GLOBALS['con'], $query);
	    }

        public function gc_last_query(){
            return  $_SESSION['last_query'];
	    }
        
        public function gc_get_value($table, $field, $where){
            $qry = "SELECT $field from $table $where LIMIT 1";
            $result = $this->gc_query($qry);
            if ($this->gc_affected_rows() > 0) {
                $row = $this->gc_fetch_array($result);
                return stripslashes($row[$field]);
            } else {
                return "";
            }
	    }

        public function gc_fetch_array($result){
		    return mysqli_fetch_array($result, MYSQLI_ASSOC);
	    }

        public function gc_affected_rows(){
		    return mysqli_affected_rows($GLOBALS['con']);
	    }


        public function gc_dbinsert($table, $data){
		    $qry = "INSERT INTO " . $table . " set ";
		    foreach ($data as $fld => $val) {
			    $qry .= $fld . "='" . $this->add_security($val) . "',";
		    }
            $qry = substr($qry, 0, -1);
            return $this->gc_query($qry);
        }

	    public function gc_dbinsert_id(){
		    return mysqli_insert_id($GLOBALS['con']);
	    }

        public function gc_dbupdate($table, $data, $whare){
		    $qry = "UPDATE " . $table . " set ";
		    foreach ($data as $fld => $val) {
			    $qry .= $fld . "='" . $this->add_security($val) . "',";
		    }

            $qry = substr($qry, 0, -1);
            $qry .= " " . $whare;
            return $this->gc_query($qry);
        }


        public function add_security($val){
		    return mysqli_real_escape_string($GLOBALS['con'], $val);
	    }

        public function get_error(){
            return mysqli_error($GLOBALS['con']);
        }
        

        public function getdatetime(){
            $dateTime = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
            $mysqldate = $dateTime->format("Y-m-d H:i:s");
            return $mysqldate;
        }
        
        public function get_date(){
            $dateTime = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
            $mysqldate = $dateTime->format("Y-m-d");
            return $mysqldate;
        }
        
        public function get_client_ip() {
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
               $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
    
        public function date2save($date = ""){
            if($date != ''){
                $arr = explode('-',$date);
                if(count($arr) > 1){
                    return $arr[2].'-'.$arr[1].'-'.$arr[0];	
                }
            }
            return '';
        }
    
        public function date2dis($date = ""){
            if($date != '' && $date != '0000-00-00'){
                $arr = explode('-',$date);
                return $arr[2].'-'.$arr[1].'-'.$arr[0];
            }
            return '';
        }
        
        public function datetime2dis($date = ""){
            if($date != '' && $date != 'null'){
                return DATE('d-m-Y h:m:s',strtotime($date));
            }
            return '';
        }
    
        public function datetimetodis($datetime = ""){
            if($datetime != '0000-00-00 00:00:00'){
                $arr = explode(' ',$datetime);
                $arr = explode('-',$arr[0]);
                return $arr[2].'-'.$arr[1].'-'.$arr[0];
            }
            return '';
        }

        public function gc_upload_image($fileName,$destination,$aExtension){
            $fileTmpLoc = $_FILES[$fileName]["tmp_name"];
            $temp = explode(".", $_FILES[$fileName]["name"]);
            $extension = strtolower(end($temp));
            $newName = time().".".$extension;
            $path = $destination.$newName;
            if(in_array($extension,$aExtension)){
                move_uploaded_file($_FILES[$fileName]["tmp_name"], $path);
                return $newName;
            }else{
                return "";
            }
        }

        public function gc_encode_url($vName){
            return strtolower(str_replace(" ","-",$vName));
        }

        public function gc_decode_url($vName){
            return ucwords(str_replace("-"," ",$vName));
        }
    }
    
    function print_pre($arr){
	    echo '<br><pre>';
	    print_r($arr);
	    echo '<br></pre>';
    }
?>