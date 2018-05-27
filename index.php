<!DOCTYPE html>
<html lang="en">
<head>
  <title>Insert Delete Criteria</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

  <div class="row">
          <!-- form -->
    <form class="form-horizontal" action="afterFormSubmit.php" method="post">
      <div class="col-md-4" style="margin-top:5%">
        <h2>Connection For DB1</h2>
        <br><br>
          <div class="form-group">
            <label class="control-label col-sm-4" for="hostDb1">HostDB1:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="hostDb1" placeholder="Enter DB1 hostname" name="hostDb1" autofocus  required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="usernameDb1">UsernameDB1:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="usernameDb1" placeholder="Enter DB1 username" name="usernameDb1"  required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="passwordDB1">PasswordDB1:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="passwordDB1" placeholder="Enter DB1 password" name="passwordDB1"  >
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="db1">DB1:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="db1" placeholder="Enter database1 name" name="db1"  required>
            </div>
          </div>
      </div>

      <!-- 2nd column DB Connection -->
      <div class="col-md-4" style="margin-top:5%">
        <h2>Connection For DB2</h2>
        <br><br>
          <div class="form-group">
            <label class="control-label col-sm-4" for="hostDb2">HostDB2:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="hostDb2" placeholder="Enter DB2 hostname" name="hostDb2" autofocus  required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="usernameDb2">UsernameDB2:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="usernameDb2" placeholder="Enter DB2 username" name="usernameDb2"  required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="passwordDB2">PasswordDB1:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="passwordDB2" placeholder="Enter DB2 password" name="passwordDB2"  >
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="db2">DB2:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="db2" placeholder="Enter database2 name" name="db2"  required>
            </div>
          </div>
      </div>



      <!-- 3rd Column -->
    <div class="col-md-4" style="margin-top:5%">

        <h2>For Action</h2>
        <br><br>
        <div class="form-group">
          <label class="control-label col-sm-2" for="table">Table:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="table" placeholder="Enter table name" name="table" required>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="criteria" required>Criteria:</label>
          <div class="col-sm-8">
            <select class="form-control" name="criteria">
              <option value="">Please Select</option>
              <option value="1">Insert</option>
              <option value="2">Delete</option>
            </select>
          </div>
        </div>
        <!-- <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label><input type="checkbox" name="remember"> Remember me</label>
            </div>
          </div>
        </div> -->

    </div>


  </div>

  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="form-group">
        <br><br>
        <div class="col-sm-offset-2 col-lg-10" style="margin-left:25%">
          <input type="submit" class="btn-lg btn-primary" name="submit" value="Submit">
        </div>
      </div>
    </div>
    <div class="col-md-3"></div>
    </form>
  </div>

  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="margin-top:5%">

        <h2>Conditions</h2>
        <fieldset>
        <h4><p>* Data will transfer from database1 to database2</p></h4>
        <h4><p>* Table name must be same in both database</p></h4>
        <h4><p>* Database & Table name must be entered correctly</p></h4>
        <h4><p>* Changes can't be undone</p></h4>
      </fieldset>
    </div>
  </div>
</div>

</body>
</html>
