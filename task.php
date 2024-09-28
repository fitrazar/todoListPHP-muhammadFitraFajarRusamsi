<?php
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    if ($action == 'create') {
        $newTask = [
            'task' => $_POST['task'],
            'priority' => $_POST['priority']
        ];
        $_SESSION['tasks'][] = $newTask;
    } elseif ($action == 'edit') {
        $index = $_POST['index'];
        if (isset($_SESSION['tasks'][$index])) {
            $_SESSION['tasks'][$index] = [
                'task' => $_POST['task'],
                'priority' => $_POST['priority']
            ];
        }
    } elseif ($action == 'delete') {
        $index = $_POST['index'];
        unset($_SESSION['tasks'][$index]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']);
    }
    
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

function sortTasksByPriority($tasks)
{
    usort($tasks, function ($a, $b) {
        $priorities = ['High' => 1, 'Medium' => 2, 'Low' => 3];
        return $priorities[$a['priority']] <=> $priorities[$b['priority']];
    });
    return $tasks;
}

$sortedTasks = sortTasksByPriority($_SESSION['tasks']);
