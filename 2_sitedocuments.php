<?php
include('2_site.php');
if (isset($_POST["Submit"])) {
    $titre =  $_POST["titre"];
    $pilote =  $_POST["pilote"];
    $code = $_POST["code"];
    $support=$_POST["support"];
    $supp= " ";
    foreach($support as $row){
      $supp .= $row .",";
   }
    $fournisseur= $_POST["fournisseur"];
   $destinataire= $_POST["destinataire"];
   $dest = " ";
   foreach($destinataire as $row){
      $dest .= $row .",";
   }
    $lieu= $_POST["lieu"];
  // Check if destinataire is set
    $requete =mysqli_query($conn, "INSERT INTO docs ( titre, pilote, code, supportdocument, fournisseur, destinataire, lieu) VALUES ('$titre','$pilote','$code','$supp','$fournisseur', '$dest','$lieu')");
    
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width" />
<!-- *Note: You must have internet connection on your laptop or pc other wise below code is not working -->
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- bootstrap css and js -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
<!-- JS for jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </head>
<body>
<div >
    <h2>Upload Documents</h2>
    <form action="" method="post" >
    <table class="table" style="  font-size: 14px;
  padding: 10px;
  table-layout: auto;
  border-collapse: collapse;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Pilote</th>
      <th scope="col">Code</th>
      <th scope="col">Support du document</th>
      <th scope="col">Fournisseur</th>
      <th scope="col">Destinataires</th>
      <th scope="col">Lieu du classement</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <input type="text" placeholder="le titre du document" value="" name="titre">
      </td>
      <td>
        <input type="text" placeholder="Pilote:gere le doc" name="pilote">
      </td>
      <td>
        <input type="text" placeholder="Exemple:ESU.PS08" name="code">
      </td>
      <td >
        <input type="radio" name="support[]">papier <br>
        <input type="radio" name="support[]">Numerique
      </td>
      <td>
        <input type="text" placeholder="Exemple:Chef de servive technique" name="fournisseur">
      </td>
      <td>
        <input type="radio" name="destinataire[]" >Service technique navigation
        <br>
        <input type="checkbox" name="destinataire[]" > section CNS
        <br>
        <input type="checkbox" name="destinataire[]" >section infrastructure& electricite
        <br>
        <input type="radio" name="destinataire" >section navigation <br>
        <input type="checkbox" name="destinataire[]" > section Controle aerien 
        <br>
        <input type="checkbox" name="destinataire[]" >section SLIA
        <br>
        <input type="radio" name="destinataire[]" >section SSQE <br>
        <input type="radio" name="destinataire[]" >section exploitation aeroportuaire
        <br>
        <input type="radio" name="destinataire[]" >section ressources <br>
        <input type="radio" name="destinataire[]" >Autre <br>
      </td>
      <td>
        <input type="text" placeholder="Lieu du classement" name="lieu">
      </td>
    </tr>
  </tbody>
</table>
<h3>File input</h3>
<input type="file" style="margin-top: 10px; margin-bottom: 10px;" required accept="image/png, image/jpge" >
<button type="submit" style="margin-top: 10px; margin-bottom: 4px; "name="Submit">add document</button>
</form>
</div>
<form method="post">
      <div>
        <input type="text" name="search" placeholder="search data" required />
        <button type="submit" name="submit">Search</button>
      </div>
    </form>
    <hr>
<div class="container">
	<div class="row">
		<div class="col-lg-12" style="align= center" >
			<br>
			<h2 style="align= center">Document</h2>
			<br>
			<table>
    <tr>
        <td colspan="8" class="header-content">
            <img src="onda logo.jpeg" alt="Logo">
            <div>Office National des Aéroports</div>
            <div>Aéroport Essaouira Mogador</div>
        </td>
    </tr>
    <tr>
        <th>Titre</th>
        <th>Pilote</th>
        <th>Code</th>
        <th>Support du document</th>
        <th>Mise à jour</th>
        <th>Fournisseur</th>
        <th>Destinataires</th>
        <th>Lieu du classement</th>
    </tr>
			<tbody>
      <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px; /* Espace entre les tableaux */
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .header-content {
            text-align: center; /* Centre le contenu dans la cellule */
            padding: 20px;
        }
        .header-content img {
            max-height: 100px;
            display: block;
            margin: 0 auto; /* Centre l'image elle-même */
        }
    </style>
			<?php                
			require '2_site.php'; 
			$display_query = "SELECT titre, pilote, code, supportdocument, fournisseur, destinataire, lieu FROM docs";
if ($results = mysqli_query($conn, $display_query)) {
    $count = mysqli_num_rows($results);
    if($count>0) 
    {
      while($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC))
      {
        ?>
       <tr>
         <td><?php echo $data_row['titre']; ?></td>
         <td><?php echo $data_row['pilote']; ?></td>
         <td><?php echo $data_row['code']; ?></td>
         <td><?php echo $data_row['supportdocument']; ?>
      <td><?php echo $data_row['fournisseur']; ?>
      <td><?php echo $data_row['destinataire']; ?>
      <td><?php echo $data_row['lieu']; ?>
         <td>
           <a href="pdf_maker.php?titre=<?php echo $data_row['titre']; ?>&ACTION=VIEW" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> View PDF</a> &nbsp;&nbsp; 
           <a href="pdf_maker.php?titre=<?php echo $data_row['titre']; ?>&ACTION=DOWNLOAD" class="btn btn-danger"><i class="fa fa-download"></i> Download PDF</a>
          &nbsp;&nbsp; 
           <a href="pdf_maker.php?titre=<?php echo $data_row['titre']; ?>&ACTION=UPLOAD" class="btn btn-warning"><i class="fa fa-upload"></i> Upload PDF</a>
        </td>
       </tr>
       <?php
      }
    }
    // rest of your code
} else {
    echo "Error: " . mysqli_error($conn);
}
    

    if (isset($_POST['search'])) {
      $search = $_POST['search'];
      $query = "SELECT * FROM docs WHERE titre LIKE '%$search%' OR pilote LIKE '%$search%' OR code LIKE '%$search%' OR supportdocument LIKE '%$search%' OR fournisseur LIKE '%$search%' OR destinataire LIKE '%$search%' OR lieu LIKE '%$search%'";
      $result = mysqli_query($conn, $query);
      if ($result) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          // display search results
          echo "<tr>";
          echo "<td>" . $row['titre'] . "</td>";
          echo "<td>" . $row['pilote'] . "</td>";
          echo "<td>" . $row['code'] . "</td>";
          echo "<td>" . $row['supportdocument'] . "</td>";
          echo "<td>" . $row['fournisseur'] . "</td>";
          echo "<td>" . $row['destinataire'] . "</td>";
          echo "<td>" . $row['lieu'] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "No results found";
      }
    }
		
			?>
			</tbody>
			</table>
		</div>
	</div>
</div>
<br>
</body>
</html>