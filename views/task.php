<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoList</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="container">
        <h2 class="mb-4 text-center text-black">Todo List</h2>

        <form method="POST" class="mb-4" id="taskForm">
            <div class="mb-3">
                <label for="task" class="form-label">Task</label>
                <input type="text" class="form-control" id="task" name="task" required>
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select class="form-select" id="priority" name="priority" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>
            <input type="hidden" name="action" value="create">
            <button type="submit" class="custom-button">Tambah Task</button>
        </form>

        <?php if (empty($sortedTasks)): ?>
            <div class="alert alert-light text-center">Task Tidak Ditemukan</div>
        <?php else: ?>
            <div class="task-list">
                <div class="card-priority">
                    <h3 class="priority-title priority-high">High Priority</h3>
                    <ul class="list-group">
                        <?php foreach ($sortedTasks as $index => $task): ?>
                            <?php if ($task['priority'] == 'High'): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?= htmlspecialchars($task['task']) ?></strong>
                                        <span class="badge bg-danger"><?= htmlspecialchars($task['priority']) ?></span>
                                    </div>
                                    <div>
                                        <button class="action-button me-2"
                                            onclick="editTask(<?= $index ?>, '<?= htmlspecialchars(addslashes($task['task'])) ?>', '<?= htmlspecialchars(addslashes($task['priority'])) ?>')">Edit</button>
                                        <form method="POST" style="display: inline; z-index:1;">
                                            <input type="hidden" name="index" value="<?= $index ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <button type="submit" class="action-button">Hapus</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-priority">
                    <h3 class="priority-title priority-medium">Medium Priority</h3>
                    <ul class="list-group">
                        <?php foreach ($sortedTasks as $index => $task): ?>
                            <?php if ($task['priority'] == 'Medium'): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?= htmlspecialchars($task['task']) ?></strong>
                                        <span class="badge bg-warning"><?= htmlspecialchars($task['priority']) ?></span>
                                    </div>
                                    <div>
                                        <button class="action-button me-2"
                                            onclick="editTask(<?= $index ?>, '<?= htmlspecialchars(addslashes($task['task'])) ?>', '<?= htmlspecialchars(addslashes($task['priority'])) ?>')">Edit</button>
                                        <form method="POST" style="display: inline; z-index:1;">
                                            <input type="hidden" name="index" value="<?= $index ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <button type="submit" class="action-button">Hapus</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-priority">
                    <h3 class="priority-title priority-low">Low Priority</h3>
                    <ul class="list-group">
                        <?php foreach ($sortedTasks as $index => $task): ?>
                            <?php if ($task['priority'] == 'Low'): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?= htmlspecialchars($task['task']) ?></strong>
                                        <span class="badge bg-success"><?= htmlspecialchars($task['priority']) ?></span>
                                    </div>
                                    <div>
                                        <button class="action-button me-2"
                                            onclick="editTask(<?= $index ?>, '<?= htmlspecialchars(addslashes($task['task'])) ?>', '<?= htmlspecialchars(addslashes($task['priority'])) ?>')">Edit</button>
                                        <form method="POST" style="display: inline; z-index:1;">
                                            <input type="hidden" name="index" value="<?= $index ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <button type="submit" class="action-button">Hapus</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="editTask" class="form-label">Task</label>
                                <input type="text" class="form-control" id="editTask" name="task" required>
                            </div>
                            <div class="mb-3">
                                <label for="editPriority" class="form-label">Priority</label>
                                <select class="form-select" id="editPriority" name="priority" required>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <input type="hidden" name="index" id="editIndex">
                            <input type="hidden" name="action" value="edit">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="close-button" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="custom-button">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        function editTask(index, task, priority) {
            document.getElementById('editTask').value = task;
            document.getElementById('editPriority').value = priority;
            document.getElementById('editIndex').value = index;
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }
    </script>



</body>

</html>