<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $Username = $obj['username'];
    $Password = $obj['password'];
    $responseuser = array();


    $sql="SELECT user_status,user_id,Username,Password FROM User Where Username='".$Username."' and Password='".$Password."' ";
 
                  $result1 = mysqli_query($con,$sql);
				
                  if(mysqli_num_rows($result1)==1){
 
                      $row = mysqli_fetch_array($result1,MYSQLI_ASSOC);
 
                    //   $_SESSION["UserID"] = $row["user_id"];
                    //   $_SESSION["Username"] = $row["username"];
                      // $_SESSION["user_status"] = $row["user_status"];

                      // $responseuser = $row["user_id"];
                      array_push($responseuser,$row);
                      if($row["user_status"]=="1"){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php
 
                        $result = "Login Success Student";
                        
                      }
 
                      if ($row["user_status"]=="2"){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php
 
                        $result = "Login Success Teacher";
 
                      }

                      if ($row["user_status"]=="0"){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php
 
                        $result = "Login Success Admin";
 
                      }

                      if ($row["user_status"]=="3"){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php
 
                        $result = "Login Success Personel";
 
                      }

                      if ($row["user_status"]=="4"){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php
 
                        $result = "Login Success General Public";
 
                      }
 
                  }else{
                    $result = "Login Fail";

                  }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($responseuser, JSON_UNESCAPED_UNICODE);
?>