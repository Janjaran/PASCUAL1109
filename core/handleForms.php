<?php  

require_once 'dbConfig.php';
require_once 'models.php';
 

if (isset($_POST['insertUser Btn'])) {
    $insertUser  = insertNewUser (
        $pdo,
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['gender'],
        $_POST['address'],
        $_POST['state'],
        $_POST['nationality'],
        $_POST['years_of_experience'], 
        $_POST['programming_languages'], 
        $_POST['favorite_game_engine'], 
        date('Y-m-d H:i:s') 
    );

    if ($insertUser ) {
        $_SESSION['message'] = "Successfully inserted!";
        header("Location: ../index.php");
        exit(); 
    }
}

if (isset($_POST['editUserBtn'])) {
    $editUser = editUser(
        $pdo,
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['gender'],
        $_POST['address'],
        $_POST['state'],
        $_POST['nationality'],
        $_POST['years_of_experience'], 
        $_POST['programming_languages'], 
        $_POST['favorite_game_engine'], 
        date('Y-m-d H:i:s') 
    );

    if ($editUser) {
		$_SESSION['message'] = "Successfully edited!";
		header("Location: ../index.php");
	}
}

if (isset($_POST['deleteUserBtn'])) {
	$deleteUser = deleteUser($pdo,$_GET['id']);

	if ($deleteUser) {
		$_SESSION['message'] = "Successfully deleted!";
		header("Location: ../index.php");
	}
}

if (isset($_GET['searchBtn'])) {
	$searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
	foreach ($searchForAUser as $row) {
		echo "<tr> 
				<td>{$row['id']}</td>
				<td>{$row['first_name']}</td>
				<td>{$row['last_name']}</td>
				<td>{$row['email']}</td>
				<td>{$row['gender']}</td>
				<td>{$row['address']}</td>
				<td>{$row['state']}</td>
				<td>{$row['nationality']}</td>
				<td>{$row['years_of_experience']}</td>
                <td>{$row['programming_languages']}</td>
                <td>{$row['favorite_game_engine']}</td>
                <td>{$row['date_added']}</td>
			  </tr>";
	}
}

?>
