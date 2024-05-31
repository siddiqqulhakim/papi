<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : papi_process.php
AUTHOR       : CAHYA DSN
CREATED DATE : 2017-04-09
UPDATED DATE : 2021-08-20
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

copyright (c) 2017-2021 by cahya dsn; cahyadsn@gmail.com
================================================================================ */
session_start();
include 'inc/config.php';
$_SESSION['code']=session_id();
if(isset($_POST['d'])){ 
   $data=array();
   foreach($_POST['d'] as $k=>$v){
       if(!isset($data[$v])) 
           $data[$v]=0;
       $data[$v]+=1;
   } 
   $sql="INSERT INTO user_results_v4(email,nama,raw_result,calc_result,created_at) VALUES(?,?,?,?,NOW())";
   $query=$db->prepare($sql);
   $d=json_encode($_POST['d']);
   $dt=json_encode($data);
   $query->bind_param('ssss',$_POST['email'],$_POST['name'],$d,$dt);
   $query->execute();
   $_SESSION['email']=$_POST['email'];
   header('location:final.php'); 
}
