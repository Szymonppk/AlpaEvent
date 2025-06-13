<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/public/styles/admin-panel.css">
    <script src="/public/scripts/admin-panel.js" defer></script>
</head>

<body>
    <div class="container">
        <h1>Admin Panel</h1>

        <section>
            <h2>Users</h2>
            <table id="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['user_id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td>
                                <form method="POST" action="/delete-user-by-admin" onsubmit="return confirm('Are you sure?')">
                                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Rooms</h2>
            <table id="rooms-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td><?= htmlspecialchars($room['room_id']) ?></td>
                            <td><?= htmlspecialchars($room['event_name']) ?></td>
                            <td>
                                <form method="POST" action="/delete-room" onsubmit="return confirm('Are you sure?')">
                                    <input type="hidden" name="room_id" value="<?= $room['room_id'] ?>">
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </section>
    </div>
</body>

</html>