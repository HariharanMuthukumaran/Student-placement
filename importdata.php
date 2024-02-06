<?php
    include"uploaddb.php";

    if(isset($_POST['submit']))
    {
        $csvMimes = array('application/vnd.ms-excel');

        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) 
        {
            if(is_uploaded_file($_FILES['file']['tmp_name']))
            {
                $csvMimes = fopen($_FILES['file']['tmp-name'],'r');
                fgetcsv($csvFile);
                while(($line = fgetcsv($csvFile)) !== FALSE)
                {
                    $SNO=$line[0];
                    $REGNO=$line[1];
                    $NAME=$line[2];
                    $DEPARTMENT=$line[3];
                    $CGPA=$line[4];
                    $HSC=$line[5];
                    $SSLC=$line[6];
                    $ARREAR=$line[7];
                    $sql="SELECT ID FROM student detail WHERE CGPA ='{$CGPA}' AND ARREAR='{$ARREAR}'";
                    $res=$con->query($sql);

                    if($res->num_rows>0)
                    {
                        $s="UPDATE student detail SET SNO='".$SNO."', REGNO = '".$REGNO."', NAME ='".$NAME."', DEPARTMENT ='".$DEPARTMENT."' CGPA ='".$CGPA."', HSC ='".$HSC."', SSLC ='".$SSLC."',ARREAR ='".$ARREAR."' WHERE CGPA = '".$CGPA."' AND ARREAR = '".$ARREAR."'";
                        $con->query($s);

                    }
                    else
                    {
                        $s="INSERT INTO student detail (SNO,REGNO,NAME,DEPARTMENT,CGPA,HSC,SSLC,ARREAR) VALUES ('{$SNO}','{$REGNO}','{$NAME}','{$DEPARTMENT}','{$CGPA}','{$HSC},'{$SSLC}','{$ARREAR}')";
                        $con->query($s);
                    }
                }
                fclose($csvFile);
                $q='?status=succ';
            }
            else
            {
                $q='?status=err';
            }
        }  
        else
        {
            $q='?status=invalid_file';
        }
    }

    echo "<script>window.open('upload.php{$q}','_self')</script>";

?>