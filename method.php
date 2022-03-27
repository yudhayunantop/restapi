<?php
require_once "koneksi.php";
class User 
{

    public  function get_user()
    {
        global $conn;
        $query="SELECT * FROM pengguna";
        $data=array();
        $result=sqlsrv_query($conn, $query);
        while($row=sqlsrv_fetch_object($result))
        {
            $data[]=$row;
        }
        $response=array(
                    'status' => 1,
                    'message' =>'Get List user Successfully.',
                    'data' => $data
                    );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function get_id($id)
    {
        global $conn;

        $query="SELECT * FROM pengguna WHERE idpengguna= $id";
        $data=array();
        $result=sqlsrv_query($conn, $query);

        while($row=sqlsrv_fetch_object($result))
        {
            $data[]=$row;
        }
        
        $response=array(
            'status' => 1,
            'message' =>'Get USER Successfully.',
            'data' => $data
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function insert_user()
    {
        global $conn;
        $arrcheckpost = array('username' => '', 'password' => '');
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
            $query = "INSERT INTO pengguna VALUES
            ('$_POST[username]', '$_POST[password]')";

            $result = sqlsrv_query($conn, $query);

        if($result)
        {
                $response=array(
                    'status' => 1,
                    'message' =>'USER Added Successfully.'
                );
            }
            else
            {
                $response=array(
                    'status' => 0,
                    'message' =>'USER Addition Failed.'
                );
            }
        }else{
            $response=array(
                'status' => 0,
                'message' =>'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function update_user($id)
        {
            global $conn;
            $arrcheckpost = array('username' => '', 'password' => '');
            $hitung = count(array_intersect_key($_POST, $arrcheckpost));
            if($hitung == count($arrcheckpost)){

                $query = "UPDATE pengguna SET
                username = '$_POST[username]',
                password = '$_POST[password]'
                WHERE idpengguna=$id";
    
                $result = sqlsrv_query($conn, $query);
    
            if($result)
            {
                    $response=array(
                        'status' => 1,
                        'message' =>'USER UPDATE Successfully.'
                    );
                }
                else
                {
                    $response=array(
                        'status' => 0,
                        'message' =>'USER UPDATE Failed.'
                    );
                }
            }else{
                $response=array(
                    'status' => 0,
                    'message' =>'Parameter Do Not Match'
                );
    }
            header('Content-Type: application/json');
            echo json_encode($response);
            }

    function delete_user($id)
    {
        global $conn;
        $query="DELETE FROM pengguna WHERE idpengguna=".$id;
        if(sqlsrv_query($conn, $query))
        {
            $response=array(
                'status' => 1,
                'message' =>'USER Deleted Successfully.'
            );
        }
        else
        {
            $response=array(
                'status' => 0,
                'message' =>'USER Deletion Failed.'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

?>