<?php
  if(isset($_POST['createClient'])) {
    createClient($_POST['newfirstname'], $_POST['newlastname']);
    header('Location: index');
  }
  if(isset($_POST['updateClient'])) {
    updateClient($_POST['idHolder'], $_POST['firstname'], $_POST['lastname']);
    header('Location: index');
  }
  if(isset($_POST['deleteClient'])) {
    deleteClient($_POST['idHolder']);
    header('Location: index');
  }

  if(isset($_POST['createPatient'])) {
    createPatient($_POST['name'], $_POST['species'], $_POST['client'], $_POST['status'], $_POST['gender']);
    header('Location: index');
  }
  if(isset($_POST['updatePatient'])) {
    updatePatient($_POST['idHolder'], $_POST['name'], $_POST['species'], $_POST['client'], $_POST['status'], $_POST['gender']);
    header('Location: index');
  }
  if(isset($_POST['deletePatient'])) {
    deletePatient($_POST['idHolder']);
    header('Location: index');
  }

  if(isset($_POST['createSpecies'])) {
    createSpecies($_POST['name']);
    header('Location: index');
  }
  if(isset($_POST['updateSpecies'])) {
    updateSpecies($_POST['idHolder'], $_POST['name']);
    header('Location: index');
  }
  if(isset($_POST['deleteSpecies'])) {
    deleteSpecies($_POST['idHolder']);
    header('Location: index');
  }
?>

<div style="float:left; width: 100vw; position: absolute;">

  <!-- ========================================== CLIENTS ========================================== -->
  <ul class="list-group col-md-2 clientList">
    <button type="button" onclick="callPHP('patients', 3)" class="list-group-item justify-content-between clickable hover">
      <p class="center" style="margin:0;padding:0;">Show All Patients</p>
    </button>
    <?php
      foreach($clients as $client){
        $count = 0;
        foreach($patients as $patient){
          if($patient['client_id'] == $client['client_id']){
            $count++;
          }
        }
        //data-toggle='modal' data-target='#editClient'
        echo "<li onclick='callPHP(" . $client['client_id'] . ", 2)' class='list-group-item hover' id='" . $client['client_id'] . "'>
            <p class='number'>" . $client['client_id'] . "</p>" . 
            $client['client_firstname'] . " " . $client['client_lastname'] . 
            "<span class='badge right'>" . $count . "</span>
          </li>";
      }
    ?>
    <button type="button" data-toggle="modal" data-target="#addClient" class="list-group-item justify-content-between clickable hover">
      <p class="center" style="margin:0;padding:0;">+</p>
    </button>
  </ul>

  <!-- ========================================== SPECIES ========================================== -->
  <ul class="list-group col-md-2 speciesList">
    <?php
      foreach($species as $specie){
        echo "<li onclick='callPHP(" . $specie['species_id'] . ", 6)' data-toggle='modal' data-target='#editSpeciesModal' class='list-group-item hover'>
            <p class='number'>" . $specie['species_id'] . "</p>" . 
            $specie['species_description'] . "</li>";
      }
    ?>
    <button type="button" data-toggle="modal" data-target="#createSpecies" class="list-group-item justify-content-between clickable hover">
      <p class="center" style="margin:0;padding:0;">+</p>
    </button>
  </ul>

</div>

<!-- ========================================== PATIENTS ========================================== -->
<div class="patientList col-md-10">
  <table class="table table-hover" id="filterOnIde">
    <thead>
      <tr>
        <td onclick="filterId()">#</td>
        <td>Name</td>
        <td>Specie</td>
        <td>Client</td>
        <td>Gender</td>
        <td>Status</td>
        <td>
          Action
          <button type="button" class="hiddenButton" data-toggle="modal" data-target="#editClient">
            <i  class='glyphicon glyphicon-pencil' id="editClientIcon" style="margin-left:10px;"></i>
          </button>
        </td>
      </tr>
    </thead>
    <tbody id="tableBody">
    </tbody>
  </table>
  <table class="table">
    <thead>
      <tr>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td><button type='button' onclick='createPatientSelect()' data-toggle='modal' data-target='#createPatient' class='list-group-item justify-content-between clickable hover'><p class='center' style='margin:0;padding:0;'>+</p></button></td>
      </tr>
    </thead>
  </table>
</div>

<!-- ========================================== ADD CLIENT MODAL ========================================== -->
<div class="container">
  <div class="modal fade" id="addClient" role="dialog">
    <form class="form-inline" method="POST">
      <div class="modal-dialog">
      
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Client</h4>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label for="name">First Name</label>
              <input type="text" class="form-control" name="newfirstname" placeholder="Jane">
            </div>
            <div class="form-group">
              <label for="name">Last Name</label>
              <input type="text" class="form-control" name="newlastname" placeholder="Doe">
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" name="createClient" class="btn btn-default">Add</button>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>

<!-- ========================================== EDIT CLIENT MODAL ========================================== -->
<div class="container">
  <div class="modal fade" id="editClient" role="dialog">
    <form class="form-inline" method="POST" action="">
      <div class="modal-dialog">
      
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Client</h4>
          </div>

          <div class="modal-body">
            <input type="number" name="idHolder" id="idHolder" style="display:none;"></input>
            <div class="form-group">
              <label for="name">First Name</label>
              <input type="text" class="form-control" name="firstname" id="firstname"  placeholder="Jane">
            </div>
            <div class="form-group">
              <label for="name">Last Name</label>
              <input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Doe">
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" name="deleteClient" class="btn btn-default">Delete</button>
            <button type="submit" name="cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" name="updateClient" class="btn btn-default">Update</button>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>

<!-- ========================================== EDIT PATIENT MODAL ========================================== -->
<div class="container">
  <div class="modal fade" id="editPatient" role="dialog">
    <form class="form-inline" method="POST" action="">
      <div class="modal-dialog">
      
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Patient</h4>
          </div>

          <div class="modal-body">
            <input type="number" name="idHolder" id="patientIdHolder" style="display:none;"></input>
            <div class="form-group">
              <label for="name" style="width: 75px;">Name</label>
              <input type="text" class="form-control" name="name" id="patientName"  placeholder="Jane">
            </div>
            <br />
            <div class="form-group">
              <label for="name" style="width: 75px;">Species</label>
              <select type="text" class="form-control" placeholder="species" name="species" id="speciesSelect" required>
              </select>
            </div>
            <br />
            <div class="form-group">
              <label for="name" style="width: 75px;">Clients</label>
              <select type="text" class="form-control" placeholder="client" name="client" id="clientSelect" required>
              </select>
            </div>
            <br />
            <div class="form-group" id="genderOption">
              <label for="name" style="width: 75px;">Gender</label>
              <input type='radio' name='gender' value='0' required checked>Male</input>
              <input type='radio' name='gender' value='1'>Female</input>
            </div>
            <br />
            <div class="form-group">
              <label for="name" style="width: 75px;">Status</label>
              <textarea class="form-control" style="max-width: 380px;" rows="2" name="status" id="patientStatus" placeholder="Status"></textarea>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" name="deletePatient" class="btn btn-default">Delete</button>
            <button type="submit" name="cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" name="updatePatient" class="btn btn-default">Update</button>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>

<!-- ========================================== CREATE PATIENT MODAL ========================================== -->
<div class="container">
  <div class="modal fade" id="createPatient" role="dialog">
    <form class="form-inline" method="POST" action="">
      <div class="modal-dialog">
      
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Patient</h4>
          </div>

          <div class="modal-body">
            <input type="number" name="idHolder" style="display:none;"></input>
            <div class="form-group">
              <label for="name" style="width: 75px;">Name</label>
              <input type="text" class="form-control" name="name"  placeholder="Jane">
            </div>
            <br />
            <div class="form-group">
              <label for="name" style="width: 75px;">Species</label>
              <select type="text" class="form-control" placeholder="species" name="species" id="createPatientSelect1" required>
              </select>
            </div>
            <br />
            <div class="form-group">
              <label for="name" style="width: 75px;">Clients</label>
              <select type="text" class="form-control" placeholder="client" name="client" id="createPatientSelect2" required>
              </select>
            </div>
            <br />
            <div class="form-group">
              <label for="name" style="width: 75px;">Gender</label>
                <input type='radio' name='gender' value='0' required checked>Male</input>
                <input type='radio' name='gender' value='1'>Female</input>
            </div>
            <br />
            <div class="form-group">
              <label for="name" style="width: 75px;">Status</label>
              <textarea class="form-control" style="max-width: 380px;" rows="2" name="status" placeholder="Status"></textarea>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" name="createPatient" class="btn btn-default">Create</button>
            <button type="submit" name="cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>

<!-- ========================================== EDIT SPECIES MODAL ========================================== -->
<div class="container">
  <div class="modal fade" id="editSpeciesModal" role="dialog">
    <form class="form-inline" method="POST" action="">
      <div class="modal-dialog">
      
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create Species</h4>
          </div>

          <div class="modal-body">
            <input type="number" name="idHolder" id="speciesIdHolder" style="display:none;"></input>
            <div class="form-group">
              <label for="name" style="width: 75px;">Name</label>
              <input type="text" class="form-control" name="name" id="speciesName" placeholder="Hond"></input>
            </div>

          <div class="modal-footer">
            <button type="submit" name="updateSpecies" class="btn btn-default">Update</button>
            <button type="submit" name="cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" name="deleteSpecies" class="btn btn-default">Delete</button>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>

<!-- ========================================== CREATE SPECIES MODAL ========================================== -->
<div class="container">
  <div class="modal fade" id="createSpecies" role="dialog">
    <form class="form-inline" method="POST" action="">
      <div class="modal-dialog">
      
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create Species</h4>
          </div>

          <div class="modal-body">
            <input type="number" name="idHolder" style="display:none;"></input>
            <div class="form-group">
              <label for="name" style="width: 75px;">Name</label>
              <input type="text" class="form-control" name="name"  placeholder="Hond"></input>
            </div>
          <div>

          <div class="modal-footer">
            <button type="submit" name="createSpecies" class="btn btn-default">Create</button>
            <button type="submit" name="cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>

<script>
  if (jQuery) { console.log("jQuery loaded"); } else { console.log("no jQuery found"); }

  var data = [];
  var patients = null;
  var species = null;
  var clients = null;
  var generatedData = null;
  var filterClient = false;
  var clientId = 0;
  
  function callPHP(params, f) {
    filterClient = true;
    clientId = 0;
    var httpc = new XMLHttpRequest();
    var url = "";
    if(f == 1){
      url = "http://localhost/Hospital-PHP/home/getClientById/" + params;
    }else if(f == 2){
      url = "http://localhost/Hospital-PHP/home/getPatientsByClient/" + params;
    }else if(f == 3){
      url = "http://localhost/Hospital-PHP/home/getWith/" + params;
    }else if(f == 4){
      url = "http://localhost/Hospital-PHP/home/getPatientById/" + params;
    }else if(f == 6){
      url = "http://localhost/Hospital-PHP/home/getSpeciesById/" + params;
    }
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpc.onreadystatechange = function() {
      if(httpc.readyState == 4 && httpc.status == 200 && f == 1) {
        data = JSON.parse(httpc.responseText);
        document.getElementById("firstname").value = data['client_firstname'];
        document.getElementById("lastname").value = data['client_lastname'];
        document.getElementById("idHolder").value = data['client_id'];
      }else if(httpc.readyState == 4 && httpc.status == 200 && f == 2){
        clientId = params;
        patients = JSON.parse(httpc.responseText);
        generateTable();
      }else if(httpc.readyState == 4 && httpc.status == 200 && f == 3){
        patients = JSON.parse(httpc.responseText);
        filterClient = false;
        generateTable();
      }else if(httpc.readyState == 4 && httpc.status == 200 && f == 4){
        var patientData = JSON.parse(httpc.responseText);
        document.getElementById("patientIdHolder").value = patientData['patient_id'];
        document.getElementById("patientName").value = patientData['patient_name'];
        document.getElementById("patientStatus").value = patientData['patient_status'];
        var inputs = document.getElementById("genderOption").getElementsByTagName('input');
        if(patientData['patient_gender'] == 0){
          inputs[0].checked = true;
          inputs[1].checked = false;
        }else{
          inputs[0].checked = false;
          inputs[1].checked = true;
        }
        generateEditSelect(patientData);
      }else if(httpc.readyState == 4 && httpc.status == 200 && f == 5){
        clientId = params;
        patients = JSON.parse(httpc.responseText);
        generateTable();
      }else if(httpc.readyState == 4 && httpc.status == 200 && f == 6){
        var tempdata = JSON.parse(httpc.responseText);
        document.getElementById("speciesIdHolder").value = tempdata['species_id'];
        document.getElementById("speciesName").value = tempdata['species_description']
      }
    }
    httpc.send(params);
  }

  function getData(params) {
    var newData = [];
    var httpc = new XMLHttpRequest();
    var url = "";
    if(params == 0){
      url = "http://localhost/Hospital-PHP/home/getViaJoin/";
    }
    var data = null;
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpc.onreadystatechange = function() {
      if(httpc.readyState == 4 && httpc.status == 200) {
        if(params == 0){
          generatedData = JSON.parse(httpc.responseText);
          console.log(newData);
        }
      }
    }
    httpc.send(params);
  }

  function generateEditSelect(data){
    var clientsSelect = document.getElementById("clientSelect");
    var speciesSelect = document.getElementById("speciesSelect");
    var html = "";
    clients.forEach(function(client){
      html += "<option value='" + client['client_id'] +"'>" + client['client_firstname']  +" "+ client['client_lastname']+"</option>";
    });
    clientsSelect.innerHTML = html;
    html = "";
    species.forEach(function(specie){
      html += "<option value='" + specie['species_id'] +"'>" + specie['species_description'] +"</option>";
    });
    speciesSelect.innerHTML = html;
  }

  getData(0);
  var loadDataInterval = setInterval(function(){
    if(generatedData != null){
      generateTable();
    }
  },100);

  function generateTable(){
    clearInterval(loadDataInterval);
    if(filterClient == true){
      document.getElementById("editClientIcon").style.display = "inline";
      document.getElementById("editClientIcon").onclick = function() { callPHP(clientId, 1); };
    }else{
      document.getElementById("editClientIcon").style.display = "none";
      document.getElementById("editClientIcon").onclick = function() {};
    }

    const table = document.getElementById("tableBody");
    table.innerHTML = "";
    
    generatedData.forEach(function(row){
      var html = "";
      html += "<tr><td>" + row['id'] + "</td><td>" + row['name'] + "</td>";
      html += "<td>" + row['species_name'] + "</td>";
      html += "<td>" + row['client_firstname'] + " " + row['client_lastname'] + "</td>";
      if(row['gender'] == 0){
        html += "<td>Male</td>"; 
      }else{
        html += "<td>Female</td>";
      }
      html += "<td>" + row['status'] + "</td><td><button type='button' onclick='callPHP(" + row['id'] + ", 4)' class='hiddenButton' data-toggle='modal' data-target='#editPatient'><i class='glyphicon glyphicon-pencil' style='margin-left:10px;'></i></button></td></tr>";
      table.innerHTML += html;
    });
  }

  function createPatientSelect(){
    var select1 = document.getElementById("createPatientSelect1");
    var select2 = document.getElementById("createPatientSelect2");
    var html = "";
    species.forEach(function(specie){
      html += "<option value='" + specie['species_id'] +"'>" + specie['species_description']+"</option>";
    });
    select1.innerHTML = html;
    html = "";
    clients.forEach(function(client){
    });

    clients.forEach(function(client){
      html += "<option value='" + client['client_id'] +"'>" + client['client_firstname'] + " " + client['client_lastname'] + "</option>";
    });
    select2.innerHTML = html;
  }

  function filterId(){
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("filterOnIde");
    switching = true;
    dir = "asc"; 

    while (switching) {
      switching = false;
      rows = table.getElementsByTagName("TR");
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[0];
        y = rows[i + 1].getElementsByTagName("TD")[0];

        if (dir == "asc") {
          if (Number(x.innerHTML) > Number(y.innerHTML)) {
            shouldSwitch= true;
            break;
          }
        } else if (dir == "desc") {
          if (Number(x.innerHTML) < Number(y.innerHTML)) {
            shouldSwitch= true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        switchcount ++; 
      } else {
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
</script>