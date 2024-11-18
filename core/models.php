<?php
require_once 'dbConfig.php';

function getAllUsers($pdo) {
    $sql = "SELECT * FROM game_developer_applicants ORDER BY first_name ASC";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();
    
    if ($executeQuery) {
        return [
            'message' => 'Records retrieved successfully.',
            'statusCode' => 200,
            'querySet' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    }
    
    return [
        'message' => 'Failed to retrieve records.',
        'statusCode' => 400
    ];
}

function getUserByID($pdo, $id) {
    $sql = "SELECT * FROM game_developer_applicants WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$id]);

    if ($executeQuery) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return [
                'message' => 'User found successfully.',
                'statusCode' => 200,
                'querySet' => $user
            ];
        } else {
            return [
                'message' => 'User not found.',
                'statusCode' => 400
            ];
        }
    }
    
    return [
        'message' => 'Error retrieving user.',
        'statusCode' => 400
    ];
}

function insertNewUser($pdo, $first_name, $last_name, $email, $gender, $address, $state, $nationality, $years_of_experience, $programming_languages, $favorite_game_engine, $date_added) {
    $sql = "INSERT INTO game_developer_applicants 
            (first_name, last_name, email, gender, address, state, nationality, years_of_experience, programming_languages, favorite_game_engine, date_added) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $email, $gender, $address, $state, $nationality, $years_of_experience, $programming_languages, $favorite_game_engine, $date_added]);

    if ($executeQuery) {
        return [
            'message' => 'User inserted successfully.',
            'statusCode' => 200
        ];
    }
    
    return [
        'message' => 'Failed to insert user.',
        'statusCode' => 400
    ];
}

function editUser($pdo, $first_name, $last_name, $email, $gender, $address, $state, $nationality, $years_of_experience, $programming_languages, $favorite_game_engine, $id) {
    $sql = "UPDATE game_developer_applicants 
            SET first_name = ?, last_name = ?, email = ?, gender = ?, address = ?, state = ?, nationality = ?, years_of_experience = ?, programming_languages = ?, favorite_game_engine = ? 
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $email, $gender, $address, $state, $nationality, $years_of_experience, $programming_languages, $favorite_game_engine, $id]);

    if ($executeQuery) {
        return [
            'message' => 'User updated successfully.',
            'statusCode' => 200
        ];
    }
    
    return [
        'message' => 'Failed to update user.',
        'statusCode' => 400
    ];
}

function deleteUser($pdo, $userId) {
    $query = "SELECT * FROM game_developer_applicants WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);

    if ($stmt->rowCount() == 0) {
        return [
            'statusCode' => 404,
            'message' => 'User not found.'
        ];
    }

    $query = "DELETE FROM game_developer_applicants WHERE id = ?";
    $stmt = $pdo->prepare($query);

    if ($stmt->execute([$userId])) {
        // Return a successful status and message
        return [
            'statusCode' => 200,
            'message' => 'User deleted successfully.'
        ];
    } else {
        return [
            'statusCode' => 400,
            'message' => 'Failed to delete user.'
        ];
    }
}



function searchForAUser($pdo, $searchQuery) {
    $sql = "SELECT * FROM game_developer_applicants WHERE 
            CONCAT(first_name, ' ', last_name, ' ', email, ' ', gender, ' ', address, ' ', state, ' ', nationality, ' ', years_of_experience, ' ', programming_languages, ' ', favorite_game_engine, ' ', date_added) 
            LIKE ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute(["%" . $searchQuery . "%"]);
    
    if ($executeQuery) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            return [
                'message' => 'Search results retrieved successfully.',
                'statusCode' => 200,
                'querySet' => $results
            ];
        } else {
            return [
                'message' => 'No matching records found.',
                'statusCode' => 400
            ];
        }
    }

    return [
        'message' => 'Error occurred during search.',
        'statusCode' => 400
    ];
}
?>
