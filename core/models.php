<?php
require_once 'dbConfig.php';

function getAllUsers($pdo) {
    $sql = "SELECT * FROM game_developer_applicants 
            ORDER BY first_name ASC";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();
    
    if ($executeQuery) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    return []; 
}

function getUserByID($pdo, $id) {
    $sql = "SELECT * FROM game_developer_applicants WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$id]);

    if ($executeQuery) {
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    return null; 
}

function searchForAUser ($pdo, $searchQuery) {
    $sql = "SELECT * FROM game_developer_applicants WHERE 
            CONCAT(first_name, ' ', last_name, ' ', email, ' ', gender, ' ', 
                    address, ' ', state, ' ', nationality, ' ', years_of_experience, ' ', 
                    programming_languages, ' ', favorite_game_engine, ' ', date_added) 
            LIKE ?";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute(["%" . $searchQuery . "%"]);
    
    if ($executeQuery) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    return []; 
}

function insertNewUser($pdo, $first_name, $last_name, $email, 
	$gender, $address, $state, $nationality, $years_of_experience,
    $programming_languages, $favorite_game_engine, $date_added) {

    $sql = "INSERT INTO game_developer_applicants 
            (
                first_name,
                last_name,
                email,
                gender,
                address,
                state,
                nationality,
                year_of_experience,
                programming_languages,
                favorite_game_engine
                date_added
            )
            VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([
        $first_name, $last_name, $email, $gender, 
        $address, $state, $nationality, $years_of_experience,
        $programming_languages, $favorite_game_engine, $date_added
    ]);

    if ($executeQuery) {
        return true;
    }

}

function editUser($first_name, $last_name, $email, $gender, 
$address, $state, $nationality, $years_of_experience,
$programming_languages, $favorite_game_engine, $id) {

	$sql = "UPDATE game_developer_applicants
				SET first_name = ?,
					last_name = ?,
					email = ?,
					gender = ?,
					address = ?,
					state = ?,
					nationality = ?,
					years_of_experience = ?,
                    programming_languages = ?,
                    favorite_game_engine = ?,

				WHERE id = ? 
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $email, $gender, 
    $address, $state, $nationality, $years_of_experience,
    $programming_languages, $favorite_game_engine, $id]);

	if ($executeQuery) {
		return true;
	}

}

function deleteUser($pdo, $id) {
	$sql = "DELETE FROM game_developer_applicants
			WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return true;
	}
}

?>