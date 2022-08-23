<?php

class Oracle_Database
{
    protected $dbConnect;

    function __construct()
    {

        // connect to oracle database
        $this->dbConnect = oci_connect("payroll_report", "Payroll123", "//192.168.16.9/PAYROLLWKS");
        if ($this->dbConnect) {
        } else {
            echo "Connection Failed";
            exit();
        }
    }

    function query($query = NULL)
    {
        if ($query != NULL || $query != '') {
            $query = oci_parse($this->dbConnect, $query);
            oci_execute($query);


            $rows = array();
            while ($r = oci_fetch_assoc($query)) {
                $rows[] = $r;
            }

            oci_close($this->dbConnect);

            $rows = json_encode($rows);
            $rows = json_decode($rows, TRUE);
            $rows = (array) $rows;
            return $rows;
        } else {
            return '';
        }
    }
}
