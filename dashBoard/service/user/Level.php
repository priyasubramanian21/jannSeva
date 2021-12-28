<?php

namespace Level;

use database\connection as conn;



class Level
{

    public $conn;

    public function __construct()
    {

        $db = new conn();
        $this->conn = $db->connect();
    }
    public function conQuery($connectID)
    {
        $getConnect = mysqli_query($this->conn, "SELECT *  FROM customer Where `connect` = '$connectID'");
        return $getConnect;
    }
    public function level5($getLevel4)
    {
        $data = array();

        #red 
        if ($getLevel4[0]) {
            for ($x = 0; $x < count($getLevel4[0]); $x++) {

                $getData = $this->conQuery($getLevel4[0][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st5red'] = $count * 0.048828125;
            $data[0] = $rowval;
        }

        #Orange 
        if ($getLevel4[1]) {

            for ($x = 0; $x < count($getLevel4[1]); $x++) {

                $getData = $this->conQuery($getLevel4[1][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st5orange'] = $count * 0.048828125;
            $data[1] = $rowval;
        }
        #Yellow 
        if ($getLevel4[2]) {

            for ($x = 0; $x < count($getLevel4[2]); $x++) {

                $getData = $this->conQuery($getLevel4[2][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st5yellow'] = $count * 0.048828125;
            $data[2] = $rowval;
        }
        #green 
        if ($getLevel4[3]) {

            for ($x = 0; $x < count($getLevel4[3]); $x++) {

                $getData = $this->conQuery($getLevel4[3][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st5green'] = $count * 0.048828125;
            $data[3] = $rowval;
        }

        return $data;
    }


    public function level4($getLevel3)
    {
        $data = array();

        #red 
        if ($getLevel3[0]) {
            for ($x = 0; $x < count($getLevel3[0]); $x++) {

                $getData = $this->conQuery($getLevel3[0][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st4red'] = $count * 0.15625;
            $data[0] = $rowval;
        }

        #Orange 
        if ($getLevel3[1]) {

            for ($x = 0; $x < count($getLevel3[1]); $x++) {

                $getData = $this->conQuery($getLevel3[1][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st4orange'] = $count * 0.15625;
            $data[1] = $rowval;
        }
        #Yellow 
        if ($getLevel3[2]) {

            for ($x = 0; $x < count($getLevel3[2]); $x++) {

                $getData = $this->conQuery($getLevel3[2][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st4yellow'] = $count * 0.15625;
            $data[2] = $rowval;
        }
        #green 
        if ($getLevel3[3]) {

            for ($x = 0; $x < count($getLevel3[3]); $x++) {

                $getData = $this->conQuery($getLevel3[3][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st4green'] = $count * 0.15625;
            $data[3] = $rowval;
        }

        return $data;
    }
    public function level3($getLevel2)
    {
        $data = array();
        #red 
        if ($getLevel2[0]) {
            for ($x = 0; $x < count($getLevel2[0]); $x++) {

                $getData = $this->conQuery($getLevel2[0][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st3red'] = $count * 0.46875;
            $data[0] = $rowval;
        }

        #Orange 
        if ($getLevel2[1]) {

            for ($x = 0; $x < count($getLevel2[1]); $x++) {

                $getData = $this->conQuery($getLevel2[1][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st3orange'] = $count * 0.46875;
            $data[1] = $rowval;
        }
        #Yellow 
        if ($getLevel2[2]) {

            for ($x = 0; $x < count($getLevel2[2]); $x++) {

                $getData = $this->conQuery($getLevel2[2][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st3yellow'] = $count * 0.46875;
            $data[2] = $rowval;
        }
        #green 
        if ($getLevel2[3]) {

            for ($x = 0; $x < count($getLevel2[3]); $x++) {

                $getData = $this->conQuery($getLevel2[3][$x]);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            $count = count($rowval);
            $data['st3green'] = $count * 0.46875;
            $data[3] = $rowval;
        }

        return $data;
    }

    public function level2($getLevel1)
    {
        #red 
        if ($getLevel1[0]) {
            $getData = $this->conQuery($getLevel1[0]);
            $data = array();
            if (mysqli_num_rows($getData) > 0) {
                while ($row = mysqli_fetch_array($getData)) {
                    $rowval[] = $row['user_id'];
                    $data['data'][] = $row;
                }
            }
            $count = count($rowval);
            $data['st2red'] = $count * 5;
            $data[0] = $rowval;
        }
        #Orange 
        if ($getLevel1[1]) {
            $getData = $this->conQuery($getLevel1[1]);
            $data = array();
            if (mysqli_num_rows($getData) > 0) {
                while ($row = mysqli_fetch_array($getData)) {
                    $rowval[] = $row['user_id'];
                    $data['data'][] = $row;
                }
            }
            $count = count($rowval);
            $data['st2orange'] = $count * 5;
            $data[1] = $rowval;
        }
        #Yellow 
        if ($getLevel1[2]) {
            $getData = $this->conQuery($getLevel1[2]);
            $data = array();
            if (mysqli_num_rows($getData) > 0) {
                while ($row = mysqli_fetch_array($getData)) {
                    $rowval[] = $row['user_id'];
                    $data['data'][] = $row;
                }
            }
            $count = count($rowval);
            $data['st2yellow'] = $count * 5;
            $data[2] = $rowval;
        }
        #green 
        if ($getLevel1[3]) {
            $getData = $this->conQuery($getLevel1[3]);
            $data = array();
            if (mysqli_num_rows($getData) > 0) {
                while ($row = mysqli_fetch_array($getData)) {
                    $rowval[] = $row['user_id'];
                    $data['data'][] = $row;
                }
            }
            $count = count($rowval);
            $data['st2green'] = $count * 5;
            $data[3] = $rowval;
        }

        return $data;
    }
    public function level1($connectID)
    {
        $getData = $this->conQuery($connectID);
        $data = array();
        if (mysqli_num_rows($getData) > 0) {
            while ($row = mysqli_fetch_array($getData)) {
                $data[] = $row['user_id'];
                $data['data'][] = $row;
            }
        }
        $count = count($data);
        $data['percent'] = $count * 2.5;
        if ($count == 1)
            $data['st1red'] = 10;
        if ($count == 2)
            $data['st1orange'] = 10;
        if ($count == 3)
            $data['st1yellow'] = 10;
        if ($count == 4)
            $data['st1green'] = 10;


        return $data;
    }
}
