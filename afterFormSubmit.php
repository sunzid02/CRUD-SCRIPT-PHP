<?php

  if (isset($_POST['submit']))
  {
    //Database1 Connection Info
    $hostDb1 = $_POST['hostDb1'];
    $usernameDb1 = $_POST['usernameDb1'];
    $passwordDb1 = $_POST['passwordDB1'];
    $nameOfdb1 = $_POST['db1'];

    //Database2 Connection Info
    $hostDb2 = $_POST['hostDb2'];
    $usernameDb2 = $_POST['usernameDb2'];
    $passwordDb2 = $_POST['passwordDB2'];
    $nameOfdb2 = $_POST['db2'];

    //Table aaction
    $tableName = $_POST['table'];
    $criteria = $_POST['criteria'];//1 is inssert && 2 is delete

    if ($hostDb1!=null && $usernameDb1!=null &&  $nameOfdb1 !=null && $hostDb2!=null &&  $nameOfdb2!=null && $tableName!=null && $criteria!=null)
    {
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      //connection check
      $db1 = @mysql_connect($hostDb1, $usernameDb1, $passwordDb1);
      $db2 = @mysql_connect($hostDb2, $usernameDb2, $passwordDb2, true);
      if ($db1 == true)
      {
        // code...
        echo "<br>successfully connected to db1<br>";
      }
      else
      {

         echo "<br>not connected to db1, Error: ".mysql_error()."<br>";
      }
      if ($db2 == true)
      {
        // code...
        echo "<br>successfully connected to db2<br>";
      }
      else
      {
         echo "<br>not connected to db2, Error: ".mysql_error()."<br>";
      }


      // Database found or not
      if (mysql_select_db($nameOfdb1, $db1) == true && mysql_select_db($nameOfdb2, $db2) == true) {
        echo "<br>Both Database found<br>";
      }
      else
      {
        echo "<br>Database1 not found, Error: ".mysql_error(mysql_select_db($nameOfdb1, $db1))."<br>";
        echo "<br>Database2 not found, Error: ".mysql_error(mysql_select_db($nameOfdb2, $db2))."<br>";

      }

      mysql_select_db($nameOfdb1, $db1);
      mysql_select_db($nameOfdb2, $db2);

      //get the maximum id of a table from DB1
      $midQry = "SELECT MAX(id) AS last_id FROM ".$tableName;
      $qryGetLastIdFromDb1 = mysql_query($midQry, $db1);
      $rowLastIdDb1 = mysql_fetch_assoc($qryGetLastIdFromDb1);
      $maxIdDb1 = $rowLastIdDb1['last_id'];

      //get the maximum id of a table from DB2
      $qryGetLastIdFromDb2 = mysql_query($midQry, $db2);
      $rowLastIdDb2 = mysql_fetch_assoc($qryGetLastIdFromDb2);
      $maxIdDb2 = $rowLastIdDb2['last_id'];


      $qryDb1 = mysql_query("select * from ".$tableName." where id > ". "'$maxIdDb2'", $db1);
      // echo $qryDb1;
      // $dataFromDb1 = mysql_fetch_array($qryDb1);
      //   print_r($dataFromDb1);

      if (mysql_num_rows($qryDb1)>0)
      {
        $i=0;
        while ($row = mysql_fetch_assoc($qryDb1))
        {
          $dataDb1[$i] = $row;
          $i++;
          $et[] = $dataDb1;
        }
      }

      echo "<pre>";
      // print_r($dataDb1);
      $qrySelectDb2 = "select * from ".$tableName;

      $qrySelectExecuteDb2 = mysql_query($qrySelectDb2,$db2);

      $headerArraDb2 = mysql_fetch_assoc($qrySelectExecuteDb2);
      $headerDb2 = array();

      if ($criteria == "1")
      {
        //////////////////////////////////////////////////Criteria 1//////////////////////////////////////////////////////////////////////////////////
                if ($maxIdDb2 < $maxIdDb1 && $qryDb1 == true)
                {
                  //Insert into DB2
                  if (is_array($dataDb1))
                  {
                    //Getting table headers

                    foreach ($headerArraDb2 as $key1=>$val)
                    {
                      // code...
                      // $key1 = array_splice($key[0]);
                      $headerDb2[] = $key1;
                    }

                    // $headerRemoveIdDb2 = array_splice($headerDb2,1);//removing first column id
                    $headerFormatDb2 = "(".implode(', ',$headerDb2).")";//headers are ready now
                    echo "<pre>";
                    print_r($headerFormatDb2);
                    // die();
                      //insert to table 2
                      $qryInsertDb2 = "insert into ".$tableName." ".$headerFormatDb2." values ";

                      $valuesArray = array();
                      foreach ($dataDb1 as $key)
                      {
                        $valuesArray[]=$key;
                      }
                      foreach ($valuesArray as $key)
                      {
                        // unset($key['id']);
                        $keySize= count($key);

                        $tt=0;
                        while ($tt<$keySize)
                        {
                          // code...
                          foreach ($key as $key2)
                          {
                            // $valueIdRemoveDb2 = array_splice($key2,1);//removing first column id
                            $aa[$tt]= "'".$key2."'";
                            $tt++;
                          }
                          // array_splice($aa,3);
                        }
                        $dynamicDataentry[]="(".implode(', ', $aa) .")";
                      }

                      echo "<pre>";
                      print_r ($dynamicDataentry);

                      $qryInsertDb2 .= implode(', ', $dynamicDataentry);
                      echo "<br>".$qryInsertDb2;
                      if (mysql_query($qryInsertDb2) == true)
                      {
                        echo "<br>Insert success<br>";
                      }
                      else
                      {
                        echo "<br>Insert Unsucessful<br>".mysql_error();
                        // exit(mysql_error());
                      }
                }// db is an array if ends
                else
                {
                  echo "<br>Already inserted once, Criteria1 can't be performed more than once<br>";
                }
              }
              else
              {
                echo "<br><h2> Already inserted once and table2 has more data than table 1 </h2><br>";
              }
        //////////////////////////////////////Criteria 1 Ends///////////////////////////////////////////////////////////////////////////////////////////////////////
      }// if criteria1 ends



      else if($criteria == "2")
      {
        $qry2Db1 = mysql_query("select * from ".$tableName, $db1);
        if (mysql_num_rows($qry2Db1)>0)
        {
          $i=0;
          while ($row = mysql_fetch_assoc($qry2Db1))
          {
            $et[$i] = $row;
            $i++;
          }
        }
        echo "<br><h2>Criteria 2 selectred</h2></br>";
        if (is_array($et))
        {
          $emptyQryDb22 = "TRUNCATE TABLE ".$tableName;
          $emptyQryDb2Ex2 = mysql_query($emptyQryDb22, $db2);
          //Getting table headers
          $qrySelectDb22 = "select * from ".$tableName;

          $qrySelectExecuteDb22 = mysql_query($qrySelectDb22,$db2);

          $headerArraDb22 = mysql_fetch_assoc($qrySelectExecuteDb22);
          $headerDb22 = array();

          foreach ((array)$headerArraDb22 as $key1)
          {
            // code...
            // $key1 = array_splice($key[0]);
            $headerDb22[] = $key1;
          }

          // $headerRemoveIdDb2 = array_splice($headerDb2,1);//removing first column id
          $headerArrayDb2 = "(".implode(', ',$headerDb22).")";//headers are ready now
          echo "<pre>";
          print_r($headerArrayDb2);
          // die();
            //insert to table 2


            if ($emptyQryDb2Ex2 == true)
            {
              echo "<br>Truncate success</br>";
              $qryInsertDb2 = "insert into  ".$tableName." ".$headerArrayDb2." values ";

              $valuesArray = array();
              foreach ($et as $key)
              {
                $valuesArray[]=$key;
              }
              foreach ($valuesArray as $key)
              {
                // unset($key['id']);
                $keySize= count($key);

                $tt=0;
                while ($tt<$keySize)
                {
                  // code...
                  foreach ($key as $key2)
                  {
                    // $valueIdRemoveDb2 = array_splice($key2,1);//removing first column id
                    $aa[$tt]= "'".$key2."'";
                    $tt++;
                  }
                  // array_splice($aa,3);
                }
                $dynamicDataentry[]="(".implode(', ', $aa) .")";
              }

              echo "<pre>";
              print_r ($dynamicDataentry);

              $qryInsertDb2 .= implode(', ', $dynamicDataentry);
              echo "<br>".$qryInsertDb2;
              if (mysql_query($qryInsertDb2) == true)
              {
                echo "<br>Insert success for criteria2<br>";
              }
              else
              {
                echo "<br>Insert Unsucessful for criteria2<br>".mysql_error();
                // exit(mysql_error());
              }
            }//if truncate success ends
            else
            {
              echo "Truncate Unsucessful";
            }

        }//$dataDb1 is an arraay if ends
      }//criteria2 elseIf ends

      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    }// all variables are not null if ends
    else
    {
      echo "some values are empty";
    }

  }//sumit if ends
  else
  {
    echo "Invalid input. Please Try again";
  }



  // $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  // echo "<br>".$actual_link;
  // echo "<br>".$_SERVER[REQUEST_URI];
 ?>
 <?php
    echo "<a href=". $_SERVER['HTTP_REFERER'].">"."<h2>BACK<h2>"."</a>";
 ?>
