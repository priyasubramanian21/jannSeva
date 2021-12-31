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
    public function conQuery($connectID, $limit)
    {
        $getConnect = mysqli_query($this->conn, "SELECT *  FROM customer Where `connect` = '$connectID' LIMIT $limit");
        return $getConnect;
    }
    public function level5($getLevel4)
    {
        $data = array();
        $count = 0;
        #red 
        if (isset($getLevel4[0])) {
            for ($x = 0; $x < count($getLevel4[0]); $x++) {

                $getData = $this->conQuery($getLevel4[0][$x], 256);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[0] = $rowval;
            }
            $data['st5red'] = $count * 0.048828125;
        }

        #Orange 
        if (isset($getLevel4[1])) {

            for ($x = 0; $x < count($getLevel4[1]); $x++) {

                $getData = $this->conQuery($getLevel4[1][$x], 256);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[1] = $rowval;
            }
            $data['st5orange'] = $count * 0.048828125;
        }
        #Yellow 
        if (isset($getLevel4[2])) {

            for ($x = 0; $x < count($getLevel4[2]); $x++) {

                $getData = $this->conQuery($getLevel4[2][$x], 256);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[2] = $rowval;
            }
            $data['st5yellow'] = $count * 0.048828125;
        }
        #green 
        if (isset($getLevel4[3])) {

            for ($x = 0; $x < count($getLevel4[3]); $x++) {

                $getData = $this->conQuery($getLevel4[3][$x], 256);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[3] = $rowval;
            }
            $data['st5green'] = $count * 0.048828125;
        }

        if (isset($data['data'])) {
            $data['percent'] = (count($data['data']) / 1024) * 100;
        } else {

            $data['percent'] = 0;
        }
        return $data;
    }


    public function level4($getLevel3)
    {
        $data = array();
        $count = 0;
        #red 
        if (isset($getLevel3[0])) {
            for ($x = 0; $x < count($getLevel3[0]); $x++) {

                $getData = $this->conQuery($getLevel3[0][$x], 64);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[0] = $rowval;
            }
            $data['st4red'] = $count * 0.15625;
        }

        #Orange 
        if (isset($getLevel3[1])) {

            for ($x = 0; $x < count($getLevel3[1]); $x++) {

                $getData = $this->conQuery($getLevel3[1][$x], 64);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[1] = $rowval;
            }
            $data['st4orange'] = $count * 0.15625;
        }
        #Yellow 
        if (isset($getLevel3[2])) {

            for ($x = 0; $x < count($getLevel3[2]); $x++) {

                $getData = $this->conQuery($getLevel3[2][$x], 64);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[2] = $rowval;
            }
            $data['st4yellow'] = $count * 0.15625;
        }
        #green 
        if (isset($getLevel3[3])) {

            for ($x = 0; $x < count($getLevel3[3]); $x++) {

                $getData = $this->conQuery($getLevel3[3][$x], 64);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[3] = $rowval;
            }
            $data['st4green'] = $count * 0.15625;
        }
        if (isset($data['data'])) {
            $data['percent'] = (count($data['data']) / 256) * 100;
        } else {
            $data['percent'] = 0;
        }

        return $data;
    }
    public function level3($getLevel2)
    {
        $data = array();
        $count = 0;
        #red 
        if (isset($getLevel2[0])) {
            for ($x = 0; $x < count($getLevel2[0]); $x++) {

                $getData = $this->conQuery($getLevel2[0][$x], 16);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[0] = $rowval;
            }
            $data['st3red'] = $count * 0.46875;
        }

        #Orange 
        if (isset($getLevel2[1])) {

            for ($x = 0; $x < count($getLevel2[1]); $x++) {

                $getData = $this->conQuery($getLevel2[1][$x], 16);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[1] = $rowval;
            }
            $data['st3orange'] = $count * 0.46875;
        }
        #Yellow 
        if (isset($getLevel2[2])) {

            for ($x = 0; $x < count($getLevel2[2]); $x++) {

                $getData = $this->conQuery($getLevel2[2][$x], 16);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[2] = $rowval;
            }
            $data['st3yellow'] = $count * 0.46875;
        }
        #green 
        if (isset($getLevel2[3])) {

            for ($x = 0; $x < count($getLevel2[3]); $x++) {

                $getData = $this->conQuery($getLevel2[3][$x], 16);
                if (mysqli_num_rows($getData) > 0) {
                    while ($row = mysqli_fetch_array($getData)) {
                        $rowval[] = $row['user_id'];
                        $data['data'][] = $row;
                    }
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[3] = $rowval;
            }
            $data['st3green'] = $count * 0.46875;
        }
        if (isset($data['data'])) {
            $data['percent'] = (count($data['data']) / 64) * 100;
        } else {
            $data['percent'] = 0;
        }

        return $data;
    }

    public function level2($getLevel1)
    {
        $data = array();
        $count = 0;
        #red 
        if (isset($getLevel1[0])) {
            $getData = $this->conQuery($getLevel1[0], 4);
            $data = array();
            if (mysqli_num_rows($getData) > 0) {
                while ($row = mysqli_fetch_array($getData)) {
                    $rowval[] = $row['user_id'];
                    $data['data'][] = $row;
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[0] = $rowval;
            }

            $data['st2red'] = $count * 5;
        }
        #Orange 
        if (isset($getLevel1[1])) {
            $getData = $this->conQuery($getLevel1[1], 4);
            $data = array();
            if (mysqli_num_rows($getData) > 0) {
                while ($row = mysqli_fetch_array($getData)) {
                    $rowval[] = $row['user_id'];
                    $data['data'][] = $row;
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[1] = $rowval;
            }
            $data['st2orange'] = $count * 5;
        }
        #Yellow 
        if (isset($getLevel1[2])) {
            $getData = $this->conQuery($getLevel1[2], 4);
            $data = array();
            if (mysqli_num_rows($getData) > 0) {
                while ($row = mysqli_fetch_array($getData)) {
                    $rowval[] = $row['user_id'];
                    $data['data'][] = $row;
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[2] = $rowval;
            }
            $data['st2yellow'] = $count * 5;
        }
        #green 
        if (isset($getLevel1[3])) {
            $getData = $this->conQuery($getLevel1[3], 4);
            $data = array();
            if (mysqli_num_rows($getData) > 0) {
                while ($row = mysqli_fetch_array($getData)) {
                    $rowval[] = $row['user_id'];
                    $data['data'][] = $row;
                }
            }
            if (isset($rowval)) {
                $count = count($rowval);
                $data[3] = $rowval;
            }
            $data['st2green'] = $count * 5;
        }
        if (isset($data['data'])) {
            $data['percent'] = (count($data['data']) / 16) * 100;
        } else {
            $data['percent'] = 0;
        }

        return $data;
    }
    public function level1($connectID)
    {
        $count = 0;
        $getData = $this->conQuery($connectID, 4);
        $data = array();
        if (mysqli_num_rows($getData) > 0) {
            while ($row = mysqli_fetch_array($getData)) {
                $data[] = $row['user_id'];
                $data['data'][] = $row;
            }
        }
        if (isset($data['data'])) {
            $count = count($data['data']);
        }

        $data['percent'] = $count * 25;
        if ($count == 1) {
            $data['st1red'] = 10;
        } elseif ($count == 2) {
            $data['st1red'] = 10;
            $data['st1orange'] = 10;
        } elseif ($count == 3) {
            $data['st1red'] = 10;
            $data['st1orange'] = 10;
            $data['st1yellow'] = 10;
        } elseif ($count == 4) {
            $data['st1red'] = 10;
            $data['st1orange'] = 10;
            $data['st1yellow'] = 10;
            $data['st1green'] = 10;
        }
        return $data;
    }
}
