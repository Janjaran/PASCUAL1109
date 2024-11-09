<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Document</title>
</head>
<body>
    
<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: green; text-align: center; background-color: ghostwhite; border-style: solid;">	
			<?php echo $_SESSION['message']; ?>
		</h1>
	<?php } unset($_SESSION['message']); ?>

	
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
		<input type="text" name="searchInput" placeholder="Search here" required>
		<input type="submit" name="searchBtn" value="Search">
	</form>
    <table style="width:100%; margin-top: 20px;">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Address</th>
            <th>State</th>
            <th>Nationality</th>
            <th>Years of Experience</th>
            <th>Programming Languages</th>
            <th>Favorite Game Engine</th>
            <th>Date Added</th>
            <th>Action</th>
        </tr>

<?php if (!isset($_GET['searchBtn'])) { ?>
        <?php $getAllUsers = getAllUsers($pdo); ?>
        <?php foreach ($getAllUsers as $row) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['gender']); ?></td>
                <td><?php echo htmlspecialchars($row['address']); ?></td>
                <td><?php echo htmlspecialchars($row['state']); ?></td>
                <td><?php echo htmlspecialchars($row['nationality']); ?></td>
                <td><?php echo htmlspecialchars($row['years_of_experience']); ?></td>
                <td><?php echo htmlspecialchars($row['programming_languages']); ?></td>
                <td><?php echo htmlspecialchars($row['favorite_game_engine']); ?></td>
                <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <?php $searchForAUser  = searchForAUser ($pdo, $_GET['searchInput']); ?>
        <?php foreach ($searchForAUser  as $row) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['gender']); ?></td>
                <td><?php echo htmlspecialchars($row['address']); ?></td>
                <td><?php echo htmlspecialchars($row['state']); ?></td>
                <td><?php echo htmlspecialchars($row['nationality']); ?></td>
                <td><?php echo htmlspecialchars($row['years_of_experience']); ?></td>
                <td><?php echo htmlspecialchars($row['programming_languages']); ?></td>
                <td><?php echo htmlspecialchars($row['favorite_game_engine']); ?></td>
                <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>

</body>
</html>