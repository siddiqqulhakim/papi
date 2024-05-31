<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : check.php
AUTHOR       : CAHYA DSN
CREATED DATE : 2021-05-28
UPDATED DATE : 2021-07-19
DEMO SITE    : https://psycho.cahyadsn.com/papi
SOURCE CODE  : https://github.com/cahyadsn/papi
================================================================================
This program is free software; you can redistribute it and/or modify it under the
terms of the MIT License.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

See the MIT License for more details

copyright (c) 2021 by cahya dsn; cahyadsn@gmail.com
================================================================================ */
session_start();
include 'config.php';
$data=array();
if(!isset($_POST['email'])){
    $data['status']='kosong deh';
}else{
    $sql="SELECT * FROM user_results_v4 WHERE email=?";
    $query=$db->prepare($sql);
    $query->bind_param('s',$_POST['email']);
    $query->execute();
    $query->store_result();
    if($query->num_rows>0){
        $data['status']='ada';
        $_SESSION['email']=$_POST['email'];
        $_SESSION['sudahada']='yes';
    }else{
        $data['status']='belum ada';
    }
}
echo json_encode($data);
?>